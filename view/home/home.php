<?php 
$title = 'Accueil';
$img_path = 'media/cars/';
?>
<?php ob_start(); ?>
   <!-- Carousel cars -->
<div class="container">
    <div class="center-align" style="font-family:Times;">
        <h4 class="teal-text text-lighten-2"> 
            <i class="material-icons">all_inclusive</i> <b>Coven, spécialiste de la location de véhicules de luxe</b> <i class="material-icons">all_inclusive</i>
        </h4>
    </div>
    

    <br>
    <div class="row hide-on-med-and-down" > 
        <div class="col s12">
            <div class="carousel carousel-slider center z-depth-2" >
                <?php
                foreach ($latest_cars as $latest) {
                    ?>
                    <div class="carousel-item grey lighten-2" style="padding-bottom:10px;" >
                        <div class="row">
                            <div class="col s6">
                                <img src=<?= $latest['front'] ?> style="max-height: 275px; margin-bottom:10px;">
                                <br>
                            </div>
                            <div class="col s6" style="padding-right:100px;">
                                <h4 style="font-family:Impact; "><?= $latest['brand'] . ' - ' . $latest['model'] ?></h4>
                                <p><b><?= $latest['price'] . "€" ." / Jour" ?></b></p>
                                <p style="font-family:Times;"><b><?=$latest['desc'] ?></b></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <div class = "center-align" style="font-family:Times;">
        <h5 class="teal-text text-lighten-2"><b>Nos véhicules</b></h5>
    </div>
    <!-- All cars -->
    <div class="row">

        <?php
        foreach ($cars as $car) {
            ?>
            <div class="col s12 m6 l6 xl4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src=<?= $car['front'] ?> id=<?= $car['model'] ?> onmouseover="mouseover(this.id, '<?= $car['back'] ?>')" onmouseout="mouseout(this.id, '<?= $car['front'] ?>')">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b> <?= $car['brand'] ?> <i class="material-icons right">more_vert</i> <br> <?= $car['model'] ?></b> </span>
                        <p><a href=<?='/?action=car_info&car=' . str_replace(' ', '_', $car['brand']) . '-' . str_replace(' ', '_', $car['model']) ?>><b>Plus d'informations sur la voiture</b></a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><?= $car['brand'] ?> <i class="material-icons right">close</i> <br> <?= $car['model'] ?></span>
                        <p><b><?= $car['desc'] ?></b></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<script>
    // Changes the image to the back of the car on mouse over
    function mouseover(id, src) {
        document.getElementById(id).src = src;
    }

    // Changes the image to the front of the car on mouse out
    function mouseout(id, src) {
        document.getElementById(id).src = src;
    }
</script>
        

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>