<?php

session_start();
if(isset($_POST['email']))
{
  $email= $_POST['email'];

$poprawnyFormularz=true;

//sprawdzanie wartosci 

$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$dataUrodzenia = $_POST['data'];
$korepetytor = $_POST['korepetytor'];
//sprawdzenia dlugosci imie
if(strlen($imie)<3||(strlen($imie)>20)){
  $poprawnyFormularz = false;
  $_SESSION['e_imie']="imie musi posiadac od 3 do 20 znaków";
}

//SPRAWDZANIE POPRAWNOSCI HASLA

$haslo1 = $_POST['haslo1'];

$haslo2 = $_POST['haslo2'];

if((strlen($haslo1)<8) || (strlen($haslo1)>20))
{
  $poprawnyFormularz = false;
  $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
}
if($haslo1!= $haslo2){
    $poprawnyFormularz = false;
  $_SESSION['e_haslo']="Podane hasła nie są identyczne";
}
//hashowanie hasla
$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);

//sprawdzenie zakceptowania regulaminu

//sprawdzenie czy ktos juz nie założył konta 
require_once "skryptyPHP/skryptLaczacy.php";

mysqli_report(MYSQLI_REPORT_STRICT);
try
  {
  $polaczenie = new mysqli($host,$db_uzytkownik,"$db_haslo",$db_nazwa);
  if($polaczenie->connect_errno!=0)
  { 
  throw new Exception(mysqli_connect_errno());
  }else{
    //sprawdzenie maila w bazie
    $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email= '$email'");
    if(!$rezultat) throw new Exception($polaczenie->error);

    $ile_takich_maili = $rezultat->num_rows;
    if($ile_takich_maili>0)
    {
    $poprawnyFormularz = false;
    $_SESSION['e_emailJuzIstnieje']="Istnieje juz konto z takim emailem";
    }
    //Wszystko dziala tutaj insert nowy uzytknowik
        if($poprawnyFormularz==true)
        {
          if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$imie','$nazwisko','$dataUrodzenia','$email','$korepetytor','$haslo_hash')"))
          {
            $_SESSION['udanaRejestracja'] = true;
            header('Location: index.php');
          }else{
            throw new Exception($polaczenie->error);
          }
        }
    $polaczenie->close();

  }
  }catch(Exception $e){

  }
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
          <button id="przyciskrejestracji" type="button" class="toggle-btn" onclick="register()">
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
            type="email"
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
        <form method='POST' id="register" class="input-group">
          <input
            name="imie"
            type="text"
            class="input-field"
            placeholder="Imię"
            required
          />
          <?php
          if(isset($_SESSION['e_imie'])){
            echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
          }
          ?>
          <input
            name="nazwisko"
            type="text"
            class="input-field"
            placeholder="Nazwisko"
            required
          />
            <input
            name="email"
            type="email"
            class="input-field"
            placeholder="Email"
            required
          />
          <?php
          if(isset($_SESSION['e_emailJuzIstnieje'])){
            echo '<div class="error">'.$_SESSION['e_emailJuzIstnieje'].'</div>';
          }
          ?>
          <input name="data" type="date" class="input-field" />
            <input
            name="haslo1"
            type="text"
            class="input-field"
            placeholder="Hasło"
            required
          />

          <?php
          if(isset($_SESSION['e_haslo'])){
            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
          }
          ?>
            <input
            name="haslo2"
            type="text"
            class="input-field"
            placeholder="Powtórz hasło"
            required
          />

          <div style= "height:50px; display:block;width:max;" class="xxx"><input name="korepetytor" type="checkbox" class="check-box" />
          <span style= "position:absolute;bottom:61px;right:10px;display:block;width:200px;margin:0px;"class="tekstRejestracja">i agree to the terms</span></div>
          <div style= "height:50px; display:block;width:max;" class="xxx"><input name="regulamin" type="checkbox" class="check-box" />
          <span style= "position:absolute;bottom:111px;right:10px;display:block;width:200px;margin:0px;"class="tekstRejestracja">i agree to the terms</span></div>
          <button type="submit" class="submit-btn">Zarejestruj się</button>

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
          <?php
          if(isset($_SESSION['e_imie'])){
            echo '<script>document.getElementById("przyciskrejestracji").click();</script>';
            unset($_SESSION['e_imie']);
          }
                    if(isset($_SESSION['e_haslo'])){
            echo '<script>document.getElementById("przyciskrejestracji").click();</script>';
            unset($_SESSION['e_haslo']);
          }

          ?>
  </body>
</html>
