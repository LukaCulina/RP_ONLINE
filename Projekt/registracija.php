<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PWA Projekt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" media="screen" type="text/css" href="style.css?v=1.1">
</head>

<body>
    
<?php
$msg  = false;
$registriranKorisnik = false;
if (isset($_POST['registracija'])) {
    include 'connect.php';
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if(mysqli_stmt_num_rows($stmt) > 0){
        $msg = true;
    }else{
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username,
                $hashed_password, $razina);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
    }
    mysqli_close($dbc);
}
?>

<?php
 //Registracija je prošla uspješno
 if($registriranKorisnik == true) {
    echo '<p>Korisnik je uspješno registriran!</p>';
    header('Location:administracija.php');
 } else {
    
 ?>

<div class="wrapper">
        <header>
            <nav>
                <ul>
                    <li>
                        <a href="index.php">
                            <img src="images/RP-1.png" alt=" ">
                        </a>
                    </li>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="kategorija.php?id=Sport">SPORT</a></li>
                    <li><a href="kategorija.php?id=Politika">POLITIK</a></li>
                    <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                    <li><a href="unos.php">UNOS</a></li>
                </ul>
            </nav>
        </header>
        <hr id="top">
        <section id="forma">
            <div class="container">
                <form enctype="multipart/form-data" action="" method="POST" class="user">
                <div class="login">
                    <h1>REGISTRACIJA</h1>
                </div>
                    <div class="form-item">
                        <label for="title">Ime: </label>
                        <div class="form-field">
                            <input type="text" name="ime" id="ime" class="form-fieldtextual">
                        </div>
                        <span id="porukaIme" class="bojaPoruke"></span>
                    </div>
                    <div class="form-item">
                        <label for="about">Prezime: </label>
                            <div class="form-field">
                                <input type="text" name="prezime" id="prezime" class="formfield-textual">
                            </div>
                            <span id="porukaPrezime" class="bojaPoruke"></span>
                    </div>
                    <div class="form-item">
                        <label for="content">Korisničko ime:</label>
                            <div class="form-field">
                                <input type="text" name="username" id="username" class="formfield-textual">
                            </div>
                            <?php if($msg == true){  
                                echo "Korisničko ime već postoji!";
                                $msg == false;
                            }?>
                        <span id="porukaUsername" class="bojaPoruke"></span>
                    </div>
                    <div class="form-item">
                        <label for="pphoto">Lozinka: </label>
                            <div class="form-field">
                                <input type="password" name="pass" id="pass" class="formfield-textual">
                            </div>
                            <span id="porukaPass" class="bojaPoruke"></span>
                    </div>
                    <div class="form-item">
                        <label for="pphoto">Ponovite lozinku: </label>
                            <div class="form-field">
                            <input type="password" name="passRep" id="passRep" class="form-field-textual">
                            </div>
                            <span id="porukaPassRep" class="bojaPoruke"></span>
                    </div>

                    <div class="form-item">
                        <button type="submit" value="Prijava" id="slanje" name="registracija">Registracija</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
<footer>
    <div class="container1">
        <div class="podnozje">
            <p>© RP DIGITAL GMBH | ALLE RECHTE VORBEHALTEN</p>
            <p id="dno">Content Management by InterRed</p>
        </div>
    </div>
</footer>
 <script type="text/javascript">
    document.getElementById("slanje").onclick = function(event) {

        var slanjeForme = true;

        // Ime korisnika mora biti uneseno
        var poljeIme = document.getElementById("ime");
        var ime = document.getElementById("ime").value;
        if (ime.length == 0) {
        slanjeForme = false;
        poljeIme.style.border="1px dashed red";
        document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
        } else {
        poljeIme.style.border="1px solid green";
        document.getElementById("porukaIme").innerHTML="";
        }
        // Prezime korisnika mora biti uneseno
        var poljePrezime = document.getElementById("prezime");
        var prezime = document.getElementById("prezime").value;
        if (prezime.length == 0) {
        slanjeForme = false;
        poljePrezime.style.border="1px dashed red";

        document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
        } else {
        poljePrezime.style.border="1px solid green";
        document.getElementById("porukaPrezime").innerHTML="";
        }

        // Korisničko ime mora biti uneseno
        var poljeUsername = document.getElementById("username");
        var username = document.getElementById("username").value;
        if (username.length == 0) {
        slanjeForme = false;
        poljeUsername.style.border="1px dashed red";

        document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
        } else {
        poljeUsername.style.border="1px solid green";
        document.getElementById("porukaUsername").innerHTML="";
        }

        // Provjera podudaranja lozinki
        var poljePass = document.getElementById("pass");
        var pass = document.getElementById("pass").value;
        var poljePassRep = document.getElementById("passRep");
        var passRep = document.getElementById("passRep").value;
        if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
        slanjeForme = false;
        poljePass.style.border="1px dashed red";
        poljePassRep.style.border="1px dashed red";
        document.getElementById("porukaPass").innerHTML="<br>Unesie lozinku!<br>";

        document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
        } else {
        poljePass.style.border="1px solid green";
        poljePassRep.style.border="1px solid green";
        document.getElementById("porukaPass").innerHTML="";
        document.getElementById("porukaPassRep").innerHTML="";
        }

        if (slanjeForme != true) {
        event.preventDefault();
        }

    };

 </script>
 <?php
 }
 ?>

 </body>

</html>