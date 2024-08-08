<?php

namespace App\Models\InfoModel;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Table Name
    protected $table = 'students';

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

    public function round()
    {
        return $this->belongsTo('App\Models\InfoModel\Round');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\InfoModel\Course');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\InfoModel\Position');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\InfoModel\Company');
    }
}
