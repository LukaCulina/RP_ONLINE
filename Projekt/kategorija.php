

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PWA Projekt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" media="screen" type="text/css" href="style.css?v=1.1">
</head>
</head>

<body>

    <?php
    include 'connect.php';
    define('UPLPATH', 'images/');
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
        <section id="category">
            <div class="container">
            <?php
            include 'connect.php';
            $kategorija=$_GET['id'];
            echo '<div class="naslov">
            <h1>'.$kategorija.'</h1>
            </div>';
            $query = "SELECT * FROM vijesti WHERE kategorija='$kategorija' AND arhiva=0";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<div class="slika">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" class="thumbnail">';
                echo '</div>';
                echo '<div class="tekst">';
                echo '<h2 class="title">';
                echo '<a href="clanak.php?id='.$row['id'].'">';
                echo $row['naslov'];
                echo '</a></h2>';
                echo '<p>'.$row['sazetak'].'';
                echo '</p>';
                echo '</div>';
                echo '</article>';
                echo '<hr>';
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
</body>

</html>
