<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['user_id','survey_id','response_id', 'question_id', 'answer_text', 'option_id'];

    public function response()
    {
        return $this->belongsTo(Response::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

     public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

     

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
