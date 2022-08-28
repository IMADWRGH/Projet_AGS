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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <img src="../../resources/img/abhoer_md_icon.png" alt="abhoer-icon" style="width: 35%;">
                <div class="sidebar-brand-text mx-2">ABHOER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Accueil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="show.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>les liste des Stagiaires</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom</th>
                                            <th>CIN</th>
                                            <th>M.Entree</th>
                                            <th>M.Sortie</th>
                                            <th>A.Entree</th>
                                            <th>A.Sortie</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require "../../helpers/condb.php";

                                        $query = "SELECT h.*, sr.NOM, sr.PRENOM, sr.CIN
                                                    FROM presence AS h
                                                    LEFT JOIN stagiaire AS sr ON h.ID_STAGE = sr.ID_STAGE";

                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $presence) {
                                        ?>
                                                <tr>
                                                    <td class="align-middle"><?= date("d-m-y", strtotime($presence["DATE"])) ?></td>
                                                    <td class="align-middle"><?= $presence["NOM"] ?> <?= $presence["PRENOM"] ?></td>
                                                    <td class="align-middle"><?= $presence["CIN"] ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_ENTRE_M"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_SORTIE_M"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_ENTRE_A"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_SORTIE_A"])) ?></td>
                                                    <td class="align-middle">
                                                        <a href="#" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                                        <button type="button" value="<?= $presence["ID_PRESENCE"]; ?>" class="editPresenceBtn btn btn-info" data-toggle="modal" data-target="#editPresenceModal"><i class="fas fa-pen"></i></button>
                                                        <button type="button" value="<?= $presence["ID_PRESENCE"]; ?>" class="deletePresenceBtn btn btn-danger"><i class="fas fa-trash"></i></a>
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
        //Fetch And Fill Inputs Modal Before Update Presence
        $(document).on('click', '.editPresenceBtn', function(e) {

            var presence_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "edit.php?presence_id=" + presence_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response)

                    if (res.status === 404) {

                        $('#message').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status === 200) {

                        $('#exampleModalLabel').text(res.data.NOM + " " + res.data.PRENOM)
                        $('#presence_id').val(res.data.ID_PRESENCE)
                        $('#m-in').val(res.data.HR_ENTRE_M)
                        $('#m-out').val(res.data.HR_SORTIE_M)
                        $('#a-in').val(res.data.HR_ENTRE_A)
                        $('#a-out').val(res.data.HR_SORTIE_A)
                        $('#editPresenceModal').modal('show');

                    }
                }
            });
        });

        //Update Presence
        $(document).on('submit', '#updatePresence', function(e) {

            e.preventDefault();

            var formData = new FormData(this)
            formData.append("update_presence", true)

            $.ajax({
                type: "POST",
                url: "edit.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status === 500) {

                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status === 200) {
                        $('#errorMessageUpdate').addClass('d-none');
                        $('#editPresenceModal').modal('hide');
                        $('#updatePresence')[0].reset();

                        $("#dataTable").load(location.href + " #dataTable");
                    }
                }
            });
        });

        //Delete Presence
        $(document).on('click', '.deletePresenceBtn', function(e) {

            e.preventDefault();
            if (confirm("are you sure u want delete this record?")) {
                var presence_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: {
                        'delete_presence': true,
                        'presence_id': presence_id,
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            alertify.error('Error notification message.');

                        } else if (res.status === 200) {
                            alertify.success('Success notification message.');
                            $("#dataTable").load(location.href + " #dataTable");
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>