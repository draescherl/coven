<?php $title = 'Se connecter'; ?>
<?php ob_start(); ?>

<div class="container">
    <div class="row">
		<div id="results" class="center-align col s12 m6 offset-m3"> </div>
    </div>
</div>

<div class="row login">
    <div class="col s12 l4 offset-l4">
        <div class="card">
            <div class="card-action teal white-text center-align">
                <h3>Se connecter</h3>
            </div>

            <div class="card-content">
                <!-- Username field -->
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="username" type="text" class="validate" required>
                    <label for="username">Identifiant</label>
                </div><br>

                <!-- Password field -->
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" class="validate" required>
                    <label for="password">Mot de passe</label>
                </div><br>

                <!-- Remember me checkbox -->
                <div class="input-field">
                    <p> 
                        <label> <input type="checkbox"> <span>Se souvenir de moi</span> </label> 
                    </p>
                </div><br>

                <!-- Submit button -->
                <div class="input-field center-align">
                    <button class="btn-large waves-effect waves-light" type="submit" id="submit">
                        Valider <i class="material-icons right">send</i>
                    </button>
                </div><br>

                <!-- Redirect to register -->
                <div class="input-field center-align">
                    <a href='/?action=register' class="btn-large waves-effect waves-light tooltipped" data-position="right" data-tooltip="S'inscrire">Pas de compte ?</a>
                </div><br>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
 
        $("#submit").click(function(e){
            e.preventDefault();

            $.post(
                'model/auth/login_model.php',
                {
                    username : $("#username").val(),
                    password : $("#password").val()
                },

                function(data) {
                    if (data == 'Success') {
                        window.location.href = '/?action=home';
                    } else {
                        $("#results").html("<p>Identifiant ou mot de passe incorrect.</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 red');
                    }
                },
                'text'
            );
        });

    });
</script>



<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>