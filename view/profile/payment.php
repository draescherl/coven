<?php 
$title = 'Paiement';

// Redirects to login page if user is not logged in :
if ($_SESSION['role'] == 0) {
    header("Location: /?action=login");
}
ob_start();
?>

<!-- Modal Structure -->
<div id="confirm" class="modal">
    <div class="modal-content">
        <h4>Status du paiement :</h4>
        <p id="resultat"></p>
    </div>
    <div class="modal-footer">
        <a href="?/action=home" class="modal-close waves-effect waves-green btn-flat">Confirmer</a>
    </div>
</div>

<div class="container">
    <div id="cart" class="col s12">
        <h4 class="center-align">Récapitulatif</h4>
        <table class="highlight centered">
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Prix par jour</th>
                    <th>Prix total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td id="brand"><?= str_replace('_', ' ', $car[0]) ?></td>
                    <td id="model"><?= str_replace('_', ' ', $car[1]) ?></td>
                    <td id="price"><?= $car[2] ?></td>
                    <td id="final-price"><?= $car[2] ?></td>
                </tr>
            </tbody>
      </table>
    </div>
    <br>

<!-- credit card and shipping infos -->
    <h4 class="center-align">Paiement et Adresses</h4>
    <div class="row">
        <div class="input-field col xl2 l4 m6 s12 offset-xl5 offset-m3 offset-l4">
			<select id="days_select" name="days">
                <?php for ($i = 1; $i <=30 ; $i++) {
                    echo("<option value='$i'>$i</option>\n");
                } ?>
            </select>
			<label>Nombre de jours</label>
        </div>
    </div>
    <form action="">
    <div class="row">
        <div class="col s12 m6 l4 xl2 offset-xl2">
            <label for="cname">Nom sur la carte</label>
            <input type="text" id="cname" name="cardname" placeholder="Jean Dupont" required="" aria-required="true">
            <label for="ccnum">Numéro de carte</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required="" aria-required="true">
        </div>
        <div class="col s12 m6 l4 xl2">
            <label for="exp">Date d'expiration</label>
            <input type="text" id="exp" name="exp" placeholder="06/20" required="" aria-required="true">
            <label for="cvv">CVV</label>
            <input type="number" id="cvv" name="cvv" placeholder="352" class="validate" required="" aria-required="true">
        </div>
        <div class="col s12 m6 l4 xl2">
            <label for="area1">Adresse de livraison</label>
            <input type="text" id="area1" value="<?php echo $infos[0] ?>" required="" aria-required="true">
            <label for="area2">Ville</label>
            <input type="text" id="area2" value="<?php echo $infos[1] ?>" required="" aria-required="true">
            <label for="area3">Code Postal</label>
            <input type="text" id="area3" value="<?php echo $infos[2] ?>" required="" aria-required="true">   
        </div>
        <div class="col s12 m6 l4 xl2">
            <label for="area4">Adresse de facturation</label>
            <input type="text" id="area4" value="<?php echo $infos[3] ?>" required="" aria-required="true">
            <label for="area5">Ville</label>
            <input type="text" id="area5" value="<?php echo $infos[4] ?>" required="" aria-required="true">
            <label for="area6">Code Postal</label>
            <input type="text" id="area6" value="<?php echo $infos[5] ?>" required="" aria-required="true">
        </div>
    </div>
    </form>
    <div class="row">
        <div class="center-align">
            <!--<input data-target="confirm" type="submit" id="submit" value="Procéder au paiement" class="btn mt-20">-->
            <button data-target="confirm" class="btn-large modal-trigger waves-effect waves-light" id="submit">
            Procéder au paiement
            </button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Code to change options in model select when the brand changes :
        $('#days_select').on('change', function() {

            var selected_days = $(this).val();
            $.ajax({
                url: 'model/profile/calc_price.php',
                type: 'POST',
                data: {
                    days: selected_days,
                    price: $("#price").text()
                },
                dataType: 'json',
                success: function(response) {
                    $("#final-price").html(response + "€");
                }
            });

        });

        $("#submit").click(function(e){
			e.preventDefault();

			$.ajax({
				url:'model/profile/payment-processing.php',
				type: 'POST',
				data: {
                    brand: $("#brand").text(),
                    model: $("#model").text(),
                    price: $("#final-price").text()
                },
                dataType: 'json',
				success: function(response) {
                    if(response.success == true){ 
                        $("#resultat").text('Paiement effectué avec succès!'); 
                    } 
                },
                error: function() {
                    $('#resultat').text('Erreur lors du paiement.');
                }
			});
        });
        
    });
</script>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>