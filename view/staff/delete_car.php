<?php 
$title = 'Supprimer annonce';

// Prevents unauthorized access :
if ($_SESSION['role'] < 2) {
    header("Location: /?action=401");
}
ob_start(); 
?>

<style>
button:hover {
	padding: 0px 40px;
}
textarea {
	color: black;
}
</style>


<div class="container">
    <div class="row">
		<div id="results" class="center-align col s12 m6 offset-m3"> </div>
	</div>
    
    <div class="row mt-20">
        <h4 class="center-align">Supprimer une voiture :</h4><br>
		<form action="" class="col s12" name="data">
       
            <div class="row">
                <!-- User -->
                <div class="input-field col l4 m6 s12 offset-l4 offset-m3">
                    <select id="car_select" name="car">
                        <option value="" disabled selected>Voiture</option>
                        <?php
                        foreach($cars as $i => $value) {
                            echo('<option value="' . str_replace(' ', '_', $value->{"brand"}) . ' ' . str_replace(' ', '_', $value->{"model"}) . '">' . $value->{"brand"} . " " . $value->{"model"} . '</option>');
                        }
                        ?>
                    </select>
                    <label>Voiture</label>
                </div>
            </div>

            <!-- Submit button -->
			<div class="input-field center-align">
				<button class="btn-large waves-effect waves-light" type="submit" id="submit">
					Supprimer <i class="material-icons right">send</i>
				</button>
			</div><br>

        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#submit").click(function(e){

            e.preventDefault();
            $("#submit").addClass('disabled');
            value = $('select#car_select').val();

			$.ajax({
				url: 'model/staff/delete_car_database.php',
				type: 'POST',
				data: {car : value},
				dataType: 'json',
				success: function(response) {
                    if (response.success == true) {
                        $("#results").html("<p>Voiture supprimée avec succès !</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 teal lighten-2');
                        $("select#car_select option[value='" + value + "']").remove();
                        $('select#car_select').formSelect();
                    } else {
                        $("#results").html("<p>Erreur lors de la suppression ...</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 red');
                    }
                    $("#submit").removeClass('disabled');
                },
                error: function(jqXHR, exception) {
                    alert('error');
                }
			});
        });
        
    });
</script>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>