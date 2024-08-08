<?php

namespace App\Models\AccessModels;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    // Table Name
    protected $table = 'menu_groups';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
