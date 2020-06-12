<?php

session_start();



require_once "skryptLaczacy.php";

$polaczenie = new mysqli($host,$db_uzytkownik,$db_haslo,$db_nazwa);

if($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno."opis: ".$polaczenie->connect_error;  
}
else{

$emaill = $_POST['emaill'];
$hasloo = $_POST['hasloo'];

$sql = "SELECT*FROM uzytkownicy WHERE email='$emaill'";

if($rezultat = $polaczenie->query($sql))
{

$ilu_uzytkownikow = $rezultat->num_rows;
if($ilu_uzytkownikow>0)
{
        $wiersz = $rezultat -> fetch_assoc();
        if(password_verify($hasloo,$wiersz['haslo']))
{
        
        $_SESSION['zalogowany'] = true;

        $_SESSION['id']=$wiersz['id'];
        $_SESSION['uzytkownik'] = $wiersz['email'];
        $_SESSION['imie'] = $wiersz['imie'];
        $rezultat->free_result();
        header('Location:http://localhost/ProjektDyplomowy/index.php');
        unset($_SESSION['bladLogowania']);
}
        else
        {
                $_SESSION['bladLogowania'] ='<p class="input-field" style="border-bottom: 0; color:red;margin-left:110px;margin-bottom: 10px;">sdsdzZły login badź hasło</p>';
                header('Location:http://localhost/ProjektDyplomowy/loginPage.php');
        }

}
        else
        {
                $_SESSION['bladLogowania'] ='<p class="input-field" style="border-bottom: 0; color:red;margin-left:110px;margin-bottom: 10px;">Zły login badź hasło</p>';
                header('Location:http://localhost/ProjektDyplomowy/loginPage.php');
        }
}


$polaczenie->close();
}


?>