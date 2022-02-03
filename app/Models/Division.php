<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    public function districts()
    {
        return $this->hasMany(District::class);
    }
    public function imams()
    {
        return $this->hasMany(Imam::class);
    }
    public function hujurs()
    {
        return $this->hasMany(Hujur::class);
    }
    public function maszids()
    {
        return $this->hasMany(Maszid::class);
    }
    public function madrasas()
    {
        return $this->hasMany(Madrasa::class);
    }

}
