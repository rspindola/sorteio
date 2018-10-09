<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Voto;

class Item extends Model
{
    protected $fillable = ['id','titulo', 'imagem'];

    public function voto()
    {
        return $this->hasMany(Voto::class);
    }
}
