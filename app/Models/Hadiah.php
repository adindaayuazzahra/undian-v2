<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    use HasFactory;
    protected $table = 'hadiah';

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_hadiah');
    }

    public function display()
    {
        return $this->hasOne(Display::class, 'id_hadiah');
    }
}
