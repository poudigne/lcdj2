@extends('layout')

@section('title', 'Évènements')

@section('content')
    
<div class="row">
    <div class="col-md-4 col-md-offset-2 col-sm-6 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-calendar"></span> 
                    Évenements réguliers
                </h3>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong">
                                    Jeu
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Soirée EDH
                            </h4>
                            <p>
                                Vivamus pulvinar mauris eu placerat blandit. In euismod tellus vel ex vestibulum
                                congue.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong">
                                    Jeu
                                </span>
                                </div>

                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Soirée Jeux de Société
                            </h4>
                            <p>
                                Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur
                                ultricies luctus.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong all-caps">
                                    Ven
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Friday Night Magic
                            </h4>
                            <p>
                                Sed convallis dignissim magna et dignissim. Praesent tincidunt sapien eu gravida
                                dignissim.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong all-caps">
                                    Sam
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Draft Magic The Gathering
                            </h4>
                            <p>
                                Sed convallis dignissim magna et dignissim. Praesent tincidunt sapien eu gravida
                                dignissim.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-calendar"></span> 
                    Évènements Spéciaux
                </h3>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong">
                                    Jan
                                </span>
                                </div>
                                <div class="panel-body day text-primary">
                                    10
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Journée Zombicide
                            </h4>
                            <p>
                                Vivamus pulvinar mauris eu placerat blandit. In euismod tellus vel ex vestibulum
                                congue.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong">
                                    Jan
                                </span>
                                </div>
                                <div class="panel-body day text-primary">
                                    16
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Pre Release Sealed
                            </h4>
                            <p>
                                Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur
                                ultricies luctus.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <div class="panel panel-primary text-center date">
                                <div class="panel-heading month">
                                <span class="panel-title strong all-caps">
                                    Jan
                                </span>
                                </div>
                                <div class="panel-body day text-primary">
                                    17
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                Pre Release Intro Pack War
                            </h4>
                            <p>
                                Sed convallis dignissim magna et dignissim. Praesent tincidunt sapien eu gravida
                                dignissim.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@stop

