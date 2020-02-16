<div id="modalAlert" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalAlert').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-red">
                <h5>Modifica un alert</h5>
            </header>
            <form action="../../assets/backend/editAlert.php" method="post">
                <p>ID dell'alert da modificare:</p>
                <input type="number" name="id_alert" required>
                <p>Stato dell'alert:</p>
                <select name="stato">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "guardiaparchi");
                    $queryString = "SELECT Nome FROM tipi_status";
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
                <input type="submit" name="invio" value="Modifica alert">
            </form>
            <br>
        </div>
    </div>
</div>
