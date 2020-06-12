<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Document</title>
</head>
<body>
 

<?php

require_once "./skryptyPHP/skryptLaczacy.php";

$polaczenie = new mysqli($host,$db_uzytkownik,$db_haslo,$db_nazwa);

if($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno."opis: ".$polaczenie->connect_error;  
}
else{
$sql = "SELECT*FROM advert WHERE idAdvert='1'";
if($rezultat = @$polaczenie->query($sql))
{
$advertData = $rezultat->fetch_assoc();
$advertName = $advertData['nameAdvert'];
echo $advertName;
}
$polaczenie->close();
}
?>
<section class="advert-list"></section>


 
</body>
</html>