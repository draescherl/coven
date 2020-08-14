<?php $title = 'Filtrer les modèles'; ?>
<?php ob_start(); ?>

<style>
button:hover {
	padding: 0px 40px;
}
textarea {
	color: black;
}
</style>

<div class="container">
    <div class="row mt-20">
        <form action="" class="col s12" name="data">
            <!-- Brand field -->
            <div class="row">
                <div class="input-field col l4 s8 offset-l4 offset-s2">
                    <select name="brand" id="brand">
                        <option value="" disabled selected>Choisissez votre marque</option>
                        <?php
                        foreach ($brands as $i => $value) {
                            echo("<option value=" . str_replace(' ', '_', $value) . ">$value</option>\n");
                        }
                        ?>
                    </select>
                    <label>Marque</label>
                </div>
            </div>

            <!-- Vehicle type field -->
            <div class="row">
                <div class="input-field col l4 s10 offset-l4 offset-s1">
                    <select name="vehicle_type" id="vehicle_type">
                        <option value="" disabled selected>Choisissez votre catégorie de voiture</option>
                        <?php
                        foreach ($vehicle_type as $i => $value) {
                            echo("<option>$value</option>\n");
                        }
                        ?>
                    </select>
                    <label>Style de voiture</label>
                </div>
            </div>

            <!-- Model year field -->
            <div class="row">
                <div class="input-field col l4 s8 offset-l4 offset-s2">
                    <select name="model_year" id="model_year">
                    <option value="" disabled selected>Choisissez l'année</option>
                        <?php
                        foreach ($model_year as $i => $value) {
                            echo("<option>$value</option>\n");
                        }
                        ?>
                    </select>
                    <label>Année de production</label>
                </div>
            </div>

            <!-- Price field -->
            <div class="row">
                <div class="row">
                    <div class="input-field col l2 s4 offset-l4 offset-s2">
                        <input placeholder="Prix min" name="minprice" id="minprice" type="number" class="validate">
                    </div>
                    <div class="input-field col l2 s4">
                        <input placeholder="Prix max" name="maxprice" id="maxprice" type="number" class="validate">
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="input-field center-align">
                <button class="btn waves-effect waves-light " type="submit" id="submit">Rechercher
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container" id="results"> </div>

<script>
    // Changes the image to the back of the car on mouse over
    function mouseover(id, src) {
        document.getElementById(id).src = src;
    }

    // Changes the image to the front of the car on mouse out
    function mouseout(id, src) {
        document.getElementById(id).src = src;
    }

    $(document).ready(function() {

        $("#submit").click(function(e){
			e.preventDefault();

            var fd = new FormData(document.forms.namedItem("data"));
			$.ajax({
				url:'model/filter/filter.php',
				type: 'POST',
				data: fd,
                processData: false,
				contentType: false,
				success: function(response) {
                    $("#results").html(response);
                }
			});
        });
        
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>