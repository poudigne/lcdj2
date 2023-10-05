@extends('layout')

@section('title', 'Jeux')

@section('content')
    <style>
    #search {
        margin-top:2px;
        background-color: #7297bb;
        color:#262532;
    }
    #games.thumbnail {
        background-color: rgba(114, 151, 187, 0.53);
    }
</style>

<div class="row">
    <div class="col-sm-3 col-md-3">
        <div class="list-group">
            <h4><p class="text-center">Type de jeux</p></h4>
            <button id="search" name="puzzle" class="list-group-item">Casse tête</button>
            <button id="search" name="kids" class="list-group-item">Jeunesse</button>
            <button id="search" name="puzzle" class="list-group-item">Casse tête</button>
        </div>
        <div class="list-group">
            <h4><p class="text-center">Âge</p></h4>
            <button id="search" name="puzzle" class="list-group-item">1 à 3</button>
            <button id="search" name="kids" class="list-group-item">4 à 6</button>
            <button id="search" name="puzzle" class="list-group-item">7 à 9</button>
            <button id="search" name="puzzle" class="list-group-item">10 à 12</button>
            <button id="search" name="puzzle" class="list-group-item">13 à 17</button>
            <button id="search" name="puzzle" class="list-group-item">18 et plus</button>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">

            <!-- Start of 1 item -->
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">First Product</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    </div>
                </div>
            </div>
            <!-- End of 1 item -->

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">Second Product</a>
                        </h4>
                        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">Third Product</a>
                        </h4>
                        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">Fourth Product</a>
                        </h4>
                        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">Fifth Product</a>
                        </h4>
                        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div id="games" class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4><a href="#">Sixth Product</a>
                        </h4>
                        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

        </div> <!-- Row -->
    </div> <!-- col md 9 -->
</div> <!-- Row -->

@stop


