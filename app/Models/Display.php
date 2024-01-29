<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    use HasFactory;
    protected $table = 'display';

    public function hadiah()
    {
        return $this->belongsTo(Hadiah::class, 'id_hadiah');
    }
}
