<?php $title = 'Qui sommes nous ?'; ?>
<?php 
$parallax_path = 'static/img/parallax/';
$social_path   = 'static/img/social/1/';
?>
<?php ob_start(); ?>

<!-- First picture --> 
<div style="width:100%;" class="parallax-container">
	<div class="parallax"><img src=<?= $parallax_path . 'ferrari-parallax.jpg' ?>></div>
</div>

<!-- First set of text --> 
<div class="section white">
	<div class="row container">
		<h2 class="header">Qui sommes nous ?</h2>
		<p class="grey-text text-darken-3 lighten-3">
			Coven est une société de location de véhicules haut de gamme vous proposant une palette de vehicules toutes catégories. 
			Arpentez des chemins sinueux avec aisance au volant de nos vehicules tout-terrains, repoussez les limites de votre moteur grâce à nos sportives ou optez pour un vehicule plus spatieux avec notre catégorie SUV. 
			Nous proposons un service de suivi unique auprès de tous nos clients pour une expérience optimale. <br>
			Go further.
		</p>
	</div>
</div>
<br>

<!-- Second picture --> 
<div class="parallax-container">
	<div class="parallax"><img src=<?= $parallax_path . 'mclaren-parallax.jpg' ?>></div>
</div>

<!-- Second set of text (social network links) --> 
<div class="center-align">
	<div class="section white">
		<div class="row container">
			<h3 class="header">Suivez-nous</h3>
			<div class="input-field col l2 s3 offset-s2">
				<a href="#"><img src=<?= $social_path . 'instagram.jpg' ?> width="70" height="70"> 
			</div>
			<div class="input-field col l2 s3 offset-s4">
				<a href="#"><img src=<?= $social_path . 'snap.jpg' ?> width="70" height="70"></a>
			</div>
			<div class="input-field col l2 s3 offset-s4">
				<a href="#"><img src=<?= $social_path . 'twitter.png' ?> width="70" height="70"></a>
			</div>
			<div class="input-field col l2 s3 offset-s4">
				<a href="#"><img src=<?= $social_path . 'facebook.jpg' ?> width="70" height="70"></a>
			</div>
			<div class="input-field col l2 s3 offset-s4">
				<a href="#"><img src=<?= $social_path . 'youtube.png' ?> width="65" height="70"></a>
			</div>
			<div class="input-field col l2 s3 offset-s4">
				<a href="#"><img src=<?= $social_path . 'twitch.png' ?> width="65" height="70"></a>
			</div>
		</div>
	</div>
</div>
    
<!-- Third picture --> 
<div class="parallax-container">
	<div class="parallax"><img src=<?= $parallax_path . 'bugatti-parallax.jpg' ?>></div>
</div>
  
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>