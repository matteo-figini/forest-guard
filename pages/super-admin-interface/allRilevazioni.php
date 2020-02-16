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
    $queryString = "SELECT R.*, U.Nome, U.Cognome ";
    $queryString .= "FROM rilevazioni R ";
    $queryString .= "INNER JOIN utenti U ON R.Cod_guardiaparchi=U.ID_utente ";
    $queryString .= "ORDER BY Stato_salute, ID_rilevazione DESC ";
}
else {
    $queryString = "SELECT R.*, U.Nome, U.Cognome ";
    $queryString .= "FROM rilevazioni R ";
    $queryString .= "INNER JOIN utenti U ";
    $queryString .= "ON R.Cod_guardiaparchi=U.ID_utente AND (ID_rilevazione LIKE '%".$_POST["param"]."%' OR Specie LIKE '%".$_POST["param"]."%' OR Cod_guardiaparchi LIKE '%".$_POST["param"]."%' OR Parco_appartenente LIKE '%".$_POST["param"]."%' OR Stato_salute LIKE '%".$_POST["param"]."%') ";
    //$queryString = "SELECT * FROM rilevazioni WHERE ID_rilevazione='".$_POST["param"]."' OR Specie='".$_POST["param"]."' OR Cod_guardiaparchi='".$_POST["param"]."' OR Parco_appartenente='".$_POST["param"]."' OR Stato_salute='".$_POST["param"]."' ORDER BY Stato_salute, ID_rilevazione DESC";
}
$result = $conn->query($queryString);
if ($result->num_rows) {
    echo "<table class='w3-table w3-responsive w3-striped'>";
    echo "<tr class='w3-green'><td><b>ID</b></td><td><b>Specie</b></td><td><b>Stato di salute</b></td><td><b>Numero di esemplari<b></td><td><b>Note aggiuntive</b></td><td><b>Latitudine</b></td><td><b>Longitudine</b></td><td><b>Data e ora</b></td>";
    echo "<td><b>Parco<b></td><td><b>Guardiaparco<b></td></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr id=".$row["ID_rilevazione"]."><td>".$row["ID_rilevazione"]."</td><td>".$row["Specie"]."</td><td>".$row["Stato_salute"]."</td><td>".$row["Numero_esemplari"]."</td><td>".$row["Note"]."</td><td>".$row["Latitudine"]."</td>";
        echo "<td>".$row["Longitudine"]."</td><td>".$row["DataOra"]."</td><td>".$row["Parco_appartenente"]."</td><td>".$row["Nome"]." ".$row["Cognome"]."</td></tr>";
    }
    echo "</table>";
}
?>
