<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("location: ../403.html");
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="../../resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../resources/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../resources/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <img src="../../resources/img/abhoer_md_icon.png" alt="abhoer-icon" style="width: 35%;">
                <div class="sidebar-brand-text mx-2">ABHOER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Sidebar Items -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="requests.php">
                    <i class="fas fa-fw fa-inbox"></i>
                    <span>dernières demandes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="list.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>liste des stagiaires</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tasks.php">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>tâches de stagiaire</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="evaluation.php">
                    <i class="fas fa-fw fa-star"></i>
                    <span>évaluation un stagiaire</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("../includes/navbar.php") ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 py-4">Evaluation Generale</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tableau d'Evaluation</h6>
                        </div>
                        <div class="card-body">
                            <form action="en_travail (:" method="GET">
                                <div class="row">
                                    <div class="col">
                                        <label for="stg-ended">Chercher :</label>
                                        <select class="custom-select col-4 m-4" name="stg-close">
                                            <option value="##">choise...</option>
                                            <?php
                                            include_once("../../helpers/condb.php");
                                            $te = "SELECT sr.NOM, sr.PRENOM FROM stagiaire AS sr JOIN evaluation AS e ON sr.ID_STAGE != e.ID_STAGE;";
                                            $req = mysqli_query($con, $te);
                                            if ($result = mysqli_num_rows($req) > 0) {
                                                while ($row = mysqli_fetch_row($req)) {

                                            ?>
                                                    // <option> <?php echo $row["0"] . "  " . $row["1"] ?> </option>
                                                    // <?php
                                                    }
                                                }

                                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <table class="table text-center font-weight-bold">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th scope="col">Acquis</th>
                                            <th scope="col">Très bien</th>
                                            <th scope="col">Bien</th>
                                            <th scope="col">Moyen</th>
                                            <th scope="col">Faible</th>
                                            <th scope="col">Insuffisant</th>
                                        </tr>
                                    </thead>
                                    <!-- 1:Très bien / 2: Bien / 3: Moyen /  4:Faible/ 5:Insuffisant -->

                                    <tbody>
                                        <tr>
                                            <td><label for="E1">Connaissances techniques requises.</label></td>
                                            <td><input type="radio" name="E1" value="1"></td>
                                            <td><input type="radio" name="E1" value="2"></td>
                                            <td><input type="radio" name="E1" value="3"></td>
                                            <td><input type="radio" name="E1" value="4"></td>
                                            <td><input type="radio" name="E1" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E2">Aptitude à comprendre les instructions.</label></td>
                                            <td><input type="radio" name="E2" value="1"></td>
                                            <td><input type="radio" name="E2" value="2"></td>
                                            <td><input type="radio" name="E2" value="3"></td>
                                            <td><input type="radio" name="E2" value="4"></td>
                                            <td><input type="radio" name="E2" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E3">Exactitude de l'exécution des instructions.</label></td>
                                            <td><input type="radio" name="E3" value="1"></td>
                                            <td><input type="radio" name="E3" value="2"></td>
                                            <td><input type="radio" name="E3" value="3"></td>
                                            <td><input type="radio" name="E3" value="4"></td>
                                            <td><input type="radio" name="E3" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E4">Intérêt porté au travail</label></td>
                                            <td><input type="radio" name="E4" value="1"></td>
                                            <td><input type="radio" name="E4" value="2"></td>
                                            <td><input type="radio" name="E4" value="3"></td>
                                            <td><input type="radio" name="E4" value="4"></td>
                                            <td><input type="radio" name="E4" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E5">Capacité de communiquer</label></td>
                                            <td><input type="radio" name="E5" value="1"></td>
                                            <td><input type="radio" name="E5" value="2"></td>
                                            <td><input type="radio" name="E5" value="3"></td>
                                            <td><input type="radio" name="E5" value="4"></td>
                                            <td><input type="radio" name="E5" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E6">Capacité d'apprendre de nouveaux savoirs et faire</label></td>
                                            <td><input type="radio" name="E6" value="1"></td>
                                            <td><input type="radio" name="E6" value="2"></td>
                                            <td><input type="radio" name="E6" value="3"></td>
                                            <td><input type="radio" name="E6" value="4"></td>
                                            <td><input type="radio" name="E6" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E7">Capacité de proposition de solution</label></td>
                                            <td><input type="radio" name="E7" value="1"></td>
                                            <td><input type="radio" name="E7" value="2"></td>
                                            <td><input type="radio" name="E7" value="3"></td>
                                            <td><input type="radio" name="E7" value="4"></td>
                                            <td><input type="radio" name="E7" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E8">Capacité de s'intégrer en équipe</label></td>
                                            <td><input type="radio" name="E8" value="1"></td>
                                            <td><input type="radio" name="E8" value="2"></td>
                                            <td><input type="radio" name="E8" value="3"></td>
                                            <td><input type="radio" name="E8" value="4"></td>
                                            <td><input type="radio" name="E8" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E9">Propreté et hygiène</label></td>
                                            <td><input type="radio" name="E9" value="1"></td>
                                            <td><input type="radio" name="E9" value="2"></td>
                                            <td><input type="radio" name="E9" value="3"></td>
                                            <td><input type="radio" name="E9" value="4"></td>
                                            <td><input type="radio" name="E9" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E10">Tenue de travail</label></td>
                                            <td><input type="radio" name="E10" value="1"></td>
                                            <td><input type="radio" name="E10" value="2"></td>
                                            <td><input type="radio" name="E10" value="3"></td>
                                            <td><input type="radio" name="E10" value="4"></td>
                                            <td><input type="radio" name="E10" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E11">Volonté de remédier aux lacunes antérieures</label></td>
                                            <td><input type="radio" name="E11" value="1"></td>
                                            <td><input type="radio" name="E11" value="2"></td>
                                            <td><input type="radio" name="E11" value="3"></td>
                                            <td><input type="radio" name="E11" value="4"></td>
                                            <td><input type="radio" name="E11" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E12">Efficacité dans le travail </label></td>
                                            <td><input type="radio" name="E12" value="1"></td>
                                            <td><input type="radio" name="E12" value="2"></td>
                                            <td><input type="radio" name="E12" value="3"></td>
                                            <td><input type="radio" name="E12" value="4"></td>
                                            <td><input type="radio" name="E12" value="5"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="E13">Soin et rigueur</label></td>
                                            <td><input type="radio" name="E13" value="1"></td>
                                            <td><input type="radio" name="E13" value="2"></td>
                                            <td><input type="radio" name="E13" value="3"></td>
                                            <td><input type="radio" name="E13" value="4"></td>
                                            <td><input type="radio" name="E13" value="5"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="sidebar-divider d-none d-md-block">
                                <div class="form-group col-8">
                                    <label for="cmt">Commontaitre :</label>
                                    <textarea cols="80" rows="5" name="cmt" placeholder="Donnée une remarque pour cette stagiaire"></textarea>
                                </div>
                                <div class="form-group ">
                                    <input type="submit" name="ajoute" value="Ajouter" class="btn btn-primary">
                                    <input type="reset" value="Annuler" class="btn btn-dark">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Change Presence Modal-->
    <div class="modal fade" id="editPresenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Presence</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updatePresence">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                        <input type="text" name="presence_id" id="presence_id">
                        <div class="mb-3">
                            <label for="m-in">M.Entree</label>
                            <input type="text" name="m-in" id="m-in" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="m-out">M.Sortie</label>
                            <input type="text" name="m-out" id="m-out" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="a-in">A.Entree</label>
                            <input type="text" name="a-in" id="a-in" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="a-out">A.Entree</label>
                            <input type="text" name="a-out" id="a-out" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../helpers/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Page level plugins -->
    <?php include("../includes/scripts.php"); ?>

</body>

</html>