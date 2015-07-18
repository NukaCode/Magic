@extends('layouts.default')

@section('content')
    <div class="ui internally celled grid">
        <div class="two wide black column">Info Panel</div>
        <div class="four wide olive column">Deck</div>
        <div class="ten wide grey column">
            <div class="ui siz column grid">
                <div class="six column row">
                    <div class="red column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Red' in colors">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="green column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Red' in colors">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="yellow column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'White' in colors">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="blue column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Blue' in colors">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="black column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'black' in colors">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="grey column">
                        <div class="ui horizontal list" v-repeat="card: cards| colorless">
                            <div class="item">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui buttons">
        <img class="ui circular disabled image" src="/images/blank.png" id="W" />
        <img class="ui circular disabled image" src="/images/blank.png" id="U" />
        <img class="ui circular disabled image" src="/images/blank.png" id="B" />
        <img class="ui circular disabled image" src="/images/blank.png" id="R" v-on="click: toggleColor('Red')" />
        <img class="ui circular disabled image" src="/images/blank.png" id="G" v-on="click: toggleColor('Green')" />
    </div>
    <div class="ui segment black inverted" v-model="colors">@{{ colors }}</div>
@endsection
@section('js')
    <script>
        Vue.filter('colorless', function (value) {
            console.log(value);
        });

        new Vue({
            el: 'body',

            data: {
                cards: window.cards,
                colors: []
            },

            methods: {
                toggleColor: function (color) {
//                    console.log(object);
                    this.colors.$add(color, color);

                    console.log(this.colors);
//                    $(object).removeClass('disabled');
                }
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