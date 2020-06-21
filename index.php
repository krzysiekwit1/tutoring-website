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

<!-- PHP ELEMENT LOGGED IN /LOGGED OUT -->
    <?php
    if(isset($_SESSION['uzytkownik'])){
    echo "<a href='./skryptyPHP/wyloguj.php'>Wyloguj się</a>";
    }else{
    echo "<li>";
    echo "<a id='SignUp' href='#'>Zarejestruj się</a>";
    echo "<br>";
    echo "<br>";
    echo "<a id='SignIn' href='#'>Zaloguj się</a>";
    echo "</li>";
    }   
    if(isset($_SESSION['uzytkownik'])){
        if($_SESSION['tutor']== "on"){
        echo "<li>";
        echo "<a id='XXX' href='#'>Panel nauczyciela</a>";
        echo "<br>";
        echo "<a id='XXX' href='#'>Dodaj ogłoszenie</a>";
        echo "</li>";
        }
    }
    ?>

<li><a href="#">Strone Głowna</a></li>
<li><a href="#">Work in progress</a></li>
</ul>
    <?php
    if(isset($_SESSION['uzytkownik'])){
    echo "<div class='logo' style='font-size:5px;letter-spacing:1.5px'><h4>Witaj ".$_SESSION['imie']." </h4></div>";}
    ?>
<div id ="nav-button" class="nav-button">
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
<!-- LOGIN MODAL POPUP -->
<div class="bg-modal">
<div id="modal-content" class="modal-content">
    <div class="login-close-button">+</div>
    <div class="sign-in-text">Zaloguj się</div>
    <?php
if(isset($_SESSION['bladLogowania'])){
echo $_SESSION['bladLogowania'];
echo "<script>document.querySelector('.bg-modal').style.display = 'flex';</script>";
}
?>
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
<!--REGISTER MODAL POPUP -->
<div class="bg-modal1">
<div class="modal-content1">
    <div class="login-close-button1">+</div>
    <div class="sign-in-text">Zarejestruj się</div>
    <form action="./skryptyPHP/signUp.php" method='POST' id="register" class="input-group">
        <input 
        id="registerName"
            title="Wymagania"
            name="imie"
            type="text"
            class="register-input-field"
            placeholder="Imię"
            required
        />
                <?php
        if(isset($_SESSION['e_name'])){
            echo "<script>document.querySelector('.bg-modal1').style.display = 'flex';</script>";
            echo "<script>document.getElementById('registerName').style.borderBottomColor = 'red';</script>";
            echo "<div style='font-size:11px;' class='register-error-container'>Imie musi posiadać od 3 do 20 znaków</div>";
        }
        ?>
        <?php
        if(isset($_SESSION['e_imie'])){
            echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
        }
        ?>
        <input
            title="Wymagania"
            name="nazwisko"
            type="text"
            class="register-input-field"
            placeholder="Nazwisko"
            required
        />
            <input
            id="registerEmail"
            title="Wymagania"
            name="email"
            type="email"
            class="register-input-field"
            placeholder="Email"
            required
        />
        <?php
        if(isset($_SESSION['e_email'])){
            echo "<script>document.querySelector('.bg-modal1').style.display = 'flex';</script>";
            echo "<script>document.getElementById('registerEmail').style.borderBottomColor = 'red';</script>";
            echo "<div style='font-size:11px;' class='register-error-container'>Już istnieje konto o takim emailu</div>";
        }
        ?>
        <input name="data" type="date" class="register-input-field" min=1930-01-01/>

        
            <input
            id="registerPassword1"
            title="Wymagania"
            name="haslo1"
            type="text"
            class="register-input-field"
            placeholder="Hasło"
            required
        />
        <?php
        //unset($_SESSION['e_password1']);
        //unset($_SESSION['e_emailJuzIstnieje']);
        ?>
        <?php
        if(isset($_SESSION['e_password1'])){
            echo "<script>document.querySelector('.bg-modal1').style.display = 'flex';</script>";
            echo "<script>document.getElementById('registerPassword1').style.borderBottomColor = 'red';</script>";
            echo "<div style='font-size:11px;' class='register-error-container'>Haslo musi zawierac więcej niż 8 znaków</div>";
        }
        ?>
            <input
            id="registerPassword2"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="register-input-field"
            placeholder="Powtórz hasło"
            required
        />
                <?php
        if(isset($_SESSION['e_password2'])){
            echo "<script>document.querySelector('.bg-modal1').style.display = 'flex';</script>";
            echo "<script>document.getElementById('registerPassword2').style.borderBottomColor = 'red';</script>";
            echo "<div class='register-error-container'>Hasla nie są takie same</div>";
        }
        ?>

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
<!-- Add tutor Advert -->
<div class="bg-modal-advert">
<div class="modal-content-advert">
    <div class="login-close-button1">+</div>
    <form id="addAdvertForm" name="advertForm" action="" method='POST' id="register" class="input-group">
    <div class="advert-input-section">
        <div class="advert-information">
            <input
            id="nameAdvertCreate"
            title="Wymagania"
            name="haslo21"
            type="text"
            class="advert-input-field"
            placeholder="Imię"
        />
                    <input
            id="lastnameAdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Nazwisko"
        />
                    <input
            id="nativLanguage1AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Język natywny"
        />
                    <input
            id="nativLanguage2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Język natywny 2"
        />
                    <input
            id="priceAdvertCreate"
            title="Wymagania"
            name="advertPrice"
            type="text"
            class="advert-input-field"
            placeholder="Cena w PLN"
            list="price-list"
        />
        <datalist id="price-list">
            <option value="40">
            <option value="45">
            <option value="50">
            <option value="55">
            <option value="60">
            <option value="65">
            <option value="70">
            <option value="75">
            <option value="80">
            <option value="85">
            <option value="90">
            <option value="95">
            <option value="100">
            <option value="105">
            <option value="110">
            <option value="115">
            <option value="120">
            <option value="125">
            <option value="130">
            <option value="135">
            <option value="140">
            <option value="145">
            <option value="150">
            <option value="155">
            <option value="160">
        </datalist>
        </div>
        <div id="advertInformation2" class="advert-information">
            <div class="language-and-languagelevel">
                        <input
            id="language1AdvertCreate"
            title="Wymagania"
            name="haslo21"
            type="text"
            class="advert-input-field"
            placeholder="Jezyk 1"
            list="languageList"
            value=""
            onblur="advert()"
        />
                            <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-language-level-input-field"
            placeholder="Jezyk 2"
            list="language-level-list"
            value = ""
        />
        </div>
                    <div class="language-and-languagelevel">
                    <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Jezyk 2"
            list="languageList"
            value = ""
        />
                            <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-language-level-input-field"
            placeholder="Jezyk 2"
            list="language-level-list"
            value = ""
        />
                </div>
                    <div class="language-and-languagelevel">
                    <input
            id="language3AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Jezyk 3"
            list="languageList"
        />
                            <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-language-level-input-field"
            placeholder="Jezyk 2"
            list="language-level-list"
            value = ""
        />
                </div>
                    <div class="language-and-languagelevel">
                    <input
            id="language4AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Jezyk 4"
            list="languageList"
        />
                            <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-language-level-input-field"
            placeholder="Jezyk 2"
            list="language-level-list"
            value = ""
        />
                </div>
                    <div class="language-and-languagelevel">
                    <input
            id="language5AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            list="languageList"
            placeholder="Jezyk 5"
        />
                            <input
            id="language2AdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-language-level-input-field"
            placeholder="Jezyk 2"
            list="language-level-list"
            value = ""
        />
                </div>
        <datalist id="language-level-list">
            <option value="A1">
            <option value="A2">
            <option value="B1">
            <option value="B2">
            <option value="C1">
            <option value="C2">
        </datalist>

        </div>
        <div class="advert-information">
                    <input
            id="informationAdvertCreate"
            title="Wymagania"
            name="haslo2"
            type="text"
            class="advert-input-field"
            placeholder="Tekst Ogloszenie"
        />
        </div>
    </div>
    <div class="space-beetween-input-output">

    </div>

<div class="advert-output-section">

        <div class="output-card-view">
            <div class="cardImage">
                <img style="width:100%;height:100%;">
            </div>
        <div class="cardInformation1">
            <div id="nameAndLastName" class="lastName">
                <div id="nameAdvertView" class="name-advert-view"></div>
                <div id="lastnameAdvertView" class="lastname-advert-view"></div>
            </div>
                <div class="nativ-language-container">
                    <h6>Język natywny</h6>
                    <div class="specified-nativ-languages-container">
                        <div id="nativLanguage1View" class="nativ-language1-view"></div>
                        <div id="nativLanguage2View" class="nativ-language2-view"></div>

                    </div>
                    <h6>Język</h6>
                    <div class="avaible-languages-view-container">
                        <div id="avaibleLanguageView1" class="avaible-language-view">Polski</div>
                        <div id="avaibleLanguageView2" class="avaible-language-view">Angielski</div>
                        <div id="avaibleLanguageView3" class="avaible-language-view">Hiszpański</div>
                        <div id="avaibleLanguageView4" class="avaible-language-view">Francuski</div>
                        <div id="avaibleLanguageView5" class="avaible-language-view">Niemiecki</div>
                        </div>
                </div>
            <div class="availableLanguage">
                <h4></h4>
            </div>
        </div>
        <div class="cardInformation2">
        
        </div>
        </div>

</div>






<button type="submit" class="submit-btn">Sign in</button>


        </form>
        

</div>

</div>
<datalist id="languageList" >
    <option value="Albański">
    <option value="Arabski">
    <option value="Ormański">
    <option value="Baskijski">
    <option value="Bengalski">
    <option value="Bułgarski">
    <option value="Kataloński">
    <option value="Kambodżański">
    <option value="Chiński">
    <option value="Chorwacki">
    <option value="Czeski">
    <option value="Duński">
    <option value="Holenderski">
    <option value="Angielski">
    <option value="Estoński">
    <option value="Fidżi">
    <option value="Fiński">
    <option value="Francuski">
    <option value="Gruziński">
    <option value="Niemiecki">
    <option value="Grecki">
    <option value="Gudżarati">
    <option value="Hberajski">
    <option value="Hinduski">
    <option value="Węgierski">
    <option value="Islandzki">
    <option value="Indonezyjski">
    <option value="Irlandzki">
    <option value="Włoski">
    <option value="Japoński">
    <option value="Jawajski">
    <option value="Koreański">
    <option value="Łacina">
    <option value="Łotewski">
    <option value="Litewski">
    <option value="Macedoński">
    <option value="Malajski">
    <option value="Malajalam">
    <option value="Maltański">
    <option value="Maorysów">
    <option value="Mongolski">
    <option value="Nepalski">
    <option value="Norweski">
    <option value="Perski">
    <option value="Polski">
    <option value="Portugalski">
    <option value="Pendżabski">
    <option value="Keczua">
    <option value="Rumuński">
    <option value="Rosyjski">
    <option value="Samoa">
    <option value="Serbski">
    <option value="Słowacki">
    <option value="Słowieński">
    <option value="Hiszpański">
    <option value="Suahili">
    <option value="Szewdzki">
    <option value="Tajski">
    <option value="Tybetański">
    <option value="Turecki">
    <option value="Ukraiński">
    <option value="Urdu">
    <option value="Uzbecki">
    <option value="Wietnamski">
    <option value="Walijski">
</datalist>
<!-- jquery -->
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- js -->
<script src="js/index.js"></script>

</body>
</html>