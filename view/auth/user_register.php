<?php $title = 'Créer un compte'; ?>
<?php ob_start(); ?>

<?php 
// Error message is the passwords do not match :
if (isset($_POST['action'])) {
    if ($_POST['passwd'] !== $_POST['passwd_confirm']) {
        echo '<div class="container center-align"> <h3>Erreur, les mots de passe ne correspondent pas.</h3> </div>';
    } else {
        header("Location: /?action=home");
    }
}
?>

<div class="row login">
    <div class="col s12 l4 offset-l4">
        <form action="" method="POST">
            <div class="card">
                
                <div class="card-action teal white-text center-align">
                    <h3>Créer un compte</h3>
                </div>

                <div class="card-content">

                    <!-- Username field -->
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" name="username" type="text" class="validate" required>
                        <label for="username">Identifiant</label>
                    </div><br>

                    <!-- mail field -->
                    <div class="input-field">
                        <i class="material-icons prefix">email</i>
                        <input id="mail" name="mail" type="text" class="validate" required>
                        <label for="mail">E-mail</label>
                    </div><br>

                    <!-- Password field -->
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="passwd" name="passwd" type="password" class="validate" required>
                        <label for="passwd">Mot de passe</label>
                    </div><br>

                    <!-- Password confirmation field -->
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="passwd_confirm" name="passwd_confirm" type="password" class="validate" required>
                        <label for="passwd_confirm">Confirmer mot de passe</label>
                    </div><br>

                    <!-- Delivery address field -->
                    <div class="input-field">
                        <i class="material-icons prefix">location_on</i>
                        <textarea name="delivery_address" id="delivery_address" class="materialize-textarea" required></textarea>
                        <label for="delivery_address">Adresse de livraison</label>
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">location_city</i>
                        <textarea name="delivery_city" id="delivery_city" class="materialize-textarea" required></textarea>
                        <label for="delivery_city">Ville</label>
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">location_searching</i>
                        <textarea name="delivery_code" id="delivery_code" class="materialize-textarea" required></textarea>
                        <label for="delivery_code">Code postal</label>
                    </div><br>

                    <label>
                    <input type="checkbox" id="show" class="filled-in" checked="checked" />
                    <span>Même adresse de facturation et de livraison</span></label><br>

                    <!-- Billing address field -->
                    <div class="input-field" id="show-div" style="display:none">
                        <i class="material-icons prefix">location_on</i>
                        <textarea name="billing_address" id="billing_address" class="materialize-textarea"></textarea>
                        <label for="billing_address">Adresse de facturation</label>
                    </div>

                    <div class="input-field" id="show-div2" style="display:none">
                        <i class="material-icons prefix">location_city</i>
                        <textarea name="billing_city" id="billing_city" class="materialize-textarea"></textarea>
                        <label for="city">Ville</label>
                    </div>

                    <div class="input-field" id="show-div3" style="display:none">
                        <i class="material-icons prefix">location_searching</i>
                        <textarea name="billing_code" id="billing_code" class="materialize-textarea"></textarea>
                        <label for="city">Code postal</label>
                    </div>

                    <!-- Submit button -->
                    <div class="input-field center-align">
                        <button class="btn-large waves-effect waves-light" type="submit" name="action">
                            Valider <i class="material-icons right">send</i>
                        </button>
                    </div><br>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
 var n=1;
    $("#show").click(function(){
        if (n%2 == 0) {
            $("#show-div").hide()
            $("#show-div2").hide()
            $("#show-div3").hide()
        }else{
            $("#show-div").show()
            $("#show-div2").show()
            $("#show-div3").show()
        }
        n = n+1;
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>