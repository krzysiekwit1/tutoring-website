<?php

session_start();


?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS FILE-->
<link rel="stylesheet" href="css/index.css">

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital@1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<title>Document</title>
</head>
<body>
<!-- NAV ELEMENT -->
<div class="nav-div">
<nav>
<div class="logo">
<h4>Logo</h4></div>
<ul class="nav-links">
<li>
<!-- PHP ELEMENT LOGGED IN /LOGGED OUT -->
    <?php
    if(isset($_SESSION['uzytkownik'])){
    echo "<a href='./skryptyPHP/wyloguj.php'>Wyloguj się</a>";
    }else{echo "<a href='loginPage.php'>Zaloguj się</a>";}     
    ?>
</li>
<li><a href="#">Strone Głowna</a></li>
<li><a id="SignIn" href="#">SignIn</a></li>
<li><a id="SignUp" href="#">SignIn</a></li>
<li><a href="#">Work in progress</a></li>
</ul>
    <?php
    if(isset($_SESSION['uzytkownik'])){
    echo "<div class='logo' style='font-size:5px;letter-spacing:1.5px'><h4>Witaj ".$_SESSION['imie']." </h4></div>";}
    ?>
<div class="nav-button">
    <div class="first-line"></div>
    <div class="second-line"></div>
    <div class="third-line"></div>
</div>
</nav>
</div>
<!-- END OF NAV ELEMENT -->
<!-- FiLTER BAR -->
<div class="advertFilterBar"><h1>FILTER BAR</h1></div>
<!-- END OF FILTER BAR -->
<!-- ADVERT CARD SECTION --> 

<?php

require_once "./skryptyPHP/skryptLaczacy.php";

$polaczenie = new mysqli($host,$db_uzytkownik,$db_haslo,$db_nazwa);

if($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno."opis: ".$polaczenie->connect_error;  
}
else{
$sqlCount = "SELECT count(idAdvert) AS total FROM advert";
$countedRowsadvert=mysqli_query($polaczenie,$sqlCount);
$num_rows0=mysqli_fetch_assoc($countedRowsadvert);
$num_rows=$num_rows0['total'];
//start of card section
echo '<div class="cardContainer">';
for($i = 1;$i<=$num_rows;$i++){
$sql = "SELECT*FROM advert WHERE idAdvert='$i'";
if($rezultat = @$polaczenie->query($sql))
{
$advertData = $rezultat->fetch_assoc();
//card element creator
if($i%2==1){
echo '<div class="cardLeft">';
    echo '<div class="cardImage">';
    echo '<img style="width:100%;height:100%;overflow:hidden;"src="data:image;base64,'.base64_encode($advertData['imageAdvert']).'">';
    echo '</div>';
    echo '<div class="cardInformation1">';
    echo        '<div class="lastName">';
    echo        '<h2>'.$advertData['nameAdvert'].' '.$advertData['lastnameAdvert'].'</h2>';
    echo        '</div>';
    echo            '<div class="nativLanguage">';
    echo                '<h6>jezyk natywny</h6>';
    echo                '<h6>jezyk'.$advertData['nativLanguageAdvert'].'</h6>';
    echo            '</div>';
    echo                '<div class="availableLanguage">';
    echo                '<h4>Jezyk '.$advertData['firstLanguageAdvert'].' '.$advertData['secondLanguageAdvert'].' '.$advertData['thirdLanguageAdvert'].' '.$advertData['fourthLanguageAdvert'].' '.$advertData['fifthLanguageAdvert'].'</h4>';
    echo                '</div>';
    echo '</div>';
    echo '<div class="cardInformation2">';
    echo $advertData['descriptionAdvert'];

    echo '</div>';
    echo '</div>';

}else{
echo '<div class="cardRight">';
    echo '<div class="cardImage">';
    echo '<img style="width:100%;height:100%;overflow:hidden;"src="data:image;base64,'.base64_encode($advertData['imageAdvert']).'">';
    echo '</div>';
    echo '<div class="cardInformation1">';
    echo        '<div class="lastName">';
    echo        '<h2>'.$advertData['nameAdvert'].' '.$advertData['lastnameAdvert'].'</h2>';
    echo        '</div>';
    echo            '<div class="nativLanguage">';
    echo                '<h6>jezyk natywny</h6>';
    echo                '<h6>jezyk'.$advertData['nativLanguageAdvert'].'</h6>';
    echo            '</div>';
    echo                '<div class="availableLanguage">';
    echo                '<h4>Jezyk '.$advertData['firstLanguageAdvert'].' '.$advertData['secondLanguageAdvert'].' '.$advertData['thirdLanguageAdvert'].' '.$advertData['fourthLanguageAdvert'].' '.$advertData['fifthLanguageAdvert'].'</h4>';
    echo                '</div>';
    echo '</div>';
    echo '<div class="cardInformation2">';
    echo $advertData['descriptionAdvert'];
    echo '</div>';
        echo '</div>';

}
//$advertName = $advertData['nameAdvert'];
//$advertLastName = $advertData['lastnameAdvert'];
//$imageAdvert = $advertData['imageAdvert'];
//echo '<img src="data:image;base64,'.base64_encode($advertData['imageAdvert']).'">';

}
//end of card element
}
// end card section
echo '</div>';
$polaczenie->close();
}

?>
<!--
<div class="cardContainer">
<div class="cardLeft">
    <div class="cardImage">
    <img style="width:100%;height:100%;overflow:hidden;" src="Image2.jpg" alt="">
    </div>
    <div class="cardInformation1">
            <div class="lastName">
            <h2>Krzysztof Witkowski </h2>
            </div>
                <div class="nativLanguage">
                    <h6>jezyk natywny</h6>
                <h4>Jezyk Polski</h4>
                </div>
                    <div class="availableLanguage">
                    <h4>Jezyk Hiszpanski Francuski</h4>
                    </div>
    </div>
    <div class="cardInformation2">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam in perspiciatis eum voluptate harum, a totam recusandae aliquid illum, laboriosam natus culpa quia fugiat fuga perferendis tempora nobis ipsum voluptates. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus corrupti eaque sit a explicabo, rem dolore sunt. Tempore reprehenderit doloribus rerum illum totam commodi in eveniet repellat minima, aliquid hic.
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum, nam eveniet? Eaque nisi explicabo corrupti accusantium soluta! Ab quae iusto, dolores consectetur voluptas possimus neque recusandae cum quaerat repellat aliquid?
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, perferendis! Voluptate, reiciendis ea debitis explicabo, dolorem doloribus asperiores dolores ut voluptatem enim ab dolore repudiandae inventore distinctio, autem id magni.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque tempore at reprehenderit deleniti et repellendus provident, error facilis velit. Ab non nisi laboriosam vero quibusdam maiores placeat magnam voluptatibus molestias?
    </div>


</div>
<div class="cardRight">


</div>
<div class="cardLeft">


</div>
<div class="cardRight">


</div>

</div>
-->
<!-- LOGIN/REGISTER MODAL POPUP -->
<div class="bg-modal">
<div class="modal-content">
    <div class="login-close-button">+</div>
    <div class="sign-in-text">Sign In</div>
            <form class="input-group" id="login" action="./skryptyPHP/zaloguj.php" method="post">


        <input
            name="emaill"
            type="email"
            class="login-input-field"
            placeholder="Enter email"
            required
        />
        <input
            name="hasloo"
            type="text"
            class="login-input-field"
            placeholder="Enter password"
            required
        />
        <button type="submit" class="submit-btn">Sign in</button>
        </form>
</div>

</div>
<!--TEST -->
<div class="bg-modal1">
<div class="modal-content1">
    <div class="login-close-button1">+</div>
    <div class="sign-in-text">Sign In</div>
    <form action="./skryptyPHP/signUp.php" method='POST' id="register" class="input-group">
        <input
            name="imie"
            type="text"
            class="register-input-field"
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
            class="register-input-field"
            placeholder="Nazwisko"
            required
        />
            <input
            name="email"
            type="email"
            class="register-input-field"
            placeholder="Email"
            required
        />
        <?php
        if(isset($_SESSION['e_emailJuzIstnieje'])){
            echo '<div class="error">'.$_SESSION['e_emailJuzIstnieje'].'</div>';
        }
        ?>
        <input name="data" type="date" class="register-input-field" min=1930-01-01/>

        
            <input
            name="haslo1"
            type="text"
            class="register-input-field"
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
            class="register-input-field"
            placeholder="Powtórz hasło"
            required
        />

        <div class="register-text-container"><input name="korepetytor" type="checkbox" class="check-box" />
        <span class="register-text">Jestem Korepetytorem</span></div>
        <div class="register-text-container"><input name="regulamin" type="checkbox" class="check-box" />
        <span class="register-text">Akceptuję regulamin</span></div>
        <button type="submit" class="submit-btn">Zarejestruj się</button>

        </form>
        
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
</div>

</div>


<!-- js -->
<script src="js/index.js"></script>
<!-- jquery -->
<script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>