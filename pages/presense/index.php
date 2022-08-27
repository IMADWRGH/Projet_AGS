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

    <!-- Alertify styles -->
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/alertify.css" />
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/themes/bootstrap.css" />

    <!-- Custom styles for this page -->
    <link href="../../resources/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800">Enregistrement des horaires de présence</h1>

                    <!-- Saisi -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Recherche / Saisi</h6>
                                <div class="form-group col-auto p-0 m-0">
                                    <div class="input-group col-auto p-0 position-relative">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-search" style="color:darkgray"></i></div>
                                        </div>
                                        <input type="search" class="form-control form-control-sm" id="live_search">
                                        <!-- Dropdown Search result -->
                                        <div id="searchResult" class="bg-white border d-none" style="position: absolute; top: 42px; width: 220px;">
                                            <ul class="list-group">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row justify-content-between">
                                    <div class="form-group col-auto">
                                        <label for="email">Nom Prenom</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-user"></i></div>
                                            </div>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="m-in">Horaires de présence</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="m-in" id="inlineFormInputGroup" placeholder="M.Entre">
                                            <input type="text" class="form-control" name="m-out" id="inlineFormInputGroup" placeholder="M.Sortie">
                                            <input type="text" class="form-control" name="a-in" id="inlineFormInputGroup" placeholder="A.Entre">
                                            <input type="text" class="form-control" name="a-out" id="inlineFormInputGroup" placeholder="A.Sortie">
                                        </div>
                                    </div>
                                    <div class="form-group col-auto" style="margin-top:32px">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Stagiaires présents</h1>

                    <!-- In Only -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recherche / Saisi</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-row justify-content-between">
                                    <div class="form-group col-auto">
                                        <label for="email">Nom Prenom</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-user"></i></div>
                                            </div>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="m-in">Horaires de présence</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="m-in" id="inlineFormInputGroup" placeholder="M.Entre">
                                            <input type="text" class="form-control" name="m-out" id="inlineFormInputGroup" placeholder="M.Sortie">
                                            <input type="text" class="form-control" name="a-in" id="inlineFormInputGroup" placeholder="A.Entre">
                                            <input type="text" class="form-control" name="a-out" id="inlineFormInputGroup" placeholder="A.Sortie">
                                        </div>
                                    </div>
                                    <div class="form-group col-auto" style="margin-top:32px">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form>
                                <div class="form-row justify-content-between">
                                    <input type="hidden" name="presence_id" id="presence_id">
                                    <div class="form-group col-auto">
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-user"></i></div>
                                            </div>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="m-in" id="inlineFormInputGroup" placeholder="M.Entre">
                                            <input type="text" class="form-control" name="m-out" id="inlineFormInputGroup" placeholder="M.Sortie">
                                            <input type="text" class="form-control" name="a-in" id="inlineFormInputGroup" placeholder="A.Entre">
                                            <input type="text" class="form-control" name="a-out" id="inlineFormInputGroup" placeholder="A.Sortie">
                                        </div>
                                    </div>
                                    <div class="form-group col-auto">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                    </div>
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
                        <input type="hidden" name="presence_id" id="presence_id">
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

    <?php include("../includes/scripts.php") ?>

    <!-- Page level plugins -->
    <script src="../../resources/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resources/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../resources/vendor/alertify/alertify.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        //Live Search Stagiaire
        $(document).ready(function() {
            $("#live_search").keyup(function() {
                var input = $(this).val();

                //Ignore first character
                if (input != "") {
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: {
                            input: input
                        },
                        success: function(response) {

                            $("#searchResult").removeClass("d-none");
                            $("#searchResult").html(response)
                        }
                    })
                } else {
                    $("#searchResult").addClass("d-none");
                }
            });
        });
    </script>

</body>

</html>