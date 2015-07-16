<?php

namespace App\Http\Controllers;

use AlgoliaSearch\Client;
use Illuminate\Cache\Repository;

class HomeController extends Controller
{

    public function index(Repository $cache, $search = 'enchantment')
    {
        $client = new Client(config('algolia.connections.main.id'), config('algolia.connections.main.key'));

        if ($cache->has($search)) {
            $cards = $cache->get($search);
        } else {
            $index        = $client->initIndex(config('algolia.index'));
            $cards = $index->search($search)['hits'];

            $cache->forever($search, $cards);
        }

        $this->setJavascriptData(compact('cards'));

        return view('home.index');
    }

}