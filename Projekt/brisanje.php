<?php
if(isset($_POST['delete'])){
    session_start();
    include 'connect.php';
    $id=$_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
    echo "Vijest je obrisana.";
    header('Location:administracija.php');
}
?>