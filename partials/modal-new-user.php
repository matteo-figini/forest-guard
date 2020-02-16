<div id="modalNewProfile" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalNewProfile').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-black">
                <h5>Inserisci un nuovo utente</h5>
            </header>
            <form action="../../assets/backend/createProfile.php" method="post">
                <p>Nome: </p>
                <input type="text" name="nome" placeholder="Inserisci il nome" required>
                <p>Cognome: </p>
                <input type="text" name="cognome" placeholder="Inserisci il cognome" required>
                <p>E-mail: </p>
                <input type="text" name="email" placeholder="Inserisci l'indirizzo e-mail" required>
                <p>Username: </p>
                <input type="text" name="username" placeholder="Inserisci lo username" required>
                <p>Password: </p>
                <input type="password" name="password" required>
                <p>Tipo di utente: </p>
                <select name="tipo_utente" required>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT Nome FROM tipi_utenti";
                    $result = $conn->query($queryString);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <p>Parco assegnato (se l'utente non è super amministratore): </p>
                <select name="parco">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT Nome FROM elenco_parchi ";
                    $result = $conn->query($queryString);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <br><br>
                <input type="submit" name="invio" value="Crea utente">
            </form>
            <br>
        </div>
    </div>
</div>
