<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["TipoUtente"] == "Super amministratore") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $query = "DELETE FROM utenti WHERE ID_utente='".$_POST["id"]."'";
    $result = $conn->query($query);
    if ($result === TRUE) {
        header('location: ../../pages/super-admin-interface/index.php');
    }
    else {
        echo "Error: ".$query."<br>".$conn->error;
    }
}
?>
