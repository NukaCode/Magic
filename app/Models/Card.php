<?php

namespace App\Models;

class Card extends BaseModel
{

    public $table = 'cards';

    public $fillable = [
        'series_id',
        'layout',
        'type',
        'types',
        'colors',
        'multiverseid',
        'name',
        'names',
        'subtypes',
        'cmc',
        'rarity',
        'artist',
        'power',
        'toughness',
        'manaCost',
        'loyalty',
        'text',
        'flavor',
        'number',
        'imageName'
    ];

    public $casts = [
        'names'    => 'array',
        'types'    => 'array',
        'colors'   => 'array',
        'subtypes' => 'array',
    ];

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

}