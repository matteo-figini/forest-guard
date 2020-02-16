<?php
if (isset($_SESSION["ID"])) {
    echo "<p>ID utente: ".$_SESSION["ID"]."</p>";
}
if (isset($_SESSION["Parco"])) {
    echo "<p>Parco di appartenenza: ".$_SESSION["Parco"]."</p>";
}
if (isset($_SESSION["ID"])) {
    echo "<p>Tipo di utente: ".$_SESSION["TipoUtente"]."</p>";
}
?>
