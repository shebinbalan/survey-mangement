<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['title', 'description', 'created_by', 'time_limit'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function question()
{
    return $this->hasMany(Question::class)->orderBy('order');
}

public function responses()
{
    return $this->hasMany(Response::class);
}
public function translations()
{
    return $this->hasMany(SurveyTranslation::class);
}

}