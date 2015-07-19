<?php

namespace App\Models;

class Series extends BaseModel
{

    public $table = 'series';

    public $fillable = ['name', 'keyName', 'cards'];

    public function cards()
    {
        return $this->hasMany(Card::class, 'series_id');
    }

    public function setCardsAttribute($cards)
    {
        if (count($cards) > 0) {
            foreach ($cards as $card) {
                Card::create((array) $card);
            }
        }
    }

}