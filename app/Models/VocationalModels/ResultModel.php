<?php

namespace App\Models\VocationalModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResultModel extends Model
{
  protected $connection = 'pis_isdb_vtp';

  protected $table = 'tbl_application';

  public $primaryKey = 'id';

  protected $guarded = [];

  public $timestamps = true;


  public static function primarySelection($round = 0)
  {
    $rgm = "religion=0 and gender=0 and martial_status=0";
    $Education = array('Bachelor', 'Fazil', 'BA (Hons)', 'Masters', 'Kamil', 'Diploma');
    return self::select(DB::connection('pis_isdb_vtp')->raw("floor(datediff(ti.end_date, birth_date)/30.417) as age, floor(datediff(ti.end_date, birth_date)/365) as age_year"),
      'tbl_application.round', 'tbl_application.trainee_id',  'tbl_application.name', 'tbl_application.mobile_number') // select only trainee_id
      ->whereRaw($rgm)->where("tbl_application.round", $round)
      ->whereNotIn("education", $Education)
      ->where(function ($q) use ($Education) {
        $q->whereNotIn('studying_level', $Education);
        $q->orWhereNull('studying_level');
      })
      ->having("age", ">", "203")
      ->having("age", "<", "361")
      ->whereRaw('passing_year < YEAR(CURDATE())')
      ->leftjoin("tbl_intake_info as ti", function ($q) {
        $q->on("ti.round", 'tbl_application.round');
      })->orderBy("trainee_id")->get();
  }

}
