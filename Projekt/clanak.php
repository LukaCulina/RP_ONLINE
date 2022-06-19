<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PWA Projekt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" media="screen" type="text/css" href="style.css?v=1.1">
</head>

<body>

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
        <section role="main">
        <?php
        include 'connect.php';
        define('UPLPATH', 'images/');
        $id=$_GET['id'];
        $query = "SELECT * FROM vijesti WHERE arhiva=0 AND id='$id'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        ?>
    <section id="vijest">
        <div class="clanak">
                <div class='naslov'>
                    <p>
                        <?php
                            echo $row['kategorija'];
                        ?>
                    </p>
                </div>
                <article>
                    <div class="headline">
                        <h1>
                            <?php
                                echo $row['naslov'];
                            ?>
                        </h1>
                    </div>
                    <div class='datum'>
                        <p>
                        <?php
                            echo $row['datum'];
                        ?>
                        </p>
                    </div>
                    <div class="slika">
                        <?php
                            echo '<img src="' . UPLPATH . $row['slika'] . '" class="thumbnail">';
                        ?>
                    </div>
                    <div class="sadrzaj">
                        <p id=bold>
                            <?php
                                echo "<i>".$row['sazetak']."</i>";
                            ?>
                        </p>
                    </div>
                    <div class="tekst">
                        <p>
                            <?php
                                echo $row['tekst'];
                            ?>
                        </p>
                    </div>
                </article>
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