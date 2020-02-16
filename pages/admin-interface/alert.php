<?php
session_start();

if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Amministratore parco")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}

$conn = new mysqli("localhost", "root", "", "guardiaparchi");
if ($conn->connect_error) {
    die ("Errore di connessione al database.");
}
$queryString = "";
if ($_POST["param"] == "") {
    $queryString = "SELECT A.*, U.Nome, U.Cognome ";
    $queryString .= "FROM alert A ";
    $queryString .= "INNER JOIN utenti U ";
    $queryString .= "ON A.Cod_guardiaparchi=U.ID_utente AND A.Parco_assegnato='".$_SESSION["Parco"]."' ";
    $queryString .= "ORDER BY Stato, ID_alert DESC ";
}
else {
    $queryString = "SELECT A.*, U.Nome, U.Cognome ";
    $queryString .= "FROM alert A ";
    $queryString .= "INNER JOIN utenti U ";
    $queryString .= "ON A.Cod_guardiaparchi=U.ID_utente AND A.Parco_assegnato='".$_SESSION["Parco"]."' AND (ID_alert LIKE '%".$_POST["param"]."%' OR Tipo_alert LIKE '%".$_POST["param"]."%' OR Stato LIKE '%".$_POST["param"]."%') ";
    $queryString .= "ORDER BY Stato, ID_alert DESC";
}
$result = $conn->query($queryString);
if ($result->num_rows > 0) {
    echo "<table class='w3-table w3-responsive w3-striped'>";
    echo "<tr class='w3-green'><td><b>ID</b></td><td><b>Tipo Alert</b></td><td><b>Descrizione</b></td><td><b>Note<b></td><td><b>Stato<b></td><td><b>Latitudine<b></td><td><b>Longitudine<b></td><td><b>Data e ora<b></td><td><b>Guardiaparco<b></td></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID_alert"]."</td><td>".$row["Tipo_alert"]."</td><td>".$row["Descrizione"]."</td><td>".$row["Note"]."</td><td>".$row["Stato"]."</td><td>".$row["Latitudine"]."</td><td>".$row["Longitudine"]."</td>";
        echo "<td>".$row["Data"]."</td><td>".$row["Nome"]." ".$row["Cognome"]."</td></tr>";
    }
    echo "</table>";
}
?>
