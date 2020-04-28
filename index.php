<?php

session_start();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- font awesome -->
    <script src="js/all.js"></script>
    <title>Document</title>
  </head>
  <body>
    <!-- nav element-->
    <div
      style="background-image: url(./photos/freelancer-763730_1920.jpg);"
      class="menuNaw"
    >
  <ul>
      <li class="glowneMenu"><a href="">strona glowna</a></li>
      <li class="glowneMenu">
      wybierz jezyk
      <ul>
            <li id="angielski" class="podmenu">angielski</li>
            <li class="podmenu">francuski</li>
            <li class="podmenu">hiszpanski</li>
      </ul>
      </li>
      <li class="glowneMenu">third</li>
      <li class="glowneMenu">
            <?php
            if(isset($_SESSION['uzytkownik'])){
            echo "Witaj ".$_SESSION['imie']." !";
            echo "
              <ul>
              <li id='angielski' class='podmenu'> <a href='./skryptyPHP/wyloguj.php'>Wyloguj się</a></li>


              </ul>";
          }
            
            else{echo "<a href='loginPage.php'>Zaloguj się</a>";}     
            ?>
    </li>
  </ul>
    </div>
    <?php
    echo $_SESSION['uzytkownik'];
    ?>
    <!-- end nav element-->

    <!-- jquery -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- script js -->
    <script src="js/script.js"></script>
  </body>
</html>
