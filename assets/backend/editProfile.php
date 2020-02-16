<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    $password = hash("sha512", $conn->real_escape_string($_POST["password"]));
    $_POST["parco"] = $conn->real_escape_string($_POST["parco"]);
    if ($_SESSION["TipoUtente"] == "Amministratore parco") {
        $parcoAssegnato = "";
        $query = "SELECT Parco_assegnato FROM utenti WHERE ID_utente='".$_POST["id"]."'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $parcoAssegnato = $row["Parco_assegnato"];
                break;
            }
            if ($parcoAssegnato == $_SESSION["Parco"]) {
                $query = "UPDATE utenti SET Nome='".$_POST["primo_nome"]."', Cognome='".$_POST["cognome"]."', Email='".$_POST["email"]."', Password='".$password;
                $query .= "', Tipo_utente='".$_POST["tipo_utente"]."', Parco_assegnato='".$_POST["parco"]."' WHERE ID_utente='".$_POST["id"]."' ";
                $result = $conn->query($query);
                if ($result === TRUE) {
                    header('location: ../../pages/admin-interface/index.php');
                }
                else {
                    echo "Error: ".$query."<br>".$conn->error;
                }
            }
            else {
                echo "Non hai il permesso per modificare questo profilo.";
                ?>
                <br><br>
                <a href="../../pages/home/index.php">Accedi di nuovo</a>
                <?php
            }
        }
        else {
            echo "Error: ".$query."<br>".$conn->error;
        }
    }
    else {
        // Puoi modificare tutti gli utenti
        $query = "UPDATE utenti SET Nome='".$_POST["primo_nome"]."', Cognome='".$_POST["cognome"]."', Email='".$_POST["email"]."', Username='".$_POST["username"]."', Password='".$password;
        if ($_POST["tipo_utente"] == "Super amministratore")
            $query .= "', Tipo_utente='".$_POST["tipo_utente"]."', Parco_assegnato=NULL WHERE ID_utente='".$_POST["id"]."' ";
        else
            $query .= "', Tipo_utente='".$_POST["tipo_utente"]."', Parco_assegnato='".$_POST["parco"]."' WHERE ID_utente='".$_POST["id"]."' ";
        $result = $conn->query($query);
        if ($result === TRUE) {
            header('location: ../../pages/super-admin-interface/index.php');
        }
        else {
            echo "Error: ".$query."<br>".$conn->error;
        }
    }
}
?>
