<div id="modalProfile" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('modalProfile').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-text-blue">
                <h5>Modifica un utente</h5>
            </header>
            <form action="../../assets/backend/editProfile.php" method="post">
                <p>ID dell'utente da modificare: </p>
                <input type="number" name="id" id="form_id" onkeyup="searchUser(this.value);" placeholder="Fai riferimento alla tabella degli utenti" required>
                <div id="dynamicUser"></div>
                <br><br>
                <input type="submit" name="invio" value="Modifica utente">
            </form>
            <br>
        </div>
    </div>
</div>
