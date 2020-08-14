<?php
$price=rtrim($_POST['price'], "€");
echo($_POST['days']*$price);
?>