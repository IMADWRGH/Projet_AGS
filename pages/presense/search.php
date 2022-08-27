<?php
// search by name / cin
require("../../helpers/condb.php");

if (isset($_POST['input'])) {

    $input = $_POST['input'];

    $query = "SELECT * FROM stagiaire WHERE NOM LIKE '$input%'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {

        foreach ($query_run as $stagiaire) {
?>
            <li class="list-group-item"><?= $stagiaire['NOM'] . " " . $stagiaire['PRENOM'] ?></li>
            <hr class="sidebar-divider my-0">
<?php
        }
    } else {
        echo "<p class='text-danger text-center mt-3'>Aucun stagiaire trouvé</p>";
    }
}
