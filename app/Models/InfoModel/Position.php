<?php

namespace App\Models\InfoModel;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // Table Name
    protected $table = 'positions';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
