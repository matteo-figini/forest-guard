<?php
session_start();
$conn = new mysqli("localhost", "root", "", "guardiaparchi");
if ($conn->connect_error) {
    die ("Errore di connessione al database.");
}
$error = "";

// Gestisci la login
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST) {
    $myusername = $conn->real_escape_string($_POST['username']);
    $mypassword = hash("sha512", $conn->real_escape_string($_POST['password']));
    $queryString = "SELECT * FROM guardiaparchi.utenti WHERE Username='".$myusername."' AND Password='".$mypassword."'";
    $result = $conn->query($queryString);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["ID"] = $row["ID_utente"];
            $_SESSION["Nome"] = $row["Nome"];
            $_SESSION["TipoUtente"] = $row["Tipo_utente"];
            $_SESSION["Parco"] = $row["Parco_assegnato"];
            switch ($_SESSION["TipoUtente"]) {
                case 'Amministratore parco':
                    header('location: ../admin-interface/index.php');
                    break;
                case 'Super amministratore':
                    header('location: ../super-admin-interface/index.php');
                    break;
                case 'Guardiaparchi':
                    header('location: ../user-interface/index.php');
                    break;
                default:
                    break;
            }
            break;
        }
    }
    else {
        $error = "Dati di login errati!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <?php require_once '../../partials/head-section.php'; ?>
        <title>Accedi all'area personale</title>
    </head>
    <body>
        <header class="w3-container w3-green">
            <h1 style="text-align: center;">Accedi - ForestGuard</h1>
        </header>
        <div class="w3-container w3-display-middle w3-half w3-margin-top" >
            <form class="w3-container w3-card-4 w3-white" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <p>
                    <input class="w3-input" name="username" type="text" style="width:90%" required>
                    <label>Username</label>
                </p>
                <p>
                    <input class="w3-input" name="password" type="password" style="width:90%" required>
                    <label>Password</label>
                </p>
                <p>
                    <button class="w3-button w3-section w3-green w3-ripple">Log in</button>
                </p>
                <p class="w3-text-red" style="width:50%">
                    <?php echo $error; ?>
                </p>
            </form>
        </div>
    </body>
</html>
