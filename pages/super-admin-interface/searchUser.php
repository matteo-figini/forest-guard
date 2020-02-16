<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["TipoUtente"] != "Guardiaparchi") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $tipiUtenti = array();
    $parchi = array();

    $query = "SELECT Nome FROM tipi_utenti ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($tipiUtenti, $row["Nome"]);
        }
    }

    $query = "SELECT Nome FROM elenco_parchi ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($parchi, $row["Nome"]);
        }
    }

    $query = "SELECT * FROM utenti WHERE ID_utente='".$_POST["param"]."' ";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Nome: </p><input type=\"text\" name=\"primo_nome\" value=\"".$row["Nome"]."\" required>";
            echo "<p>Cognome: </p><input type=\"text\" name=\"cognome\" value=\"".$row["Cognome"]."\" required>";
            echo "<p>E-mail: </p><input type=\"email\" name=\"email\" value=\"".$row["Email"]."\" required>";
            echo "<p>Username: </p><input type=\"text\" name=\"username\" value=\"".$row["Username"]."\" required>";
            echo "<p>Password: </p><input type=\"password\" name=\"password\" value=\"\" required>";
            echo "<p>Tipo di utente: </p><select name=\"tipo_utente\" data-selected=\"".$row["Tipo_utente"]."\">";
            foreach ($tipiUtenti as $value) {
                if ($row["Tipo_utente"] == $value) {
                    echo "<option value=\"".$value."\" selected=\"selected\">".$value."</option>";
                }
                else {
                    echo "<option value=\"".$value."\">".$value."</option>";
                }
            }
            echo "</select>";
            echo "<p>Parco assegnato: </p><select name=\"parco\" data-selected=\"".$row["Parco_assegnato"]."\"><option value=\"\"></option>";
            foreach ($parchi as $value) {
                if ($row["Parco_assegnato"] == $value) {
                    echo "<option value=\"".$value."\" selected=\"selected\">".$value."</option>";
                }
                else {
                    echo "<option value=\"".$value."\">".$value."</option>";
                }
            }
            echo "</select>";
            break;
        }
    }
}
?>
