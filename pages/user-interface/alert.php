<?php
if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Guardiaparchi")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}

$conn = new mysqli("localhost", "root", "", "guardiaparchi");
if ($conn->connect_error) {
    die ("Errore di connessione al database.");
}
$queryString = "SELECT * FROM alert WHERE Stato <>'Risolto' AND Parco_assegnato='".$_SESSION["Parco"]."' ORDER BY ID_alert DESC";
$result = $conn->query($queryString);
if ($result->num_rows > 0) {
    echo "<table class='w3-table w3-responsive w3-striped'>";
    echo "<tr class='w3-green'><td><b>ID</b></td><td><b>Tipo Alert</b></td><td><b>Descrizione</b></td><td><b>Note<b></td><td><b>Stato<b></td><td><b>Latitudine<b></td><td><b>Longitudine<b></td><td><b>Data e ora<b></td></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID_alert"]."</td><td>".$row["Tipo_alert"]."</td><td>".$row["Descrizione"]."</td><td>".$row["Note"]."</td><td>".$row["Stato"]."</td><td>".$row["Latitudine"]."</td><td>".$row["Longitudine"];
        echo "</td><td>".$row["Data"]."</td></tr>";
    }
    echo "</table>";
}
?>
