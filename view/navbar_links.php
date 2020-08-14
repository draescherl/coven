<?php if($_SESSION['role'] > 0): // If user is logged in ?>
    <li><a href="/?action=chat"><i class='material-icons left'>message</i> <b>Messagerie</b> </a></li>
<?php endif ?>

<li><a href='/?action=filter'><i class='material-icons left'>list</i> <b>Filtrer les modèles</b> </a></li>
<li><a href='/?action=who_are_we'><i class='material-icons left'>contact_support</i> <b>Qui sommes nous ?</b> </a></li>
<li><a href='/?action=profile'><i class='material-icons left'>account_circle</i> <b>Mon profil</b> </a></li>
&nbsp;
<!-- <li>
    <form>
        <div class='input-field'>
            <input id='search' type='search' required>
            <label class='label-icon' for='search'><i class='material-icons'>search</i></label>
            <i class='material-icons'>close</i>
        </div>
    </form>
</li> -->