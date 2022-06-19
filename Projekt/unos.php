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
                <form name="vijesti" action="skripta.php" method="POST" enctype='multipart/form-data'>
                    <h1>UNOS VIJESTI</h1>
                    <label for="naslov">Naslov vijesti:</label>
                    <br>
                    <input type="text" name="naslov" id="naslov" />
                    <br>
                    <span id="porukaNaslov" class="bojaPoruke"></span>
                    <label for="sadržaj">Kratki sadržaj vijesti:</label>
                    <br>
                    <input type="textbox" name="sazetak" id="sadržaj">
                    <br>
                    <span id="porukaSadržaj" class="bojaPoruke"></span>
                    <label for="tekst">Tekst vijesti:</label>
                    <br>
                    <input type="textbox" name="tekst" id="tekst">
                    <br>
                    <span id="porukaTekst" class="bojaPoruke"></span>
                    <label for="kategorija">Kategorija vijesti:</label>
                    <br>
                    <select name="kategorija" id="kategorija">
                        <option value="" disabled selected>Odaberite kategoriju</option>
                        <option value="Sport">Sport</option>
                        <option value="Politika">Politika</option>
                        <option value="Biznis">Biznis</option>
                        <option value="Kriminal">Kriminal</option>
                        <option value="Kultura">Kultura</option>
                        <option value="Zdravlje">Zdravlje</option>
                    </select>
                    <br>
                    <span id="porukaKategorija" class="bojaPoruke"></span>
                    <label for="slika">Slika:</label>
                    <br>
                    <input type="file" accept="image/jpg,image/gif" id="slika" name="slika">
                    <br>
                    <span id="porukaSlika" class="bojaPoruke"></span>
                    <label for="prikaz">Spremiti u arhivu:</label>
                    <br>
                    <input type="checkbox" name="arhiva">
                    <br>
                    <input type="submit" name="submit" id="submit" value="Unesi">
                    <input type="reset" name="reset" value="Poništi">
                </form>
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

<script>
    document.getElementById('submit').onclick=function(event){
        var slanje_forme = true;

        var poljeNaslov = document.getElementById("naslov");
        var naslov = document.getElementById("naslov").value;
        if (naslov.length < 5 || naslov.length > 30) {
            slanje_forme = false;
            poljeNaslov.style.border = "1px solid red";
            document.getElementById("porukaNaslov").innerHTML = "Naslov vijesti mora imati 5 do 30 znakova!<br>";
        }
            
        var poljeSadržaj = document.getElementById("sadržaj");
        var sadržaj = document.getElementById("sadržaj").value;
        if (sadržaj.length < 10 || sadržaj.length > 100) {
            slanje_forme = false;
            poljeSadržaj.style.border = "1px solid red";
            document.getElementById("porukaSadržaj").innerHTML = "Sadržaj vijesti mora imati 10 do 100 znakova!<br>";
        }
        
        var poljeTekst = document.getElementById("tekst");
        var tekst = document.getElementById("tekst").value;
        if (tekst.length == 0) {
            slanje_forme = false;
            poljeTekst.style.border = "1px solid red";
            document.getElementById("porukaTekst").innerHTML = "Teskt vijesti ne smije biti prazan!<br>";
        }

        var poljeSlika = document.getElementById("slika");
        var slika = document.getElementById("slika").value;
        if (slika.length == 0) {
            slanje_forme = false;
            poljeSlika.style.border = "1px solid red";
            document.getElementById("porukaSlika").innerHTML = "Slika mora biti odabrana!<br>";
        }

        var poljeKategorija = document.getElementById("kategorija");
        if (poljeKategorija.selectedIndex == 0) {
            slanje_forme = false;
            poljeKategorija.style.border = "1px solid red";
            document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
        }

        if (slanje_forme != true) {
                event.preventDefault();
            }

    }
</script>

</body>

</html>