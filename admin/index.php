<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Rozwalka.com - ACCOUNT</title>
</head>
<body>
            <div class="content">
                <div class="info_1_1">
                    <h1>ADMINISTRATION PANEL</h1>
                    <form action="login.php" method="post">
                        <label for="login">LOGIN</label>
                        <input type="text" id="login" name="login" required>
                        <label for="password">PASSWORD</label>
                        <input type="password" id="password" name="password" required>
                        <input type="submit" value="ZALOGUJ">
                    </form>
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<br>";
                            echo '<span id="error">INCORRECT LOGIN OR PASSWORD!</span>';
                        }
                        else{
                            echo" ";
                        }
                    ?>
                    <span id="footer_description"></span>
                    <script>
                        const date = new Date();
                        const current_year = date.getFullYear();
                        document.getElementById("footer_description").innerHTML = `&copy; ${current_year} <a href="#">Rozwalka.com</a> All rights reserved`;
                    </script>
                </div>
            </div>
</body>
</html>