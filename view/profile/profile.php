<?php 
$title = 'Mon Profil';

// Redirects to login page if user is not logged in :
if ($_SESSION['role'] == 0) {
    header("Location: /?action=login");
}
ob_start(); 
?>

<div class="container"> 
    <!-- Tab selector --> 
    <ul class="tabs tabs-fixed-width z-depth-1">
        <li class="tab col s3"><a class="active" href="#cart">Mon panier</a></li>
        <li class="tab col s3"><a href="#profile">Mon profil</a></li>
        <li class="tab col s3"><a href="#history">Mon historique</a></li>
    </ul>

    <!-- Cart tab -->
    <div id="cart" class="col s12">
        <h4 class="center-align">Panier</h4>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Prix par jour</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($cart as $value) { ?>
                <tr>
                    <td><?= $value['date'] ?></td>
                    <td><?= str_replace('_', ' ', $value['brand']) ?></td>
                    <td><?= str_replace('_', ' ', $value['model']) ?></td>
                    <td><?= $value['price'] ?></td>
                    <td>
                        <?php $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/database/cars/' . $value['brand'] . '-' . $value['model'] . '.JSON');
                        $file = json_decode($file, true); ?>
                        <?php if ($file["reservation"] == true): ?>
                            <a href=<?= '/?action=delete_from_cart&id=' . $value['brand'] . '-' . $value['model'] ?> class="waves-effect waves-light btn red tooltipped disabled" data-position="left" data-tooltip="Supprimer réservation"><i class="material-icons">clear</i></a>
                            <a href=<?= '/?action=payment&id=' . $value['brand'] . '-' . $value['model'] . '-' . $value['price'] ?> class="waves-effect waves-light btn tooltipped disabled" data-position="right" data-tooltip="Passer commande"><i class="material-icons">check</i></a>
                            <span>Réservée</span>
                        <?php else: ?>
                            <a href=<?= '/?action=delete_from_cart&id=' . $value['brand'] . '-' . $value['model'] ?> class="waves-effect waves-light btn red tooltipped" data-position="left" data-tooltip="Supprimer réservation"><i class="material-icons">clear</i></a>
                            <a href=<?= '/?action=payment&id=' . $value['brand'] . '-' . $value['model'] . '-' . $value['price'] ?> class="waves-effect waves-light btn tooltipped" data-position="right" data-tooltip="Passer commande"><i class="material-icons">check</i></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
      </table>
    </div>

    <!-- Profile tab -->
    <div id="profile" class="col s12">
        <div class="center-align">
            <a href="/?action=logout" class="btn waves-effect waves-light mt-20">Déconnexion</a>
            <h4>Vos informations</h4>
        </div>

        <table class="highlight responsive-table">
            <tr>
                <th></th>
                <th>Information</th> 
                <th>Action</th>
            </tr>
            <tr>
                <th>Nom d'utilisateur</th>
                <td id='username_display'><?= $info['username'] ?></td> 
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="username_form" type="text" class="validate">
                                    <label for="username_form">Nom d'utilisateur</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_username" type="submit"> Modifier <i class="material-icons right">send</i> </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Mot de passe</th>
                <td id="password_display">Non visible</td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <input id="passwd_form" type="password" class="validate">
                                    <label for="passwd_form">Ancien mot de passe</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="new_passwd_form" type="password" class="validate">
                                    <label for="new_passwd_form">Nouveau mot de passe</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="verif_new_passwd_form" type="password" class="validate">
                                    <label for="verif_new_passwd_form">Confirmation nouveau mot de passe</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_passwd" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td id='first_name_display'><?= $info['first_name'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="first_name_form" type="text" class="validate">
                                    <label for="first_name_form">Prénom</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_first_name" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Nom</th>
                <td id='last_name_display'><?= $info['last_name'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="last_name_form" type="text" class="validate">
                                    <label for="last_name_form">Nom</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_last_name" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Mail</th>
                <td id='mail_display'><?= $info['mail'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="mail_form" type="email" class="validate">
                                    <label for="mail_form">Mail</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_mail" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Age</th>
                <td> <span id='age_display'><?= $info['age'] ?></span> <span> ans</span></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">cake</i>
                                    <input id="age_form" type="number" class="validate">
                                    <label for="age_form">Age</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_age" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Profession</th>
                <td id='job_display'><?= $info['job'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">business_center</i>
                                    <input id="job_form" type="text" class="validate">
                                    <label for="job_form">Travail</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_job" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Adresse de livraison</th>
                <td id='delivery_address_display'><?= $info['delivery_address'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">markunread_mailbox</i>
                                    <input id="delivery_address_form" type="text" class="validate">
                                    <label for="delivery_address_form">Adresse de livraison</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_delivery_address" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Ville</th>
                <td id='delivery_city_display'><?= $info['delivery_city'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="delivery_city_form" type="text" class="validate">
                                    <label for="delivery_city_form">Ville de livraison</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_delivery_city" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Code postal</th>
                <td id='delivery_code_display'><?= $info['delivery_code'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="delivery_code_form" type="number" class="validate">
                                    <label for="delivery_code_form">Code postal</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_delivery_code" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Adresse de facturation</th>
                <td id='billing_address_display'><?= $info['billing_address'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">markunread_mailbox</i>
                                    <input id="billing_address_form" type="text" class="validate">
                                    <label for="billing_address_form">Adresse de facturation</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_billing_address" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Ville</th>
                <td id='billing_city_display'><?= $info['billing_city'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="billing_city_form" type="text" class="validate">
                                    <label for="billing_city_form">Ville de facturation</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_billing_city" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Code Postal</th>
                <td id='billing_code_display'><?= $info['billing_code'] ?></td>
                <td>
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">mode_edit</i>Modifier</div>
                            <div class="collapsible-body">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="billing_code_form" type="text" class="validate">
                                    <label for="billing_code_form">Code postal de facturation</label>
                                </div>
                                <button class="btn red waves-effect waves-light teal lighten-2" id="submit_billing_code" type="submit">
                                    Modifier <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <!-- history tab -->
    <div id="history" class="col s12">
        <h4 class="center-align">Historique</h4>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Prix</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($payments as $value) { ?>
                    <tr>
                        <td><?= $value['date'] ?></td>
                        <td><?= str_replace('_', ' ', $value['brand']) ?></td>
                        <td><?= str_replace('_', ' ', $value['model']) ?></td>
                        <td><?= $value['price'] ?></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        $("#submit_username").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_username : $("#username_form").val(),
                    old_username : $("#username_display").text(),
                    type : 'username'
                },

                function(response) {
                    $('#username_display').html(response);
                },
                'text'
            );
        });

        $("#submit_passwd").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    old_passwd : $("#passwd_form").val(),
                    new_passwd : $("#new_passwd_form").val(),
                    verif_new_passwd : $("#verif_new_passwd_form").val(),
                    username : $("#username_display").text(),
                    type : 'passwd'
                },

                function(response) {
                    //alert(response);
                    $('#password_display').html('Mot de passe changé !');
                },
                'text'
            );
        });

        $("#submit_first_name").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_first_name : $("#first_name_form").val(),
                    username : $("#username_display").text(),
                    type : 'first_name'
                },

                function(response) {
                    $('#first_name_display').html(response);
                },
                'text'
            );
        });

        $("#submit_last_name").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_last_name : $("#last_name_form").val(),
                    username : $("#username_display").text(),
                    type : 'last_name'
                },

                function(response) {
                    $('#last_name_display').html(response);
                },
                'text'
            );
        });

        $("#submit_mail").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_mail : $("#mail_form").val(),
                    username : $("#username_display").text(),
                    type : 'mail'
                },

                function(response) {
                    $('#mail_display').html(response);
                },
                'text'
            );
        });

        $("#submit_age").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_age : $("#age_form").val(),
                    username : $("#username_display").text(),
                    type : 'age'
                },

                function(response) {
                    $('#age_display').html(response);
                },
                'text'
            );
        });

        $("#submit_job").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_job : $("#job_form").val(),
                    username : $("#username_display").text(),
                    type : 'job'
                },

                function(response) {
                    $('#job_display').html(response);
                },
                'text'
            );
        });

        $("#submit_delivery_city").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_delivery_city : $("#delivery_city_form").val(),
                    username : $("#username_display").text(),
                    type : 'delivery_city'
                },

                function(response) {
                    $('#delivery_city_display').html(response);
                },
                'text'
            );
        });

        $("#submit_delivery_code").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_delivery_code : $("#delivery_code_form").val(),
                    username : $("#username_display").text(),
                    type : 'delivery_code'
                },

                function(response) {
                    $('#delivery_code_display').html(response);
                },
                'text'
            );
        });

        $("#submit_delivery_address").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_delivery_adress : $("#delivery_address_form").val(),
                    username : $("#username_display").text(),
                    type : 'delivery_address'
                },

                function(response) {
                    $('#delivery_address_display').html(response);
                },
                'text'
            );
        });

        $("#submit_billing_address").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_billing_adress : $("#billing_address_form").val(),
                    username : $("#username_display").text(),
                    type : 'billing_address'
                },

                function(response) {
                    $('#billing_address_display').html(response);
                },
                'text'
            );
        });

        $("#submit_billing_code").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_billing_code : $("#billing_code_form").val(),
                    username : $("#username_display").text(),
                    type : 'billing_code'
                },

                function(response) {
                    $('#billing_code_display').html(response);
                },
                'text'
            );
        });

        $("#submit_billing_city").click(function(e){
            e.preventDefault();
            
            $.post(
                'model/profile/profile-info.php',
                {
                    new_billing_city : $("#billing_city_form").val(),
                    username : $("#username_display").text(),
                    type : 'billing_city'
                },

                function(response) {
                    $('#billing_city_display').html(response);
                },
                'text'
            );
        });

    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>