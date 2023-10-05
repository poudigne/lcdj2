<footer >
    <div class="footer" id="footer">
        <div class="container">
            <div class="row center-block">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 class="text-center"> Le Coin du Jeu </h3>
                    <ul class="text-center">
                        <li> <a href="{{ route('public.index') }}"> Accueil </a> </li>
                        <li> <a href="{{ route('public.games') }}"> Jeux </a> </li>
                        <li> <a href="{{ route('public.cards') }}"> Cartes </a> </li>
                        <li> <a href="{{ route('public.events') }}"> Évènements </a> </li>
                        <li> <a href="{{ route('public.contact') }}"> Contact </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 class="text-center"> Réseau Social </h3>
                    <ul class="social">
                        <li> <a target="_blank" href="https://www.facebook.com/lecoindujeu"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a target="_blank" href="#"> <i class="fa fa-twitch">   </i> </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 class="text-center"> Adresse </h3>
                    <ul class="text-center">
                        <li><strong>Le Coin Du Jeu</strong></li>
                        <li>313 Montée des Pionniers</li>
                        <li>Terrebonne, Québec</li>
                        <li>Canada, J6V 1H4</li>
                        <li><abbr title="Phone">T:</abbr>450 581 4444</li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Le Coin du Jeu <?php echo date('Y'); ?>. Tous droits réservés. </p>
        </div>
    </div>
    <!--/.footer-bottom-->
</footer>
