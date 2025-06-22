<?php
    session_start();
    //tutaj zrobić gdy admin jest specjalne opcje do edycji SZCZEGÓLNOSCI USUWANIE POSTÓW!!!!!!!!!!

    require_once 'config.php';

    $polaczenie = mysqli_connect($host_name, $db_user, $db_password, $db_name);

    if(mysqli_connect_errno() > 0){
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_projects.css">
    <title>Rozwalka.com - UPLOADS</title>
</head>
<body>
        <div class="main">
        <div class="bg" id="1">
            <div class="info" id="2">
                <div class="info_1">
                    <h2>My projects</h2>
                    <p>
                        <span>As I said, I am working on different projects.</span>
                        <br><span>Below you can see many of this things!</span>
                    </p>
                    <!--<button id="button" onclick="change()">Light</button>-->
                    <!--<button id="button_2" onclick="change_2()">Dark</button>-->
                </div><br>
                <div class="info_1">
                    <h2 class="type_of_project">Thumbnails in Adobe Photoshop</h2><br>
                    <?php
                        $zapytanie = mysqli_query($polaczenie, "SELECT LINK, ALT FROM images");
                        $lp = 1;
                        while($wiersz = mysqli_fetch_assoc($zapytanie)){
                            $link_of_image = $wiersz['LINK'];
                            $alt_of_image = $wiersz['ALT']; 
                            echo '<div class="row">
                            <div class="column" id="img_'.$lp.'"><img src="'.$link_of_image.'" class="thumbnail"><figcaption>'.$alt_of_image.'</figcaption></div>
                            ';
                            if(isset($_SESSION['admin'])){
                                echo '<button onclick="hide('.$lp.')">UKRYJ</button>';
                            }
                            $lp++;
                            ;
                        }
                        while($wiersz = mysqli_fetch_assoc($zapytanie)){
                            $link_of_image_2 =$wiersz['LINK'];
                            $alt_of_image_2 = $wiersz['ALT'];
                            echo '
                            <div class="column_2" id="img_'.$lp.'"><img src="'.$link_of_image_2.'" class="thumbnail"><figcaption>'.$alt_of_image_2.'</figcaption></div>
                            </div>
                            ';
                            if(isset($_SESSION['admin'])){
                                echo '<button onclick="hide('.$lp.')">UKRYJ</button>';
                            }
                            $lp++;
                        }
                    ?>
                </div>
            </div>
        </div>
        <footer>
            <span id="footer_description"></span>
        </footer>
        <script src="hidingUpload.js"></script>
</body>
</html>