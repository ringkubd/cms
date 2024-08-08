<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class VtpAutoNotice extends Model
{
  protected $table = 'vtp_auto_notices';

  public $primaryKey = 'id';

  public $timestamps = true;

  protected $guarded = [];
}
