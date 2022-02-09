<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class)->where('user_id', '=', auth()->id());
    }
    public function results()
    {
        return $this->hasMany(Result::class)->where('user_id', '=', auth()->id());
    }

}
