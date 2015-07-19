@extends('layouts.default')

@section('content')
    <div class="ui internally celled grid">
        <div class="sixteen wide column">
            <input type="text" class="search" v-model="search" />
        </div>
        <div class="two wide black column">
            <div id="cardImageContainer">
                <img class="ui fluid image" id="cardImage" src="/images/Magic_Card_Back.png" />
            </div>
        </div>
        <div class="four wide olive column">
            <div id="mainDeck">
                <div v-repeat="card: mainDeck">
                    <div>@{{ card.name }}</div>
                </div>
            </div>
        </div>
        <div class="ten wide grey column">
            <div class="ui siz column grid">
                <div class="six column row">
                    <div class="red column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Red' in 'colors' | filterBy search | orderBy orderKey" v-if="card.colors.length == 1">
                            <div class="item" v-if="card.colors.length == 1" v-on="click: addCard(card)">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null" v-if="card.colors.length == 1">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated" v-if="card.colors.length == 1">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="green column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Green' in 'colors' | filterBy search | orderBy orderKey">
                            <div class="item" v-on="mouseover: getImage(card.number)">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="yellow column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'White' in 'colors' | filterBy search | orderBy orderKey">
                            <div class="item" v-on="mouseover: getImage(card.number)">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="blue column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Blue' in 'colors' | filterBy search | orderBy orderKey">
                            <div class="item" v-on="mouseover: getImage(card.number)">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="black column">
                        <div class="ui horizontal list" v-repeat="card: cards | filterBy 'Black' in 'colors' | filterBy search | orderBy orderKey">
                            <div class="item" v-on="mouseover: getImage(card.number)">@{{ card.name }}</div>
                            <div class="item" v-if="card.power != null">@{{ card.power }}/@{{ card.toughness }}</div>
                            <div class="item right floated">@{{{ card.manaCost }}}</div>
                        </div>
                    </div>
                    <div class="grey column">
                        <div class="ui horizontal list" v-repeat="card: cards | colorless">
                            <div class="item" v-on="mouseover: getImage(card.number)">@{{ card.name }}</div>
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
        // OrderBy Options:  cmc, type, colors
        Vue.filter('colorless', function (cards) {
            var colorlessCards = [];
            $.each(cards, function (key, card) {
                if (typeof card.colors === 'undefined' || card.colors.length > 1) {
                    colorlessCards.push(card);
                }
            });

            return colorlessCards;
        });

        new Vue({
            el: 'body',

            data: {
                cards: window.cards,
                mainDeck: [],
                colors: [],
                search: '',
                orderKey: 'cmc'
            },

            methods: {
                toggleColor: function (color) {
                    this.colors.$add(color, color);
                    $(object).removeClass('disabled');
                },
                getImage: function (id) {
                    var url = '/image/'+ id;

                    this.$http.get(url, function (data, status, request) {
                        $('#cardImage').attr('src', 'data:image/png;base64,'+ data);
                    });
                },
                addCard: function (card) {
                    this.mainDeck.$add(card.id, card);
                    console.log(this.mainDeck);
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