<?php $title = '401'; ?>
<?php ob_start(); ?>


<!-- Unauthorized access message -->
<div class="container">
    <h2 class="center-align">Vous n'avez pas accès à cette page.</h2>
    <div class="center-align">
        <img src="static/img/no.gif" alt="no">
    </div>
    <div class="center-align">
        <a href="/?action=home" class="btn waves-effect waves-light">Retour au site</a>
    </div>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>