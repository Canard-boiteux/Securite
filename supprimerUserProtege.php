<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sécurisation des applications</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Favicon and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

        </head>

        <body>

            <!-- Top content -->
            <div class="top-content">
                    <div class="inner-bg">
                        <div class="container">
                            <div class="row" style="margin-top:-80px;">
                                <div class="col-sm-8 col-sm-offset-2 text">
                                    <h1></h1>

                                        <?php
                                        try {

                                            $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

                                            // On vérifie si l'utilisateur est bien admin
                                            if(isset($_SESSION['user']) && $_SESSION['user'] == "admin" && isset($_GET['user']) && !empty($_GET['user']) && isset($_POST['adminMdp']) && !empty($_POST['adminMdp']))
                                            {

                                                $password = htmlspecialchars(md5($_POST['adminMdp']));

                                                // requête préparée pour protéger
                                                $connection = $db->prepare('SELECT * FROM users WHERE login= ? AND pass=?');
                                                $connection->execute(array("admin",$password));

                                                $result = $connection->fetch(PDO::FETCH_OBJ);

                                                // si le mot de passe correspond à celui de l'admin
                                                if($result)
                                                {
                                                // On procède à la suppression
                                                    $connection = $db->prepare('DELETE FROM users WHERE login="'.htmlspecialchars($_GET['user']).'" ');
                                                    $result = $connection->execute();

                                                    if($result)
                                                    {
                                                        echo "<p class='alert alert-success'> L'utilisateur ".$_GET['user']." a bien été supprimé !</p>";
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<p class='alert alert-danger'>Echec de la connexion</p>";
                                                }

                                            }

                                            else { ?>
                                            <p>Si vous êtes sûr de vouloir supprimer cet utilisateur retapez votre mot de passe:</p>
                                            <form action="" method="post" class="login-form">
                                                <input type="text" name="adminMdp"><br><br>
                                                <button type="submit" class="btn" id="connexion">Supprimer</button>
                                            </form>

                                            <?php }

                                        } catch (PDOException $e) {
                                            print "Error!: " . $e->getMessage() . "<br/>";
                                            die();
                                        }

                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </body>
        </html>




