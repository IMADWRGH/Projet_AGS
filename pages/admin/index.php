<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("location: ../403.html");
    die;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel - Admin</title>
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../resources/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../resources/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- Font Awesome  -->
    <link href="../../resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                <a class="nav-link" href="departement.php">
                    <i class="fas fa-fw fa-inbox"></i>
                    <span>G??rer les departements</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="comptes.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>G??rer les comptes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>?? propos</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800">??tats des stagiaires</h1>

                    <div class="row">

                        <?php
                        // Count STATUT query (Ex: en attande:4, accepte:2...)
                        require "../../helpers/condb.php";

                        $query = "SELECT d.STATUT, st.DATE_D, st.DATE_F, st.TERMINE,
                        count(CASE WHEN STATUT = 'accepte' THEN STATUT END) AS acc_count,
                        count(CASE WHEN STATUT = 'en attente' THEN STATUT END) AS att_count,
                        count(CASE WHEN TERMINE = 1 THEN TERMINE END) AS ter_count,
                        count(CASE WHEN CURRENT_DATE > st.DATE_F AND TERMINE = 0 THEN STATUT END) AS aba_count
                        FROM dossier AS d
                        LEFT JOIN stage AS st ON st.ID_STAGE = d.ID_STAGE
                        LEFT JOIN evaluation AS e ON e.ID_STAGE = st.ID_STAGE";

                        $query_run = mysqli_query($con, $query);
                        $statut;
                        if (mysqli_num_rows($query_run) > 0) {
                            $statut = mysqli_fetch_assoc($query_run);
                        }
                        ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Stagiaires actuels
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statut ? $statut['acc_count'] : "" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Demandes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statut ? $statut['att_count'] : "" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Stagiaires termin??s</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statut ? $statut['ter_count'] : "" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                stagiaires abandonn??s</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statut ? $statut['aba_count'] : "" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">??tats des departements</h1>

                    <div class="row">

                        <div class="card shadow mb-4 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                                            <div class="col flex-fill p-0 font-weight-bold">Departement nom</div>
                                            <div class="col flex-fill p-0 font-weight-bold">Chef nom</div>
                                            <div class="col flex-fill p-0 font-weight-bold">Stagiaires actuels</div>
                                        </li>
                                        <?php
                                        $query = "SELECT dp.NOM, dp.CHEF, u.USERNAME, st.TERMINE,
                                        count(CASE WHEN TERMINE = 0 THEN TERMINE END) AS act_count
                                        FROM departement AS dp
                                        LEFT JOIN stage AS st ON st.ID_DEPARTEMENT = dp.ID_DEPARTEMENT
                                        LEFT JOIN utilisateur AS u ON u.USERNAME = dp.CHEF 
                                        GROUP BY dp.NOM";
                                        $query_run = mysqli_query($con, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $result) {
                                        ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="col flex-fill p-0"><?= $result['NOM'] ?></div>
                                                    <div class="col flex-fill p-0"><?= $result['CHEF'] ?></div>
                                                    <div class="col flex-fill p-0"><?= $result['act_count'] ?></div>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">??tats des comptes</h1>

                    <div class="row">

                        <div class="card shadow mb-4 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                                            <div class="col flex-fill p-0 font-weight-bold">Nom d'utilisateur</div>
                                            <div class="col flex-fill p-0 font-weight-bold">Role</div>
                                            <div class="col flex-fill p-0 font-weight-bold">??tat</div>
                                            <div class="col flex-fill p-0 font-weight-bold">Cr???? ??</div>
                                        </li>
                                        <?php
                                        $query = "SELECT USERNAME, `ROLE`, ETAT, created_at
                                        FROM utilisateur";
                                        $query_run = mysqli_query($con, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $result) {
                                                $color = $result['ETAT'] == 1 ? 'success' : 'secondary'
                                        ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="col flex-fill p-0"><?= $result['USERNAME'] ?></div>
                                                    <div class="col flex-fill p-0"><?= $result['ROLE'] ?></div>
                                                    <div class="col flex-fill p-0">
                                                        <span class="badge rounded-pill badge-<?= $color ?> p-2"><?= $result['ETAT'] == 1 ? 'activ??' : 'd??sactiv??' ?></span>
                                                    </div>
                                                    <div class="col flex-fill p-0"><?= date("d-m-y", strtotime($result['created_at'])) ?></div>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <span aria-hidden="true">??</span>
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

    <?php include("../includes/scripts.php"); ?>
</body>

</html>