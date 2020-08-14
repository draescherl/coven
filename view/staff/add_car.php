<?php 
$title = 'Ajouter annonce';

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

	<div class="row">
		<form action="" class="col s12" name="data">

			<div class="row">
				<!-- Car brand -->
				<div class="input-field col l6 m6 s12">
					<select id="brand_select" name="brand">
						<option value="" disabled selected>Marque de la voiture</option>
						<?php
						foreach ($brands as $i => $value) {
							echo("<option value='$value'>$value</option>\n");
						}
						?>
					</select>
					<label>Marque</label>
				</div>

				<!-- Car model -->
				<div class="input-field col l6 m6 s12">
					<select id="model_select" name="model">
						<option value="" disabled selected>Modèle de la voiture</option>
					</select>
					<label>Modèle</label>
				</div>
			</div>

            <div class="row">
				<!-- Vehicle type field -->
                <div class="input-field col l4 m4 s12">
                    <select name="vehicle_type" id="vehicle_type">
                        <option value="" disabled selected>Catégorie</option>
                        <?php
                        foreach ($vehicle_type as $type) {
                            echo("<option>$type</option>\n");
                        }
                        ?>
                    </select>
                    <label>Style de voiture</label>
				</div>
				
				<!-- Model year field -->
				<div class="input-field col l4 m4 s12">
                    <select name="model_year" id="model_year">
                    <option value="" disabled selected>Année de production</option>
                        <?php
                        foreach ($model_year as $year) {
                            echo("<option>$year</option>\n");
                        }
                        ?>
                    </select>
                    <label>Année de production</label>
				</div>
				
				<!-- Car price -->
				<div class="input-field col l4 m4 s12">
					<input id="price" type="number" name="price" class="validate">
					<label for="price">Prix</label>
				</div>
            </div>

			<div class="row">
				<!-- Car description -->
				<div class="input-field col s12">
					<textarea id="desc" name="desc" class="materialize-textarea"></textarea>
					<label for="desc">Description rapide</label>
				</div>
			</div>

			<div class="row">
				<!-- Front of the car -->
				<div class="file-field input-field col l6 m6 s12">
					<div class="btn">
						<span>Photo</span>
						<input type="file" name="file_front">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Photo de l'avant" id="front_picture">
					</div>
				</div>

				<!-- Back of the car -->
				<div class="file-field input-field col l6 m6 s12">
					<div class="btn">
						<span>Photo</span>
						<input type="file" name="file_back">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Photo de l'arrière" id="back_picture">
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Other pictures -->
				<div class="file-field input-field col s12">
					<div class="btn">
						<span>Photo</span>
						<input type="file" name="file_others[]" multiple>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Autres photos" id="other_pictures">
					</div>
				</div>
			</div>

			<!-- Submit button -->
			<div class="input-field center-align">
				<button class="btn-large waves-effect waves-light" type="submit" id="submit">
					Valider <i class="material-icons right">send</i>
				</button>
			</div><br>
			
		</form>
	</div>
</div>


<script>
    $(document).ready(function() {

		// Code to change options in model select when the brand changes :
        $('#brand_select').on('change', function() {

            var selected_brand = $(this).val();
            $.ajax({
                url: 'model/staff/car-model-update_model.php',
                type: 'POST',
                data: {brand : selected_brand},
                dataType: 'json',
                success: function(response) {
                    $element = $('select#model_select');
                    $element.empty();
                    $element.append('<option value="" disabled selected>Modèle de la voiture</option>');
                    var toAppend = '';
                    $.each(response, function(key, value) {
                        toAppend += ('<option value="' + value + '">' + value + '</option> \n');
                    });
                    $element.append(toAppend);
                    $element.formSelect(); // Line required to make this code work with materialize v1.0.0
                }
            });

        });

		// Code to submit data :
		$("#submit").click(function(e){

			e.preventDefault();
			$("#submit").addClass('disabled');

			var fd = new FormData(document.forms.namedItem("data"));
			$.ajax({
				url: 'model/staff/add-car-to-database_model.php',
				type: 'POST',
				data: fd,
				processData: false,
				contentType: false,
				success: function(response) {
                    if (response == 'Success') {
						$("#results").html("<p>Voiture ajoutée avec succès !</p>");
						$("#results").addClass('card-panel white-text text-darken-2 teal lighten-2');
                    } else {
						$("#results").html("<p>Erreur lors de l'ajout ...</p>");
						$("#results").addClass('card-panel white-text text-darken-2 red');
					}
					$("#submit").removeClass('disabled');
                }
			});
		});

    });
</script>
        

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>