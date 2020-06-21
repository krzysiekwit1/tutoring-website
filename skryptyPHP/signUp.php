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
  $_SESSION['e_name']="imie musi posiadac od 3 do 20 znaków";
}else{
    unset($_SESSION['e_name']);
}


//SPRAWDZANIE POPRAWNOSCI HASLA

$haslo1 = $_POST['haslo1'];

$haslo2 = $_POST['haslo2'];

if((strlen($haslo1)<8) || (strlen($haslo1)>20))
{
  $poprawnyFormularz = false;
  
  $_SESSION['e_password1']='<p class="login-error-message" ">Hasło musi posiadać od 8 do 20 znaków</p>';
  header('Location:http://localhost/ProjektDyplomowy/index.php');
}else{
      unset($_SESSION['e_password1']);

}
if($haslo1!= $haslo2){
    $poprawnyFormularz = false;
  $_SESSION['e_password2']="Podane hasła nie są identyczne";
}else{
  unset($_SESSION['e_password2']);
}
//hashowanie hasla
$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);

//sprawdzenie zakceptowania regulaminu

//sprawdzenie czy ktos juz nie założył konta 
require_once "skryptLaczacy.php";

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
    $_SESSION['e_email']="Istnieje juz konto z takim emailem";
    }else{
      unset($_SESSION['e_email']);
    }
    //Wszystko dziala tutaj insert nowy uzytknowik
        if($poprawnyFormularz==true)
        {
          if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$imie','$nazwisko','$dataUrodzenia','$email','$korepetytor','$haslo_hash')"))
          {
            $_SESSION['udanaRejestracja'] = true;
            header('Location:http://localhost/ProjektDyplomowy/index.php');
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





  
      




