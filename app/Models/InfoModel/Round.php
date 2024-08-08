<?php

namespace App\Models\InfoModel;

use App\Models\AccessModels\AdminMenu;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    // Table Name
    protected $table = 'rounds';

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
