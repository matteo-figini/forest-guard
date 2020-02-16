<div id="modalDeleteUser" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalProfile').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-blue">
                <h5>Elimina un utente</h5>
            </header>
            <form action="../../assets/backend/deleteProfile.php" method="post">
                <p>ID dell'utente da eliminare: </p>
                <input type="number" name="id" placeholder="Fai riferimento alla tabella degli utenti" required>
                <br><br>
                <input type="submit" name="invio" value="Elimina utente">
            </form>
            <br>
        </div>
    </div>
</div>
