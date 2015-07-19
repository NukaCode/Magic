<?php

namespace App\Models;

class Card extends BaseModel
{

    public $table = 'cards';

    protected $fillable = [
        'series_id', 'layout', 'type', 'types', 'colors', 'multiverseid', 'name', 'names', 'subtypes', 'cmc', 'rarity',
        'artist', 'power', 'toughness', 'manaCost', 'loyalty', 'text', 'flavor', 'number', 'imageName'
    ];

    protected $appends = ['manaCost'];

    protected $casts = [
        'names'    => 'array',
        'types'    => 'array',
        'colors'   => 'array',
        'subtypes' => 'array',
    ];

    public function getManaCostAttribute()
    {
        return preg_replace('/{(.)}/', '<img src="/images/blank.png" class="manaCost" id="$1" />', $this->attributes['manaCost']);
    }

    public function getImageAttribute()
    {
        return '<img src="data:image/png;base64,'. base64_encode(file_get_contents('http://gatherer.wizards.com/Handlers/Image.ashx?type=card&multiverseid='. $this->attributes['multiverseid'])) .'" />';
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

}