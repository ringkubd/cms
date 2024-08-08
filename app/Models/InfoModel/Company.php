<?php

namespace App\Models\InfoModel;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // Table Name
    protected $table = 'companies';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
