<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Voto extends Model
{
    protected $fillable = ['item_id', 'email', 'ip'];

    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id');
    }
}
