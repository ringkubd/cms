<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class CaseStudyRelation extends Model
{
  // Table Name
  protected $table = 'case_study_relations';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function case_study()
  {
    return $this->hasOne("App\Models\ContentModels\CaseStudyRelation", "post_id", "id")
      ->where('is_active', 1);
  }

  public function student()
  {
    return $this->hasOne("App\Models\InfoModel\Student", 'id', 'student_id');
  }
}
