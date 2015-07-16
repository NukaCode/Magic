@extends('layouts.default')

@section('content')
    <div id="results">
        <article v-repeat="card: cards">
            <h2>@{{ card.name }} @{{ card.type }}</h2>
            <p>@{{ card.text }}</p>
        </article>
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