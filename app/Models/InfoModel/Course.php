<?php

namespace App\Models\InfoModel;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Table Name
    protected $table = 'subjects';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function module()
    {
        return $this->belongsTo('App\Models\ContentModels\Module');
    }
}
