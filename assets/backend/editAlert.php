<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
    if ($_SESSION["TipoUtente"] == "Amministratore parco") {
        // Puoi modificare solo gli alert del parco assegnato
        $parcoAssegnato = "";
        $query = "SELECT Parco_assegnato FROM alert WHERE ID_alert='".$_POST["id_alert"]."'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $parcoAssegnato = $row["Parco_assegnato"];
                break;
            }
            if ($parcoAssegnato == $_SESSION["Parco"]) {
                $query = "UPDATE alert SET Stato='".$_POST["stato"]."' WHERE ID_alert='".$_POST["id_alert"]."'";
                $result = $conn->query($query);
                if ($result === TRUE) {
                    header('location: ../../pages/admin-interface/index.php');
                }
                else {
                    echo "Error: ".$query."<br>".$conn->error;
                }
            }
            else {
                echo "Non hai il permesso per modificare questa alert.";
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
        // Puoi modificare tutti gli alert
        $query = "UPDATE alert SET Stato='".$_POST["stato"]."' WHERE ID_alert='".$_POST["id_alert"]."'";
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
