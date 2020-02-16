<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container">
        <h4>Benvenuto, <strong><?php echo $_SESSION["Nome"]; ?></strong></h4><br>
    </div>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <a href="#alert" class="w3-bar-item w3-button w3-padding"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Alert</a>
        <a href="#rilevazioni" class="w3-bar-item w3-button w3-padding"><i class="fas fa-clipboard"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rilevazioni</a>
        <?php
        if ($_SESSION["TipoUtente"] != "Guardiaparchi") {
            ?>
            <a href="#profili" class="w3-bar-item w3-button w3-padding"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;Profili</a>
            <?php
        }
        ?>
        <a href="#profilo" class="w3-bar-item w3-button w3-padding"><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I miei dati</a><hr>
        <a href="../home/index.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Esci</a><br><br>
    </div>
</nav>
