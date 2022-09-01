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
    <title>Secrétaire</title>
    <!-- Custom fonts for this template-->
    <link href="../../resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
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

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="hi.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Accueil</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Ajouter un Stagiaire</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index2.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>les liste des Stagiaires</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-list"></i>
                    <span>les états des demandes</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800">Liste Des Stagiaires</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recherche</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>CIN</th>
                                            <th>Nom Prenom</th>
                                            <th>Sexe</th>
                                            <th>Department</th>
                                            <th>Ville</th>
                                            <th>Type</th>
                                            <th>STATUT</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require "../../helpers/condb.php";

                                        $query = "SELECT sr.*, st.TYPE, st.ID_DEPARTEMENT, d.STATUT, dp.NOM as DP_NOM
                                                    FROM stagiaire AS sr
                                                    LEFT JOIN stage AS st ON st.ID_STAGE = sr.ID_STAGE
                                                    LEFT JOIN dossier AS d ON d.ID_STAGE = sr.ID_STAGE
                                                    LEFT JOIN departement AS dp ON dp.ID_DEPARTEMENT = st.ID_DEPARTEMENT";

                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $presence) {
                                        ?>
                                                <tr>
                                                    <td class="align-middle"><?= $presence["CIN"] ?></td>
                                                    <td class="align-middle"><?= $presence["NOM"] . " " . $presence["PRENOM"] ?></td>
                                                    <td class="align-middle"><?= $presence["SEXE"] ?></td>
                                                    <td class="align-middle"><?= $presence["DP_NOM"] ?></td>
                                                    <td class="align-middle"><?= $presence["VILLE"] ?></td>
                                                    <td class="align-middle"><?= $presence["TYPE"] ?></td>
                                                    <td class="align-middle"><?= $presence["STATUT"] ?></td>
                                                    <td class="align-middle">
                                                        <a href="#" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                                        <button type="button" value="<?= $presence["ID_STAGE"]; ?>" class="editPresenceBtn btn btn-primary" data-toggle="modal" data-target="#editPresenceModal"><i class="fas fa-pen"></i></button>
                                                        <button type="button" value="<?= $presence["ID_STAGE"]; ?>" class="deletePresenceBtn btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Content Wrapper -->

        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("../includes/scripts.php"); ?>

    <!-- Page level plugins -->
    <script src="../../resources/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resources/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Call the dataTables jQuery plugin
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>