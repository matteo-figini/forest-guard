<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $query = "INSERT INTO alert (Tipo_alert, Descrizione, Note, Parco_assegnato, Stato, Latitudine, Longitudine, Data, Cod_guardiaparchi)";
    $query.=" VALUES ('".$_POST["tipo"]."', '".$_POST["descrizione"]."', '".$_POST["note"]."', '".$_SESSION["Parco"]."', 'Lanciato', '".$_POST["lat"]."', '".$_POST["lng"]."', ";
    $query.= "'".$_POST["data"]." ".$_POST["ora"]."', '".$_SESSION["ID"]."')";
    echo $query;
    $result = $conn->query($query);
    if ($result === TRUE) {
        header('location: ../../pages/user-interface/index.php');
    }
    else {
        echo "Error: ".$query."<br>".$conn->error;
    }
}
?>
