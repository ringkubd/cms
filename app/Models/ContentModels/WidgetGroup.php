<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class WidgetGroup extends Model
{
    protected $table = 'widget_groups';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
