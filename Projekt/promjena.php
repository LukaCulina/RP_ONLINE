<?php
if(isset($_POST['update'])){
    include 'connect.php';
    $picture = $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir = 'images/'.$picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    $id=$_POST['id'];
    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content',
    slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
    $result = mysqli_query($dbc, $query);
    echo "Vijest je promijenjena.";
    header("Location: administracija.php");
}?>