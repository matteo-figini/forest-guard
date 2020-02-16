<?php
session_start();

if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Super amministratore")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}

$conn = new mysqli("localhost", "root", "", "guardiaparchi");
if ($conn->connect_error) {
    die ("Errore di connessione al database.");
}
if ($_POST["param"] == "") {
    $queryString = "SELECT U.* ";
    $queryString .= "FROM utenti U ";
    $queryString .= "ORDER BY ID_utente ASC ";
}
else {
    $queryString = "SELECT U.* ";
    $queryString .= "FROM utenti U ";
    $queryString .= "WHERE ID_utente LIKE '%".$_POST["param"]."%' OR Nome LIKE '%".$_POST["param"]."%' OR Cognome LIKE '%".$_POST["param"]."%' OR Username LIKE '%".$_POST["param"]."%' OR Tipo_utente LIKE '%".$_POST["param"]."%' OR Parco_assegnato LIKE '%".$_POST["param"]."%' ";
}
$result = $conn->query($queryString);
if ($result->num_rows > 0) {
    echo "<table class='w3-table w3-responsive w3-striped'>";
    echo "<tr class='w3-green'><td><b>ID</b></td><td><b>Nome</b></td><td><b>Cognome</b></td><td><b>E-mail<b></td><td><b>Username</b></td><td><b>Tipo utente</b></td><td><b>Parco assegnato</b></td></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr id=".$row["ID_utente"]."><td>".$row["ID_utente"]."</td><td>".$row["Nome"]."</td><td>".$row["Cognome"]."</td><td>".$row["Email"]."</td><td>".$row["Username"]."</td><td>".$row["Tipo_utente"]."</td><td>";
        echo $row["Parco_assegnato"]."</td>";
    }
    echo "</table>";
}
?>
