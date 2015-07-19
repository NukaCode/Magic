<?php

namespace App\Http\Controllers;

use AlgoliaSearch\Client;
use App\Models\Card;
use App\Models\Series;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Filesystem $filesystem)
    {
        $cards = json_decode($filesystem->get(base_path('resources/assets/json/origins.json')));
        //ppd($cards);

        foreach ($cards as $index => $card) {
            if (isset($card->manaCost)) {
                $cards[$index]->manaCost = preg_replace('/{(.)}/', '<img src="/images/blank.png" id="$1" />', $card->manaCost);
            }
        }

        $this->setJavascriptData(compact('cards'));
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