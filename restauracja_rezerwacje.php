<?php
include("config/functions.php"); 

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
      <h2>Lista Rezerwacji</h2>
      <?php
          if(isset($_SESSION['delete']))
          {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
          };
          ?>
      <div class="wrapper">
          <table class="tbl-50">
              <tr>
                  <th>id</th>
                  <th>Data</th>
                  <th>Godzina</th>
                  <th>E-mail</th>
                  <th>Telefon</th>
                  <th>Imię i Nazwisko</th>
                  <th>Komentarz</th>
                  
              </tr>
              <?php 
              
              $result = $pdo -> prepare("SELECT * FROM rezerwacje");
              $result->execute();
              $reservation_list = $result -> fetchAll();

              foreach($reservation_list as $row)
              {
                  $id = $row['id'];
                  $date = $row['date'];
                  $time = $row['time'];
                  $email = $row['email'];
                  $phone = $row['phone'];
                  $name = $row['name'];
                  $comment = $row['comment'];

                  ?>
                  <tr>
                      <td><?php echo $id; ?></td>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $phone; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $comment; ?></td>
                      
                  </tr>
                  
                  <?php
              }
              ?>
          </table>
      </div>
  </div>
</body>