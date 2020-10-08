<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class Filmes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'autor',
        'resumo',
    ];
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
}
