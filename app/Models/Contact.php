<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
  // Table Name
  protected $table = 'contacts';
  // Primary Key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;

  protected $fillable = ['name', 'subject','phone', 'email', 'message', 'ip_address', 'viewed', 'delete', 'reply_id', 'viewed_by'];

  public static function count_unread_contact()
  {
    return Contact::where("viewed", 0)->where('reply_id', null)->count();
  }

  public static function unread_contact_message()
  {
    return Contact::where("delete", 0)->where("viewed", 0)->where('reply_id', null)->orderByDesc("created_at")->get();
  }
}
