<?php $social_path = 'static/img/social/2/'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?='COVEN - ' . $title ?></title>

    <!-- favicon -->
    <link rel="icon" href="static/img/logos/favicon.ico">

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="static/css/materialize.css" type="text/css" rel="stylesheet" media="screen, projection"/>
    <link href="static/css/style.css" type="text/css" rel="stylesheet" media="screen, projection"/>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="static/js/materialize.js"></script>
    <script src="static/js/init.js"></script>
</head>
<body>
    
    <div class="site-container">
        <header class="site-header">
            <!-- Navbar on desktop -->
            <nav class="grey darken-2">
                <div class="nav-wrapper">
                    <a href="/?action=home" class="brand-logo"><img src="static/img/logos/logo.PNG" width="170" height="64"></a>
                    <a href="#" data-target="mobile-navbar" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <?php include ('navbar_links.php') ?>
                    </ul>
                </div>
            </nav>

            <!-- Navbar on mobile -->
            <ul class="sidenav" id="mobile-navbar">
                <?php include ('navbar_links.php') ?>
            </ul>
        </header>

        <main class="site-content">
            <!-- Floating Action Button -->
            <?php if($_SESSION['role'] >= 2): // If user is staff or admin ?>
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large grey"><i class="large material-icons">mode_edit</i></a>
                <ul>
                    <li><a href="/?action=add_car" class="btn-floating green tooltipped" data-position="left" data-tooltip="Ajouter voiture"><i class="material-icons">add</i></a></li>
                    <li><a href="/?action=delete_car" class="btn-floating red tooltipped" data-position="left" data-tooltip="Supprimer voiture"><i class="material-icons">delete</i></a></li>
                    <li><a href="/?action=check_reservations" class="btn-floating yellow tooltipped" data-position="left" data-tooltip="Consulter réservations"><i class="material-icons">notifications</i></a></li>

                    <?php if($_SESSION['role'] == 3): // If user is admin ?>
                    <li><a href='/?action=admin' class="btn-floating blue tooltipped" data-position="left" data-tooltip="Interface d'administration"><i class="material-icons">developer_board</i></a></li>
                    <?php endif ?>
                </ul>
            </div>
            <?php endif ?>
      
            <!-- Display page content -->
            <?= $content ?>
        </main>

        <footer class="site-footer grey darken-2 mt-20 page-footer">
            <div class="container">
                <div class="row">

                    <div class="col l4 s12 m6">
                        <article id="text-6" class="panel widget widget_text">
                            <h5 class="abrown-text">A propos de COVEN</h5>
                            <div class="textwidget">
                                <p>Des spécialistes de la location de voitures de luxe.</p>
                            </div>
                        </article>
                    </div>

                    <div class="col l4 s12 m6 offset-l4">
                        <article id="text-6" class="panel widget widget_text">
                            <h5 class="abrown-text">Social</h5>
                            <div class="textwidget">
                                <div class="social-icons">
                                    <a href="#"> <img width="20%" src=<?= $social_path . 'snapchat.png' ?>> </a>
                                    <a href="#"> <img width="20%" src=<?= $social_path . 'facebook.png' ?>> </a>
                                    <a href="#"> <img width="20%" src=<?= $social_path . 'twitter.png' ?>> </a>
                                    <a href="#"> <img width="20%" src=<?= $social_path . 'instagram.png' ?>> </a>
                                </div>
                            </div>
                        </article>
                    </div>

                </div>
            </div>

            <div class="footer-copyright">
                <div class="container">
                    © 2020 COVEN Cars
                </div>
            </div>
        </footer>
    </div>

</body>
</html>