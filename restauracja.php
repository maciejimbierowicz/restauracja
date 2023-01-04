<?php include("config/functions.php"); 

session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$pdo = get_connection();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    </head>
    <body>
        <div class="main-content">
            <h2>Zarezerwuj stolik</h2>
            <form action="" method="POST">
                <label for="date">Data:</label>
                <input type="date" id="date" name="date">

                <label for="time">Godzina:</label>
                <input type="time" id="time" name="time">

                <label for="email" maxlength="120">E-mail:</label>
                <input type="email" id="email" name="email">

                <label for="phone" maxlength="12">Telefon:</label>
                <input type="tel" id="phone" name="phone">

                <label for="name" maxlength="120">Imię i nazwisko:</label>
                <input type="text" id="name" name="name">

                <label for="comment" maxlength="120">Komentarz:</label>
                <textarea id="comment" name="comment"></textarea>

                <div class="payment-icons">
                    <span><i class="fab fa-cc-visa fa-2x"></i></span>
                    <span><i class="fab fa-cc-mastercard fa-2x"></i></span>
                </div>

                <input type="submit" name="submit" value="Wyślij">
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    };
                ?>
            </form>
        </div>
    </body>
    
    <?php 

    if(isset($_POST['submit']))
    {   
        $date = $_POST['date'];
        $time = $_POST['time'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO rezerwacje SET
        date=:date,
        time=:time,
        email=:email,
        phone=:phone,
        name=:name,
        comment=:comment
        ";

        $result = $pdo -> prepare($sql);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':time', $time, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->execute();
        
        if($result == true)
        {
            $_SESSION['add'] = "<div class='success'>Rezerwacja przyjęta</div>";
            header('Location: restauracja.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Błąd przy tworzeniu rezerwacji</div>";
            header('Location: restauracja.php');
        }

    }
    ?>
</html>