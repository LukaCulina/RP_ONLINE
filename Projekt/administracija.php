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
$uspjesnaPrijava = false;
$korisnik = true;
$lozinka = true;
session_start();
include 'connect.php';
// Putanja do direktorija sa slikama
define('UPLPATH', 'images/');
// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
    WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika,
    $levelKorisnika);
    mysqli_stmt_fetch($stmt);
    //Provjera lozinke
    if(mysqli_stmt_num_rows($stmt) > 0){
        if (password_verify($_POST['lozinka'], $lozinkaKorisnika)) {
            $uspjesnaPrijava = true;
            // Provjera da li je admin
            if($levelKorisnika == 1) {
                $admin = true;
            }
            else {
                $admin = false;
            }
            //postavljanje session varijabli
            $_SESSION['$username'] = $imeKorisnika;
            $_SESSION['$level'] = $levelKorisnika;
        } else{
            $lozinka = false;
        }
    } else {
        $korisnik = false;
    }
}
// Brisanje i promijena arhiviranosti
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
             
            <?php 
                if($uspjesnaPrijava == false){  
                    echo "<form action='' method='POST' class='user'>
                    <div class='login'>
                        <h1>PRIJAVA</h1>
                    </div>
                    <label for='username'>Korisničko ime:</label>
                    <br>
                    <input type='text' name='username' id='username'>
                    <span id='porukaUsername' class='bojaPoruke'></span>
    
                    <label for='lozinka'>Lozinka:</label>
                    <br>
                    <input type='password' name='lozinka' id='lozinka'>
                    <span id='porukaPass' class='bojaPoruke'></span>
    
                    <button type='submit' value='Prijava' id='slanje' name='prijava'>Prijava</button>
                    <br>"
                    ?>
                    <?php if($korisnik == false){  
                        echo 'Korisnik ne postoji!';
                        echo '<p>Potrebno je registrirati se na stranici ';
                        echo '<a href="registracija.php">Registracija</a>';
                        echo '</p>';
                    }
                    ?>
                    <?php if($lozinka == false){  
                                echo "Unijeli ste pogrešnu lozinku!";
                                $lozinka = true;
                            }
                    echo "</form>";
                    
            } else{
                
                if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
                    $query = "SELECT * FROM vijesti";
                    $result = mysqli_query($dbc, $query);
                    
                    while($row = mysqli_fetch_array($result)) {

                        echo '<form enctype="multipart/form-data" action="" method="POST" name="admin">
                        <div class="form-item">
                        <label for="title">Naslov vijesti:</label>
                        <div class="form-field">
                        <input type="text" name="title" class="form-field-textual"
                        value="'.$row['naslov'].'">
                        </div>
                        </div>
                        <div class="form-item">
                        <label for="about">Kratki sadržaj vijesti (do 100
                        znakova):</label>
                        <div class="form-field">
                        <textarea name="about" id="" class="formfield-textual">'.$row['sazetak'].'</textarea>
                        </div>
                        </div>
                        <div class="form-item">
                        <label for="content">Sadržaj vijesti:</label>
                        <div class="form-field">
                        <textarea name="content" id="" class="formfield-textual">'.$row['tekst'].'</textarea>
                        </div>
                        </div>
                        <div class="form-item">
                        <label for="pphoto">Slika:</label>
                        <div class="form-field">
                        <input type="file" class="input-text" id="pphoto"
                        value="'.$row['slika'].'" name="pphoto"/> <br><img src="' . UPLPATH .
                        $row['slika'] . '" width=100px>
                        </div>
                        </div>
                        <div class="form-item">
                        <label for="category">Kategorija vijesti:</label>
                        <div class="form-field">
                        <select name="category" id="category" class="form-field-textual" value="'.$row['kategorija'].'">
                            <option value="" disabled selected>Odaberite kategoriju</option>
                            <option value="Sport">Sport</option>
                            <option value="Politika">Politika</option>
                            <option value="Biznis">Biznis</option>
                            <option value="Kriminal">Kriminal</option>
                            <option value="Recenzije">Recenzije</option>
                            <option value="Zdravlje">Zdravlje</option>
                        </select>
                        </div>
                        </div>
                        <div class="form-item">
                            <label>Spremiti u arhivu:
                            <div class="form-field">';
                            if($row['arhiva'] == 0) {
                                echo '<input type="checkbox" name="archive" id="archive"/>
                                Arhiviraj?';
                            } else {
                                echo '<input type="checkbox" name="archive" id="archive"
                                checked/> Arhiviraj?';
                            }
                            echo '</div>
                            </label>
                            
                        </div>
                            <div class="form-gumb">
                            <input type="hidden" name="id" class="form-field-textual"
                            value="'.$row['id'].'">
                            <button type="reset" value="Poništi" name="ponisti">Poništi</button>
                            <button type="submit" name="update" value="Prihvati" formaction="promjena.php">
                            Izmjeni</button>
                            <button type="submit" name="delete" value="Izbriši" formaction="brisanje.php">
                            Izbriši</button>
                            </div>
                        </form>
                        <br>
                        <hr id="top">
                        <br>';
                        
                        
                    } 
                    
                } else if ($uspjesnaPrijava == true && $admin == false) {

                    echo '<p>Bok ' . $imeKorisnika . ', nemate dovoljna prava za
                    pristup ovoj stranici.</p>';
                } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {

                    echo '<p>Bok ' . $imeKorisnika . ', nemate dovoljna prava za
                    pristup ovoj stranici.</p>';
                } 
            }
                
            ?>
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

    var poljePass = document.getElementById("lozinka");
    var pass = document.getElementById("lozinka").value;
    if (pass.length == 0) {
        slanjeForme = false;
        poljePass.style.border="1px dashed red";
        document.getElementById("porukaPass").innerHTML="<br>Unesite lozinku!<br>";

    } else {
        poljePass.style.border="1px solid green";
        document.getElementById("porukaPass").innerHTML="";
    }

    if (slanjeForme != true) {
        event.preventDefault();
    }

};

</script>

</body>

</html>