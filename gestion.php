<?php
require_once "navbar.php";
session_start();
?>  
    <div class="gestion">
        <h2>Gestion des etudients</h2>
        <form class="gestion1" action="includes/recherche.inc.php" method="post">
            <select name="groupe" id="gselected"  class="Gmatier">
            <option value="" disabled selected hidden>--groupe--</option>
                <?php
                    require_once "includes\loadGroupe.inc.php";
                    foreach($resultsGroupe as $gb){
                    echo
                    "<option value='".$gb["id"]."'>".$gb["labelle"]."</option>";
                };
                ?>
            </select>
            <button class="rechercher" name="searchbutton"><i class="bi bi-search fs-1"></i></button>
        </form>
    </div>

    <div class="tab">
        <table class="tab1" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>sexe</th>
                    <th>date de naissance</th>
                    <th>supprimer</th>
                    <th>modifier</th>
                    <th>absent?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($_SESSION["searchbutton"])){
                        $_SESSION["searchbutton"]="";
                        foreach($_SESSION["results"] as $result){
                            echo "<tr>
                                    <td>".$result["id"]."</td>
                                    <td >".$result["nom"]."</td>
                                    <td>".$result["prenom"]."</td>
                                    <td>".$result["sexe"]."</td>
                                    <td>".$result["daten"]."</td>
                                    <td><button class='supp1' data-nom='". $result["nom"] ."' data-prenom='". $result["prenom"] ."' data-id='". $result["id"] ."' >supprimer<i class='bi bi-trash'></i></button></td>
                                    <td><button class='mod1' data-nom1='". $result["nom"] ."' data-prenom1='". $result["prenom"] ."' data-id1='". $result["id"] ."' data-sexe1='". $result["sexe"] ."' data-daten1='". $result["daten"] ."' >modifier<i class='bi bi-pencil-square'></i></button></td>
                                    <td>
                                    <button class='absence-btn' data-id='". $result["id"]."' >Absence</button>
                                    </td>
                                
                                  </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <form class="popoutForm2" id="absenceForm" method="POST" action="includes/add_absence.inc.php">
    <input type="hidden" name="student_id" id="absenceStudentId">
    <label>Date:</label>
    <input type="date" name="date_absence" required>
    <button type="submit">Confirm Absence</button>
    <button type="button" id="cancelAbsence">Annuler</button>
    </form>


    </div>
    <script>
    const absenceButtons = document.querySelectorAll('.absence-btn');
const absenceForm = document.getElementById('absenceForm');
const cancelAbsence = document.getElementById('cancelAbsence');

absenceButtons.forEach(btn => {
  btn.addEventListener('click', function () {
    const studentId = this.getAttribute('data-id');
    document.getElementById('absenceStudentId').value = studentId;
    absenceForm.classList.add('show'); // Now correctly targets absence form
  });
});

cancelAbsence.addEventListener('click', () => {
  absenceForm.classList.remove('show');
});


    </script>
    <script>
    // Select all buttons by class name
    const deleteButtons = document.querySelectorAll('.supp1');
    const modButtons = document.querySelectorAll('.mod1');

    // Add event listener to each "supprimer" button
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the data attributes from the clicked button
            const nom = this.getAttribute('data-nom');
            const prenom = this.getAttribute('data-prenom');
            const id = this.getAttribute('data-id');

            // Here, you can populate a form or handle the data as needed.
            // For example, populate the form (you can adapt this as per your requirements)
            document.getElementById('fullName').value=prenom+" "+nom
            document.getElementById('idE').value = id;
        });
    });
    modButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the data attributes from the clicked button
            const nom1 = this.getAttribute('data-nom1');
            const prenom1 = this.getAttribute('data-prenom1');
            const id1 = this.getAttribute('data-id1');
            const daten1 = this.getAttribute('data-daten1');

            // Here, you can populate a form or handle the data as needed.
            // For example, populate the form (you can adapt this as per your requirements)
            document.getElementById('id1').value=id1
            document.getElementById('nom1').value=nom1
            document.getElementById('prenom1').value=prenom1
            document.getElementById('daten1').value=daten1
        });
    });

</script>
    <form class="popoutForm" id="popoutForm" action="includes/Esupp.inc.php" method="POST">
        <h4>Voulez-vous supprimer:</h4>
        <input type="text" id="fullName" placeholder="First Name" readonly>
        <input type="hidden" name="iddg" value="<?php echo $_SESSION["idG"]?>" readonly>
        <input type="hidden" name="idE" id="idE">
        <div class="btns">
            <button class="ann" id="hide" type="button">annuler<i class="bi bi-x-square"></i></button>
            <button class="supp2" type="submit">supprimer<i class="bi bi-trash"></i></button>
        </div>
    </form>
    <form class="popoutForm1" id="popoutForm0" action="includes/Emod.inc.php" method="POST">
        <input type="text" name="nom" id="nom1" placeholder="nom" required>
        <input type="text" name="prenom" id="prenom1" placeholder="prenom" required>
        <div class="sexe1">
            <h4>sexe:</h4>
            <input type="radio" id="male" name="sexe" value="male" required>
            <label for="male">male</label>
            <input type="radio" id="female" name="sexe" value="female" required>
            <label for="female">female</label>
        </div>
        <div class="daten1">
            <h4>date de naissance:</h4>
            <input type="date" name="daten" id="daten1" required>
        </div>
        <div class="btns1">
        <input type="hidden" name="ide" id="id1"> 
            <button class="ann1" id="hide1" type="button">annuler<i class="bi bi-x-square"></i></button>
            <button class="mod2" type="submit">modifier<i class="bi bi-pencil-square"></i></button>
        </div>
    </form>
    <script>
        popout=document.getElementById("popoutForm");
        hide=document.getElementById("hide");

        deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            popout.classList.add("show");
        })})

        hide.addEventListener("click", ()=>{
            popout.classList.remove("show")
        }
        )
        popout1=document.getElementById("popoutForm0");
        hide1=document.getElementById("hide1");

        modButtons.forEach(button => {
        button.addEventListener('click', function() {
            popout1.classList.add("show");
        })})

        hide1.addEventListener("click", ()=>{
            popout1.classList.remove("show")
        }
        )
    </script>

</body>
</html>