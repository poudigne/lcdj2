<nav class="navbar navbar-findcond navbar-static-top" style="margin-bottom:1px; border-color:#262532;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('public.index') }}">Le Coin du Jeu</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{ route('public.index') }}">Accueil <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{ route('public.games') }}">Jeux <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{ route('public.cards') }}">Cartes <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{ route('public.events') }}">Évènements <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{ route('public.contact') }}">Contact <span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
    </div>
</nav>