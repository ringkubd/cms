<?php

namespace App\Models\VocationalModels;

use Illuminate\Database\Eloquent\Model;

class IntakeModel extends Model
{
  protected $connection = 'pis_isdb_vtp';

  protected $table = 'tbl_intake_info';

  public $primaryKey = 'id';

  protected $guarded = [];

  public $timestamps = true;


  public static function lastIntakeScheduleApi($prev = null)
  {
    if ($prev == 'previous') {
      return self::where('round', self::prevRound())->first();
    }

    return self::where('round', self::newRound())->first();
  }

  public static function newRound()
  {
    return self::select('round')->orderByDesc('id')->first()->round ?? 0;
  }


  public static function prevRound()
  {
    return self::select('round')->orderByDesc('id')->offset(1)->first()->round ?? 0;
  }

}
