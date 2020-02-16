<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $tipologia = "";
    $queryString = "SELECT Tipologia FROM genere WHERE Nome LIKE '%".$_POST["genere"]."%'";
    $result = $conn->query($queryString);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $tipologia = $row["Tipologia"];
            break;
        }
    }
    else {
        echo "Error: ".$queryString."<br>".$conn->error;
    }
    $query = "INSERT INTO rilevazioni (Tipologia, Genere, Specie, Stato_salute, Numero_esemplari, Note, Latitudine, Longitudine, DataOra, Parco_appartenente, Cod_guardiaparchi)";
    $query.=" VALUES ('".$tipologia."', '".$_POST["genere"]."', '".$_POST["specie"]."', '".$_POST["salute"]."', '".$_POST["num_esemplari"]."', '".$_POST["note"]."', '".$_POST["latitudine"]."', '".$_POST["longitudine"]."', ";
    $query.= "'".$_POST["data"]." ".$_POST["ora"]."', '".$_SESSION["Parco"]."', '".$_SESSION["ID"]."')";
    $result = $conn->query($query);
    if ($result === TRUE) {
        header('location: ../../pages/user-interface/index.php');
    }
    else {
        echo "Error: ".$query."<br>".$conn->error;
    }
}
?>
