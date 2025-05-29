<?php
require_once "navbar.php";
?>
<?php
session_start();
// Check if the message session is set and display appropriate message
if (isset($_SESSION["message2"])) {
    if ($_SESSION["message2"] == 1) {
        echo "<div id='Message' class='Fmessage'><h5>Cette formation existe déjà</h5></div>";
    } elseif ($_SESSION["message2"] == 0) {
        echo "<div id='Message' class='Smessage'><h5>Ajouté avec succès</h5></div>";
    }

    // Reset the session variable after displaying the message to avoid it staying on refresh
    $_SESSION["message2"] = null;
}
?>
<script>
    setTimeout(function() {
    var message=document.getElementById("Message");
    message.classList.add("hide0");
}, 5000);
</script>
<form class="form2" action="includes/ajouterNiveau.inc.php" method="post">
    <h3>ajouter type formation</h3>
    <input type="text" name="labelle" placeholder="nom de niveau" required>
    <button class="button01" type="submit">ajouter</button>
</form>
</body>
</html>