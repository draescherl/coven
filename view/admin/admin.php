<?php 
$title = 'Interface d\'administration';

// Prevents unauthorized access :
if ($_SESSION['role'] < 3) {
    header("Location: /?action=401");
}
ob_start(); 
?>

<style>
button:hover {
	padding: 0px 40px;
}
</style>

<div class="container">
    <div class="row">
		<div id="results" class="center-align col s12 m6 offset-m3"> </div>
	</div>

    <div class="row mt-20">
		<form action="" class="col s12">
        <h5 class="center-align">Modifier les rôles :</h5><br>
       
            <div class="row">
                <!-- User -->
                <div class="input-field col l3 m5 s12 offset-l2">
                    <select id="user_select">
                        <option value="" disabled selected>Utilisateur</option>
                        <?php
                        foreach($users as $i => $value){
                            echo('<option>' . $value->{"username"} . '</option>');
                        }
                        ?>
                    </select>
                    <label>Utilisateur</label>
                </div>

                <!-- Role -->
                <div class="input-field col l3 m5 s12">
                    <select id="role_select">
                        <option value="" disabled selected>Rôle</option>
                        <option value="1">Simple utilisateur</option>
                        <option value="2">Personnel</option>
                        <option value="3">Administrateur</option>
                        <option value="0">Supprimer compte</option>
                    </select>
                    <label>Rôle</label>
                </div>

                <!-- Submit button -->
                <div class="input-field col center-align l3 m2 s12">
                    <button class="btn waves-effect waves-light" type="submit" id="submit">
                        Valider <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-20">
		<form action="" class="col s12">
            <h5 class="center-align">Statut des voitures :</h5><br>
            <div class="row">
                <!-- Car -->
                <div class="input-field col l3 m5 s12 offset-l2">
                    <select id="car_select">
                        <option value="" disabled selected>Voiture</option>
                        <?php
                        foreach($cars as $i => $value){
                            echo('<option value="' . str_replace(' ', '_', $value->{"brand"}) . ' ' . str_replace(' ', '_', $value->{"model"}) . '">' . $value->{"brand"} . " " . $value->{"model"} . '</option>');
                        }
                        ?>
                    </select>
                    <label>Voiture</label>
                </div>

                <!-- booléen louée -->
                <div class="input-field col l3 m5 s12">
                    <select id="location_select">
                        <option value="" disabled selected>Statut</option>
                        <option value="0">Réservée</option>
                        <option value="1">Disponible</option>
                    </select>
                    <label>Statut</label>
                </div>

                <!-- Submit button -->
                <div class="input-field col center-align l3 m2 s12">
                    <button class="btn waves-effect waves-light" type="submit" id="second_submit">
                        Valider <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
		<form action="" class="col s12" name="data">
            <h5 class="center-align">Téléverser un fichier :</h5><br>
			<div class="row">
                
                <!-- File type select -->
				<div class="input-field col l3 m5 s12 offset-l2">
                    <select name="type" id="type">
                        <option value="" disabled selected>Type de fichier</option>
                        <option value="brand">Marque</option>
                        <option value="year">Année de production</option>
                        <option value="type">Type de véhicule</option>
                    </select>
                    <label>Type de fichier</label>
				</div>

				<!-- File input -->
				<div class="file-field input-field col l3 m5 s12">
					<div class="btn">
						<span><i class="material-icons">file_upload</i></span>
						<input type="file" name="file">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Fichier CSV" id="csv_field">
					</div>
                </div>
                
                <!-- Submit button -->
                <div class="input-field col center-align l3 m2 s12">
                    <button class="btn waves-effect waves-light" type="submit" id="upload">
                        Valider <i class="material-icons right">send</i>
                    </button>
                </div>
			</div>
		</form>
    </div>

    <div class="row">
		<div id="status" class="center-align col s12 m6 offset-m3"> </div>
	</div>

    <div class="row">
		<form action="" class="col s12" name="download">
            <h5 class="center-align">Télécharger les fichiers existants :</h5><br>
			<div class="row">
                <div class="input-field col center-align l6 s12 offset-l3">
                    <button class="btn waves-effect waves-light" type="submit" id="download">
                        Télécharger l'archive <i class="material-icons right">file_download</i>
                    </button>
                </div>
			</div>
		</form>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Code to change user roles :
		$("#submit").click(function(e){

            e.preventDefault();
            $("#submit").addClass('disabled');

			$.ajax({
				url: 'model/admin/update-user-role_model.php',
				type: 'POST',
				data: {
                    username: $('#user_select').val(),
                    role: $('#role_select').val()
                },
                dataType: 'json',
				success: function(response) {
                    if (response.success == true) {
                        $("#results").html("<p>Utilisateur modifié avec succès !</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 teal lighten-2');
                        $("#user_select option:selected").remove();
                        $('#user_select').formSelect();
                    } else {
                        $("#results").html("<p>Erreur lors de la modification de l'utilisateur ...</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 red');
                    }
                    $("#submit").removeClass('disabled');
                }
			});
        });

        // Rental status update :
        $("#second_submit").click(function(e){
            e.preventDefault();
            $("#second_submit").addClass('disabled');

            $.ajax({
                url: 'model/admin/update-car-status.php',
                type: 'POST',
                data: {
                    car: $('#car_select').val(),
                    status: $('#location_select').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success == true) {
                        $("#results").html("<p>Statut modifié avec succès !</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 teal lighten-2');
                    } else {
                        $("#results").html("<p>Erreur lors de la modification du statut ...</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 red');
                    }
                    $("#second_submit").removeClass('disabled');
                }
            });
        });
        
        // Code to upload files :
		$("#upload").click(function(e){

            e.preventDefault();
            $("#upload").addClass('disabled');

            var fd = new FormData(document.forms.namedItem("data"));
            $.ajax({
                url: 'model/admin/upload-csv-file.php',
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == 'success') {
                        $("#results").html("<p>Fichier ajouté avec succès !</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 teal lighten-2');
                    } else {
                        $("#results").html("<p>Erreur lors de l'ajout ...</p>");
                        $("#results").addClass('card-panel white-text text-darken-2 red');
                    }
                    $("#upload").removeClass('disabled');
                }
            });
        });

        // Code to download archive :
        $("#download").click(function(e){
            e.preventDefault();
            $("#download").addClass('disabled');

            $.ajax({
                url: 'model/admin/download-csv-files.php',
                type: 'POST',
                data: {download: 'Download'},
                dataType: 'text',
                success: function(response) {
                    // Fonctionnalité cassée ...
                    if (response == 'success') {
                        $("#status").html("<p>Téléchargement en cours.</p>");
                        $("#status").addClass('card-panel white-text text-darken-2 teal lighten-2');
                    } else {
                        $("#status").html("<p>Erreur lors du téléchargement.</p>");
                        $("#status").addClass('card-panel white-text text-darken-2 red');
                    }
                    $("#download").removeClass('disabled');
                }
            });
        });

        // Code to change options in status select when the car changes :
        $('#car_select').on('change', function() {

            var selected_car = $(this).val();
            $.ajax({
                url: 'model/admin/display_status.php',
                type: 'POST',
                data: {car : selected_car},
                dataType: 'json',
                success: function(response) {
                    $("#location_select").val(response);
                    $('#location_select').formSelect(); // Line required to make this code work with materialize v1.0.0
                }
            });
        });

        // Code to change options in status select when the car changes :
        $('#user_select').on('change', function() {

            var selected_user = $(this).val();
            $.ajax({
                url: 'model/admin/display_role.php',
                type: 'POST',
                data: {user : selected_user},
                dataType: 'json',
                success: function(response) {
                    $("#role_select").val(response);
                    $('#role_select').formSelect(); // Line required to make this code work with materialize v1.0.0
                }
            });
        });
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>