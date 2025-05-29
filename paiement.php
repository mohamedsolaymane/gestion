<?php
require_once "navbar.php";
require_once "includes\loadEtudiants.inc.php";
?> 
<div class="tabP">
        <table class="tab1P" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>sexe</th>
                    <th>date de naissance</th>
                    <th>paiement</th>
                    <th> changer paiement</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($resultsE)){
                        foreach($resultsE as $result){
                            echo "<tr>
                                    <td >".$result["id"]."</td>
                                    <td >".$result["nom"]."</td>
                                    <td>".$result["prenom"]."</td>
                                    <td>".$result["sexe"]."</td>
                                    <td>".$result["daten"]."</td>
                                    <td >".$result["paiement"]."</td>
                                    <td><button class='mod1' data-nom1='". $result["nom"] ."' data-prenom1='". $result["prenom"]."' data-id1='". $result["id"] ."' data-pa='". $result["paiement"] ."' >changer paiement</button></td>
                                  </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    const modButtons = document.querySelectorAll('.mod1');
    modButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the data attributes from the clicked button
            const nom1 = this.getAttribute('data-nom1');
            const prenom1 = this.getAttribute('data-prenom1');
            const id1 = this.getAttribute('data-id1');
            const paiement = this.getAttribute('data-pa');

            // Here, you can populate a form or handle the data as needed.
            // For example, populate the form (you can adapt this as per your requirements)
            document.getElementById('id').value=id1
            document.getElementById('fullName').value=prenom1+" "+nom1
        });
    });
    </script>
    <form class="popoutFormP" id="popoutFormP" action="includes/Pmod.inc.php" method="POST">
        <input type="text" id="fullName" placeholder="fullName" readonly>
        <input type="hidden" name="ide" id="id">
        <div class="pai">
            <h4>paiement:</h4>
            <input type="radio" id="payé" name="paiement" value="payé" required>
            <label for="payé">payé</label>
            <input type="radio" id="non_payé" name="paiement" value="non_payé" required>
            <label for="non_payé">non_payé</label>
        </div>ss
        <div class="btnsP">
            <button class="annP" id="hide1" type="button">annuler</button>
            <button class="modP" type="submit">changer</button>
        </div>
    </form>
    <script>
        popout1=document.getElementById("popoutFormP");
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