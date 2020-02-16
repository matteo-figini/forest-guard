<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["TipoUtente"] == "Super amministratore") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $password = hash("sha512", $conn->real_escape_string($_POST['password']));
    $query = "INSERT INTO utenti (Nome, Cognome, Email, Username, Password, Tipo_utente, Parco_assegnato) ";
    $query .= "VALUES ('".$_POST["nome"]."', '".$_POST["cognome"]."', '".$_POST["email"]."', '".$_POST["username"]."', '".$password."', '".$_POST["tipo_utente"]."', '".$_POST["parco"]."')";
    $result = $conn->query($query);
    if ($result === TRUE) {
        header('location: ../../pages/super-admin-interface/index.php');
    }
    else {
        echo "Error: ".$query."<br>".$conn->error;
    }
}
?>
