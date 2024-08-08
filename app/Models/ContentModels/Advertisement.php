<?php

namespace App\Models\ContentModels;

use App\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
  // Table Name
  protected $table = 'advertisements';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;


    /**
     * @param $input
     * @param bool $image
     * @param bool $update
     * @param int $post_id
     * @return mixed
     */
    public static function save_advertisement($input, $image = false, $update = false, $post_id = 0)
    {
        if ($update && $post_id) {
            $advert = Advertisement::find($post_id);
        } else {
            $advert = new Advertisement();
        }
        $advert->title = $input["title_en"];
        $advert->title_bn = $input['title_bn'];
        $advert->description = $input['article_en'];
        $advert->description_bn = $input['article_bn'];
        $advert->upload_type = $input['upload_type'];
        if ($image) {
            $advert->picture = $image;
        }
        $advert->home_page = $input['home_page'] ?? 0;
        $advert->status = $input['post_status'];
        $advert->schedule_time = Carbon::parse($input['scheduleTime'])->setTimezone("Asia/Dhaka")->format("Y-m-d H:i:s");
        $advert->start_time = Carbon::parse($input['start_time'])->setTimezone("Asia/Dhaka")->format("Y-m-d H:i:s");
        $advert->end_time = Carbon::parse($input['end_time'])->setTimezone("Asia/Dhaka")->format("Y-m-d H:i:s");
        $advert->user_id = Auth::user()->id;
        $advert->save();
        return $advert->id;
    }

    /**
     * @param $modules
     * @param $ad_id
     * @return int
     */
    public static function save_adertisement_relation($modules, $ad_id)
    {
        if (is_array($modules)) {
            foreach ($modules as $key => $value) {
                DB::table("advertisement_relations")->insert([
                    "active" => 1,
                    "module_id" => $value,
                    "advertise_id" => $ad_id,
                    "user_id" => Auth::user()->id
                ]);
            }
            return 1;
        }
        return 0;
    }

    /**
     * @param $modules
     * @param $ad_id
     * @return int
     */
    public static function update_adertisement_relation($modules, $ad_id)
    {
        DB::table("advertisement_relations")->where("advertise_id", $ad_id)->update([
            "active" => 0
        ]);
        if (is_array($modules)) {
            foreach ($modules as $key => $value) {
                $relation = DB::table("advertisement_relations")
                    ->where("module_id", $value)
                    ->where("advertise_id", $ad_id)
                    ->first();
                if (!empty($relation)) {
                    DB::table("advertisement_relations")
                        ->where("id", $relation->id)
                        ->update([
                            "active" => 1
                        ]);
                } else {
                    DB::table("advertisement_relations")->insert([
                        "active" => 1,
                        "module_id" => $value,
                        "advertise_id" => $ad_id,
                        "user_id" => Auth::user()->id
                    ]);
                }

            }
            return 1;
        }
        return 0;
    }

    /**
     * @param string $req_picture
     * @param bool $folder
     * @return mixed
     */
    public static function save_picture($req_picture, $folder = false)
    {
        $filenameWithExt = $req_picture->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $req_picture->getClientOriginalExtension();
        $oldfileNameToStore = slug_url($filename) . '_' . time() . '.' . $extension;
        $organized_path = "photos/shares/" . date("Y-m");
        if ($folder) {
            $organized_path = "photos/shares/{$folder}";
        }
        $fileNameToStore = $req_picture->storeAs($organized_path, $oldfileNameToStore);
        $thumb_dir = Storage::disk("shares")->exists("{$organized_path}/thumbs");
        if (!$thumb_dir) {
            Storage::disk("shares")->makeDirectory("{$organized_path}/thumbs");
        }
        Image::make($req_picture->getRealPath())->resize(
            300,
            null,
            function ($c) {
                $c->aspectRatio();
            }
        )->save("{$organized_path}/thumbs/{$oldfileNameToStore}");
        return $fileNameToStore;
    }

    /**
     * @param string $order
     * @param int $pagiante
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function get_advertisement_data_table($order = "desc", $pagiante = 10)
    {
        $advert = DB::table("advertisements as ad")
            ->where("ad.is_delete", 0)
            ->join("users as u", "u.id", "ad.user_id")
            ->select("ad.*", "u.id as user_id", "u.firstName as firstName", "u.LastName as LastName")
            ->orderBy("ad.id", $order)
            ->paginate($pagiante);
        return $advert;
    }

    /**
     * @param $post_id
     * @return array
     */
    public static function get_advertisement_module_array($post_id, $only_id = false, $only_name = false)
    {
        $adverts = DB::table("advertisement_relations as adr")
            ->where("adr.active", 1)
            ->where("adr.advertise_id", $post_id)
            ->join("modules as m", "m.id", "adr.module_id")
            ->select("m.*")
            ->get();
        if ($only_id) {
            $module = array();
            foreach ($adverts as $item) {
                array_push($module, $item->id);
            }
            return $module;
        } elseif ($only_name) {
            $module = array();
            foreach ($adverts as $item) {
                array_push($module, $item->name);
            }
            return $module;
        }
        return $adverts;

    }

    /**
     * @return array
     */
    public static function get_advertisement_post_authors()
    {
        $collenction = DB::table("advertisements as ad")
            ->where("ad.is_delete", 0)
            ->join("users as u", "u.id", "ad.user_id")
            ->select("u.*")
            ->get();
        $users = array();
        foreach ($collenction as $item) {
            $users[$item->id] = $item->firstName . " " . $item->LastName;
        }
        return $users;
    }

    /**
     * @param $module_id
     * @param $author_id
     * @param $status
     * @param $dateFilter
     * @param $dateRange
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Query\Builder
     */
    public static function get_advertisement_filter_data($module_id, $author_id, $status, $dateFilter, $dateRange)
    {
        $collenction = DB::table("advertisements as ad")->where("ad.is_delete", 0);
        if ($module_id !== null && $module_id !== "all") {
            $collenction = DB::table("advertisement_relations as adr")
                ->where("adr.active", 1)
                ->where("adr.module_id", $module_id)
                ->join("advertisements as ad", "ad.id", "adr.advertise_id")
                ->where("ad.is_delete", 0);

        }
        if ($author_id !== null && $author_id !== "all") {
            $collenction = $collenction->where("ad.user_id", $author_id);
        }
        if ($status !== null && $status !== "all") {
            $collenction = $collenction->where("ad.status", $status);
        }
        if ($dateFilter == 1) {
            $date = explode('-', $dateRange);
            $from = \Carbon\Carbon::parse($date[0]);
            $to = \Carbon\Carbon::parse($date[1])->addHours(24);
            $collenction = $collenction->whereBetween("ad.created_at", [$from, $to]);
        }
        $collenction = $collenction->join("users as u", "u.id", "ad.user_id")
            ->select("ad.*", "u.id as user_id", "u.firstName as firstName", "u.LastName as LastName")
            ->orderBy("ad.id", "desc")
            ->paginate(10);
        return $collenction;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }
}
