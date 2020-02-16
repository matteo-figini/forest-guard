<div id="modalAlert" class="w3-modal" onload="getLocation()">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalAlert').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-red">
                <h5>Inserisci un alert</h5>
            </header>
            <form action="../../assets/backend/createAlert.php" method="post">
                <p>Tipo di alert: </p>
                <select name="tipo">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT * FROM tipi_incidenti ORDER BY Nome_tipo";
                    $result = $conn->query($queryString);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row["Nome_tipo"]; ?>"><?php echo $row["Nome_tipo"]; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <p>Descrizione: </p>
                <input type="text" name="descrizione" value=""><br>
                <p>Note aggiuntive: </p>
                <input type="textarea" name="note"><br>
                <p>Latitudine: </p>
                <input type="text" name="lat" id="latalert" value="">
                <p>Longitudine: </p>
                <input type="text" name="lng" id="lngalert" value="">
                <p>Data: </p>
                <input type="text" name="data" id="dataalert" value="" readonly>
                <p>Ora: </p>
                <input type="text" name="ora" id="oraalert" value="" readonly><br><br>
                <input type="hidden" name="nome_parco" value="<?php echo $_SESSION["Parco"]; ?>">
                <input type="hidden" name="cod_guardiaparchi" value="<?php echo $_SESSION["ID"]; ?>">
                <input type="hidden" name="status" value="Lanciato">
                <input type="submit" name="invio" value="Crea alert">
            </form>
            <br>
        </div>
    </div>
</div>
