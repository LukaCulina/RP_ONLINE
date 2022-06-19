<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PWA Projekt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="style.css?v=1.1">
</head>
<body>

<?php
if (isset($_POST['submit'])) { 
    include 'connect.php';
    $naslov=$_POST['naslov'];
    $sadrzaj=$_POST['sazetak'];
    $tekst=$_POST['tekst'];
    $kategorija=$_POST['kategorija'];
    $slika = $_FILES['slika']['name'];
    $date=date('d.M Y');
    if(isset($_POST['arhiva'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir = 'images/'.$slika;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija,
    arhiva ) VALUES ('$date', '$naslov', '$sadrzaj', '$tekst', '$slika',
    '$kategorija', '$archive')";
    $result = mysqli_query($dbc, $query) or die('Error querying databese.');
    mysqli_close($dbc);
}
?>

<?php 
if (isset($_POST['submit'])){
    echo"<header>
    <nav>
        <ul>
            <li>
                <a href='index.php'>
                    <img src='images/RP-1.png' alt= ' '>
                </a>
            </li>
            <li><a href='index.php'>HOME</a></li>
            <li><a href='kategorija.php?id=Sport'>SPORT</a></li>
            <li><a href='kategorija.php?id=Politika'>POLITIK</a></li>
            <li><a href='administracija.php'>ADMINISTRACIJA</a></li>
            <li><a href='unos.php'>UNOS</a></li>
        </ul>
   </nav>
</header>
<hr id='top'>
<section id='vijest'>
   <div class='clanak'>
       <div class='naslov'>
             $kategorija
       </div>
       <article>
            <div class='headline'>
                <h1>
                    $naslov
                </h1> 
            </div>
            <div class='datum'>
                <p>
                    $date
                </p>
            </div>
            <div class='slika'>
                <img src='images/$slika' class='thumbnail'>
            </div>
            <div class='sadrzaj'>
                <p id=bold>
                    $sadrzaj
                </p>
            </div>
            <div class='tekst'>
                <p>
                    $tekst
                </p>
            </div>
        </article>
    </div>
</section>
<footer>
    <div class='container1'>
        <div class='podnozje'>
            <p>© RP DIGITAL GMBH | ALLE RECHTE VORBEHALTEN</p>
            <p id='dno'>Content Management by InterRed</p>
        </div>
    </div>
</footer>";
}

 ?>

</body>
</html>
