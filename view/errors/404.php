<?php $title = '404'; ?>
<?php ob_start(); ?>


<!-- Page not found message -->
<div class="container">
    <h2 class="center-align">La page demandée n'existe pas.</h2>
    <div class="center-align">
        <img src="static/img/lost.gif" alt="lost">
    </div>
    <div class="center-align">
        <a href="/?action=home" class="btn waves-effect waves-light">Retour au site</a>
    </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>