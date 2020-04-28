<?php
session_start();
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
  header('Location:index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/login.css" />
    <title>Document</title>
  </head>
  <body>
    <div class="hero">
      <div class="form-box">
        <div class="button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="login()">
            Zaloguj
          </button>
          <button type="button" class="toggle-btn" onclick="register()">
            Zarejestruj
          </button>
        </div>
        <form class="input-group" id="login" action="./skryptyPHP/zaloguj.php" method="post">
<?php
if(isset($_SESSION['bladLogowania'])){
echo $_SESSION['bladLogowania'];
}
?>

          <input
            name="emaill"
            type="text"
            class="input-field"
            placeholder="Enter email"
            required
          />
          <input
            name="hasloo"
            type="text"
            class="input-field"
            placeholder="Enter password"
            required
          />
          <button type="submit" class="submit-btn">Zaloguj</button>
        </form>
        <form id="register" class="input-group">
          <input type="date" class="input-field" />
          <input
            type="text"
            class="input-field"
            placeholder="Enter email"
            required
          />
          <input
            type="text"
            class="input-field"
            placeholder="Enter password"
            required
          />
          <input type="checkbox" class="check-box" /><span
            >i agree to the terms</span
          >
          <button type="submit" class="submit-btn">Register</button>
        </form>
      </div>
    </div>

    <script>
      var x = document.getElementById("login");
      var y = document.getElementById("register");
      var z = document.getElementById("btn");

      function register() {
        x.style.left = "-400px";
        y.style.left = "15px";
        z.style.left = "110px";
      }
      function login() {
        x.style.left = "5px";
        y.style.left = "450px";
        z.style.left = "0";
      }
    </script>
  </body>
</html>
