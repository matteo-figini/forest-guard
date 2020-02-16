<?php
session_start();

if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Guardiaparchi")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pagina iniziale di <?php echo $_SESSION["Nome"]; ?></title>
        <?php require_once '../../partials/head-section.php'; ?>
    </head>
    <body class="w3-light-grey">
        <script>
        function showRilevazioni(string) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#rilevazioniTable").html(this.responseText);
                }
            };
            xhttp.open("POST", "rilevazioni.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("param=" + string);
        }
        </script>
        <?php require_once '../../partials/top-container.php'; ?>
        <?php require_once '../../partials/sidebarmenu.php'; ?>
        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
        </div>
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">
            <?php require_once '../../partials/header.php'; ?>
            <div class="w3-row-padding w3-white">
                <div class="w3-container" id="azioni">
                    <header><h5><strong>Azioni</strong></h5></header>
                    <button style="width: 200px;" onclick="document.getElementById('modalAlert').style.display='block'; getRequiredInfo();" class="w3-button w3-red" type="button" id="insert-alert">
                        Inserisci un alert
                    </button>
                    <?php require_once '../../partials/modal-alert-user.php'; ?>
                    <br><br>
                    <button style="width: 200px;" onclick="document.getElementById('modalRilevazione').style.display='block'; getRequiredInfo();" class="w3-button w3-blue" type="button" id="insert-rilevazione">
                        Inserisci una rilevazione
                    </button>
                    <?php require_once '../../partials/modal-rilevazione-user.php'; ?>
                </div>
                <br>
                <div class="w3-container" id="alert">
                    <header><h5><strong>Alert attivi su "<?php echo $_SESSION["Parco"]; ?>"</strong></h5></header>
                    <?php require_once 'alert.php'; ?>
                </div><hr>
                <div class="w3-container" id="rilevazioni">
                    <header><h5><strong>Le mie rilevazioni</strong></h5></header>
                    <p>Filtra per ID, specie o stato di salute: </p>
                    <input type="text" name="filtroRilevazioni" onkeyup="showRilevazioni(this.value)" onfocus="showRilevazioni(this.value)" onblur="document.getElementById('rilevazioniTable').innerHTML='';"><br><br>
                    <div id="rilevazioniTable"></div>
                </div><hr>
                <div class="w3-container" id="profilo">
                    <header><h5><strong>Il mio profilo</strong></h5></header>
                    <?php require_once '../../partials/myprofile.php'; ?>
                </div><hr>
            </div>
            <?php require_once '../../partials/footer.php'; ?>
        </div>
        <script>
            // Get the Sidebar
            var mySidebar = document.getElementById("mySidebar");
            // Get the DIV with overlay effect
            var overlayBg = document.getElementById("myOverlay");
            // Toggle between showing and hiding the sidebar, and add overlay effect
            function w3_open() {
                if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                }
                else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }
            }

            // Close the sidebar with the close button
            function w3_close() {
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }
        </script>
    </body>
</html>
