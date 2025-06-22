<?php
session_start();

require_once 'config.php';

if(!isset($_SESSION['user_yes']) || (!isset($_SESSION['admin']))){
    header('Location: index.php');
}

$uploadOk = true;
$message = "";

// Sprawdzanie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzenie, czy plik został przesłany
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
        $file = $_FILES['fileToUpload'];
        $target_dir = "/.../projects/img";
        $target_file = $target_dir . basename($file['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Sprawdzenie, czy plik już istnieje
        if (file_exists($target_file)) {
            $message .= "Sorry, file already exists.<br>";
            $uploadOk = false;
        }

        // Sprawdzenie typu pliku
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_type, $allowed_types)) {
            $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = false;
        }

        // Przesłanie pliku, jeśli wszystkie warunki są spełnione
        if ($uploadOk) {
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $message .= "Plik " . htmlspecialchars(basename($file['name'])) . " został przesłany pomyślnie.<br>";
                $polaczenie = mysqli_connect($host_name, $db_user, $db_password, $db_name);
                if(mysqli_connect_errno() > 0){
                    echo "Connection error" . mysqli_connect_error();
                }
                $alt = $_POST['alt'];
                $zapytanie = mysqli_query($polaczenie, "INSERT INTO images (ALT, LINK) VALUES ('".$alt."', '".$target_file."')");
                mysqli_close($polaczenie);
            } else {
                $message .= "Sorry, your file was not uploaded.<br>";
            }
        }
    } 
    else {
        $message .= "Select a file!.<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <title>Rozwalka.com - ADMIN</title>
</head>
<body onload="hideMessage()">
    <script>
        function hideMessage(){
            const messageParagraph = document.getElementById('message');
            if(messageParagraph){
                setTimeout(() => {
                    messageParagraph.style.display = 'none';
                }, 7000);
            }
        }
    </script>
    <div class="content">
        <div class="info_1_1">
            <h2>UPLOAD A FILE</h2>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <input type="text" name="alt" id="alt" placeholder="Description of file" required><br>
                <input type="submit" value="Upload" name="submit">
            </form>
            <?php if (!empty($message)) { echo "<p id='message'>$message</p>"; } ?>
            <div class="start">
                <a href="logout.php"><button><span id="text_button">LOGOUT</span></button></a>
            </div>
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