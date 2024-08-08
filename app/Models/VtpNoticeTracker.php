<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VtpNoticeTracker extends Model
{
  protected $table = 'vtp_notice_tracker';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $guarded = [];

}
