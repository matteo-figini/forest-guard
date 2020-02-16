<div id="modalRilevazione" class="w3-modal" onload="getLocation()">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalRilevazione').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-blue">
                <h5>Inserisci una rilevazione</h5>
            </header>
            <form action="../../assets/backend/createRilevazione.php" method="post">
                <p>Genere: </p>
                <select name="genere">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT * FROM genere ORDER BY Tipologia";
                    $result = $conn->query($queryString);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["Nome"]; ?>"><?php echo $row["Nome"]." (".$row["Tipologia"].")"; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <p>Specie: </p>
                <input type="text" name="specie" placeholder="Inserisci la specie">
                <p>Stato di salute: </p>
                <select name="salute">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT * FROM stato_salute";
                    $result = $conn->query($queryString);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["Valore"]; ?>"><?php echo $row["Valore"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <p>Numero di esemplari: </p>
                <input type="number" name="num_esemplari" value="1"><br>
                <p>Note aggiuntive: </p>
                <input type="textarea" name="note"><br>
                <p>Latitudine: </p>
                <input type="text" name="latitudine" id="lat" value="">
                <p>Longitudine: </p>
                <input type="text" name="longitudine" id="lng" value="">
                <p>Data: </p>
                <input type="text" name="data" id="data" value="" readonly>
                <p>Ora: </p>
                <input type="text" name="ora" id="ora" value="" readonly><br><br>
                <input type="hidden" name="nome_parco" value="<?php echo $_SESSION["Parco"]; ?>">
                <input type="hidden" name="cod_guardiaparchi" value="<?php echo $_SESSION["ID"]; ?>">
                <input type="submit" name="invio" value="Invia rilevazioni">
            </form>
            <br>
        </div>
    </div>
</div>
