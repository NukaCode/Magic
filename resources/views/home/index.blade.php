@extends('layouts.default')

@section('content')
    <div class="ui segments">
        <div class="ui horizontal segments" v-repeat="card: cards">
            <div class="ui segment" style="width: 80%;">@{{ card.name }}</div>
            <div class="ui segment" style="width: 10%;">
                <div  v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
            </div>
            <div class="ui segment" style="width: 10%;">@{{ card.manaCost }}</div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        console.log(window);
        new Vue({
            el: 'body',

            data: {
                cards: window.cards
            }

            {{--ready: function () {--}}
                {{--var client = algoliasearch("{{ config('algolia.connections.main.id') }}", "{{ config('algolia.connections.main.key') }}");--}}
                {{--var index = client.initIndex("{{ config('algolia.index') }}");--}}

                {{--index.search('enchantment', {hitsPerPage: 10, page: 0}, function(success, results) {--}}
                    {{--this.cards = results.hits;--}}
                {{--}.bind(this));--}}
            {{--}--}}
        });
    </script>
@endsection