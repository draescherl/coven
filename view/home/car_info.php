<?php 
$title = 'Info'; 
$img_path = 'media/cars/'; 
?>
<?php ob_start(); ?>



<!-- Modal Structure -->
<div id="confirm" class="modal">
    <div class="modal-content">
        <h4>Statut de la réservation.</h4>
        <p id="confirm-text"></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Confirmer</a>
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col l12">
                <article class="post-2366 post type-post status-publish format-standard has-post-thumbnail hentry category-ahuntsic tag-mtlcafecrawl moods-community moods-quiet purpose-social-meetups" id="post-2366">
                    <div class="row">
                        
                        <div class="col l8 s12">
                            <h2><?= $car['brand'] . ' - ' . $car['model'] ?></h2>
                            <div class="slider">
                                <ul class="slides">
                                    <li><img src=<?= $car['front'] ?> class="responsive-img wp-post-image"></li> 
                                    <li><img src=<?= $car['back'] ?> class="responsive-img wp-post-image"></li>
                                    <?php
                                    foreach ($car['others'] as $img) {
                                        echo "<li><img src=$img ?> class='responsive-img wp-post-image'></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="center-align mt-20">
                                <?php if($_SESSION['role'] > 0): ?>
                                    <?php if($car['reservation'] == true): ?>
                                        <button data-target="confirm" class="btn-large modal-trigger waves-effect waves-light disabled" id="submit">
                                           Ajouter au panier
                                        </button><p>Réservée</p><br>
                                    <?php else: ?>
                                        <button data-target="confirm" class="btn-large modal-trigger waves-effect waves-light" id="submit">
                                            Ajouter au panier
                                        </button><br>
                                    <?php endif ?>
                                <?php endif ?>
                                <a href="/?action=home" class="mt-20 btn-large waves-effect waves-light">Page d'accueil</a>
                            </div> 
                        </div>

                        <div class="col l4 s12">
                            <div class="card-panel alcaramel" style="min-height: 640px;">
                                <h6>DETAILS</h6><hr>
                                <span id="car_brand"><?= $car['brand'] ?></span><hr>
                                <span id="car_model"><?= $car['model'] ?></span><hr>
                                <span><?= $car['year'] ?></span><hr>
                                <span><?= $car['type'] ?></span><hr>
                                <span id="car_price"><?= $car['price'] ?>€</span><span> / jour</span><hr>
                                <span><?= $car['desc'] ?></span>
                            </div>
                        </div>
                    
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
 
        $("#submit").click(function(e){
            e.preventDefault();

            // Get data :
            var brand_text = $("#car_brand").text();
            var model_text = $("#car_model").text();
            var price_text = $("#car_price").text();

            // Replace spaces with underscores :
            var brand_post = brand_text.split(' ').join('_');
            var model_post = model_text.split(' ').join('_');
            var price_post = price_text.split(' ').join('_');

            $.post(
                'model/home/add-reservation.php',
                {
                    brand : brand_post,
                    model : model_post,
                    price : price_post
                },

                function(response) {
                    switch (response) {
                        case 'already_exists':
                            $("#confirm-text").text('Cette voiture est déjà dans votre panier.');
                            break;

                        case 'success':
                            $("#confirm-text").text('Voiture ajoutée au panier.');
                            break;
                    
                        default:
                            $("#confirm-text").text('Erreur interne lors de la réservation.');
                            break;
                    }
                },
                'text'
            );
        });

    });
</script>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>