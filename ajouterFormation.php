<?php
require_once "navbar.php";
?>
<?php
session_start();

// Check if the message session is set and display appropriate message
if (isset($_SESSION["message1"])) {
    if ($_SESSION["message1"] == 1) {
        echo "<div id='Message' class='Fmessage'><h5>Cette formation existe déjà!</h5></div>";
    } elseif ($_SESSION["message1"] == 0) {
        echo "<div id='Message' class='Smessage'><h5>Ajouté avec succès!</h5></div>";
    }elseif ($_SESSION["message1"] == 2) {
        echo "<div id='Message' class='Fmessage'><h5>Ajouter au moins un type de formation!</h5></div>";
    }

    // Reset the session variable after displaying the message to avoid it staying on refresh
    $_SESSION["message1"] = null;
}
?>
<script>
    setTimeout(function() {
    var message=document.getElementById("Message");
    message.classList.add("hide0");
}, 5000);
</script>
<form class="form2" action="includes/ajouterFormation.inc.php" method="post">
    <h3>ajouter formation</h3>
    <input type="text" name="labelle" placeholder="nom de type formation" required>
    <button class="button01" type="submit">ajouter</button>
</form>
</body>
</html>