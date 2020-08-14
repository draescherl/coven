<?php 
$title = 'Consulter réservations';

// Prevents unauthorized access :
if ($_SESSION['role'] < 2) {
    header("Location: /?action=401");
}
ob_start(); 
?>


<div class="container">
    <table class="highlight responsive-table">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Date</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Prix</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($reservations as $username => $cart) { ?>
            <?php foreach ($cart as $items) { ?>
                <tr>
                <td><?= $username ?></td>
                <td><?= $items['date'] ?></td>
                <td><?= str_replace('_', ' ', $items['brand']) ?></td>
                <td><?= str_replace('_', ' ', $items['model']) ?></td>
                <td><?= $items['price'] ?></td>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
        

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>