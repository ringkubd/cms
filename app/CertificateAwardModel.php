<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateAwardModel extends Model
{
  protected $connection= 'certificate_award';

  protected $table = 'register';

  public $primaryKey = 'id';

  protected $guarded = [];

  public $timestamps = true;
}
