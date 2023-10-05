@extends('layout')

@section('title', 'Contact')

@section('content')
    
<style>
    .form-control
    {
        background-color: rgba(97, 131, 164, 0.36);
    }
    .input-group-addon
    {
        background-color: rgba(97, 131, 164, 0.36);
    }
</style>

<div class="row-fluid">
    <div class="span8">
        <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2342.73027467845!2d-73.51341549290355!3d45.71120713214138!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc8e6c7cc3be94b%3A0x59e5a66c730cf97e!2sLe+coin+du+jeu!5e0!3m2!1sfr!2sca!4v1451435728467"></iframe>
    </div>
</div>
<div class="row" >
    <div class="col-md-8" >
        <div class="well well-sm">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" placeholder="Votre nom..." class="form-control" id="name" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse courriel</label>

                            <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                        </span>
                                <input type="email" placeholder="Votre adresse courriel..." class="form-control" id="email" required="required"/></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">Sujet</label>
                            <input type="text" placeholder="Sujet de votre message..." class="form-control" id="subject" required="required"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea style=" resize: none;" placeholder="Votre message..." name="message" id="message" class="form-control"
                                      rows="9" cols="25" required="required"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Envoyer
                            Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm">
            <form>
                <address>
                    <strong>Le Coin Du Jeu</strong><br>
                    313 Montée des Pionniers,<br>
                    Terrebonne, Québec,<br>
                    Canada, J6V 1H4<br>
                    <abbr title="Phone">
                        T:</abbr>
                    450 581 4444
                </address>
                <address>
                    <strong>Adresse courriel</strong><br>
                    <a href="mailto:#">lecoindujeu@hotmail.com</a>
                </address>
            </form>
        </div>
    </div>
</div>


@stop