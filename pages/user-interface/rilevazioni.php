<?php
session_start();

if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Guardiaparchi")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}

$conn = new mysqli("localhost", "root", "", "guardiaparchi");
if ($conn->connect_error) {
    die ("Errore di connessione al database.");
}
if ($_POST["param"] == "") {
    $queryString = "SELECT R.* ";
    $queryString .= "FROM rilevazioni R ";
    $queryString .= "WHERE R.Cod_guardiaparchi='".$_SESSION["ID"]."' ";
    $queryString .= "ORDER BY ID_rilevazione DESC ";
}
else {
    $queryString = "SELECT R.* ";
    $queryString .= "FROM rilevazioni R ";
    $queryString .= "WHERE R.Cod_guardiaparchi='".$_SESSION["ID"]."' AND (ID_rilevazione LIKE '%".$_POST["param"]."%' OR Specie LIKE '%".$_POST["param"]."%' OR Stato_salute LIKE '%".$_POST["param"]."%') ";
}
$result = $conn->query($queryString);
if ($result->num_rows > 0) {
    echo "<table class='w3-table w3-responsive w3-striped'>";
    echo "<tr class='w3-green'><td><b>ID</b></td><td><b>Specie</b></td><td><b>Stato di salute</b></td><td><b>Numero di esemplari<b></td><td><b>Note aggiuntive</b></td><td><b>Latitudine</b></td><td><b>Longitudine</b></td><td><b>Data e ora</b></td></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr id=".$row["ID_rilevazione"]."><td>".$row["ID_rilevazione"]."</td><td>".$row["Specie"]."</td><td>".$row["Stato_salute"]."</td><td>".$row["Numero_esemplari"]."</td><td>".$row["Note"]."</td><td>";
        echo $row["Latitudine"]."</td><td>".$row["Longitudine"]."</td><td>".$row["DataOra"]."</td></tr>";
    }
    echo "</table>";
}
?>
