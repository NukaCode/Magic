<?php

namespace App\Http\Controllers;

use AlgoliaSearch\Client;
use App\Models\Card;
use Illuminate\Cache\Repository;

class HomeController extends Controller
{

    public function index(Card $card)
    {
        $cards = $card->where('type', '!=', 'Land')->get();

        $this->setJavascriptData(compact('cards'));
    }

    public function image(Repository $cache, $id)
    {
        if ($cache->has($id)) {
            return $cache->get($id);
        }

        $card = base64_encode(file_get_contents('http://magiccards.info/scans/en/ori/' . $id . '.jpg'));
        $cache->put($id, $card, 60);

        return $card;
    }

    public function search(Repository $cache, $search = 'enchantment')
    {
        $client = new Client(config('algolia.connections.main.id'), config('algolia.connections.main.key'));

        //if ($cache->has('origins.'. $search)) {
        //    $cards = $cache->get($search);
        //} else {
        $index = $client->initIndex(config('algolia.index'));
        $index->setSettings(['attributesForFaceting' => ['colors', 'multiverseid']]);
        $cards = $index->search($search, ['facets' => '*', 'facetFilters' => 'colors:Green'])['hits'];

        foreach ($cards as $index => $card) {
            if (isset($card['manaCost'])) {
                $cards[$index]['manaCost'] = preg_replace('/{(.)}/', '<img src="/images/blank.png" id="$1" />', $card['manaCost']);
            }
        }

        $cache->forever($search, $cards);
        //}

        $this->setJavascriptData(compact('cards'));
    }

}