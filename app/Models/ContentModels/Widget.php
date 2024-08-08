<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = 'widgets';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'active', 'title', 'slug', 'picture', 'description', 'user_id', 'is_delete',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
