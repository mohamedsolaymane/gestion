<?php
require_once "navbar.php";

?>


<form class="form1" action="includes/ajouter.inc.php" method="post">
<?php
session_start();

if (isset($_SESSION["message"]) && $_SESSION["message"] == 1) {
    echo "<h5>cet étudiant déjà existe dans ce groupe</h5>";
    $_SESSION["message"] = null;
}


?>
    <h3>ajouter</h3>
    <input type="text" name="nom" placeholder="nom" required>
    <input type="text" name="prenom" placeholder="prenom" required>
    <div class="sexe">
        <h4>sexe:</h4>
        <input type="radio" id="male" name="sexe" value="male" required>
        <label for="male">male</label>
        <input type="radio" id="female" name="sexe" value="female"required>
        <label for="female">female</label>
    </div>
    <div class="daten">
        <h4>date de naissance:</h4>
        <input type="date" name="daten" required>
    </div>
    <select id="second_select" name="niveau" class="selectCss" required>
        <option value="" disabled selected hidden>--niveau--</option>
    </select>

    

</select>
    <select id="third_select" name="formation" class="selectCss" required>
    <option value="" disabled selected hidden>--formation--</option>
</select>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // Load niveaux
    $.ajax({
        url: 'includes/loadNiveau2.inc.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#second_select').html('<option value="" disabled selected hidden>--niveau--</option>');
            response.forEach(function(item) {
                $('#second_select').append('<option value="' + item.id + '">' + item.labelle + '</option>');
            });
        },
        error: function() {
            alert("Failed to load niveaux.");
        }
    });

    // Load formations
    $.ajax({
        url: 'includes/loadFormation.inc.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#third_select').html('<option value="" disabled selected hidden>--formation--</option>');
            response.forEach(function(item) {
                $('#third_select').append('<option value="' + item.id + '">' + item.labelle + '</option>');
            });
        },
        error: function() {
            alert("Failed to load formations.");
        }
    });

});
</script>



    <button class="button1" type="submit">ajouter</button>
</form>
</body>
</html>