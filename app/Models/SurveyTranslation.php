<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyTranslation extends Model
{
    protected $fillable = ['survey_id', 'language_code', 'title', 'description'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

     public $timestamps = true;
}
