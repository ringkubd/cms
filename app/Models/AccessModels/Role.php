<?php

namespace App\Models\AccessModels;

use Illuminate\Database\Eloquent\Model;
use App\user;

class Role extends Model
{
    
    // Table Name
    protected $table = 'roles';

    // Primary Key
    public $primaryKey = 'id';
    
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
