<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'receiver_id',
        'sender_id',
    ];

    use HasFactory;
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function receiver()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
