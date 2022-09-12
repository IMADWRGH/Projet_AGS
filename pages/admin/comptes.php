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
    <!-- Alertify styles -->
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/alertify.css" />
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/themes/bootstrap.css" />
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
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="departement.php">
                    <i class="fas fa-fw fa-inbox"></i>
                    <span>Gérer les departements</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="comptes.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Gérer les comptes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>À propos</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800">Comptes</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#createAccModal">Ajouter</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="accTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>État</th>
                                            <th>Créé à</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require "../../helpers/condb.php";

                                        $query = "SELECT ID_UTILISATEUR, USERNAME, PWD, `ROLE`, ETAT, created_at
                                        FROM utilisateur";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $result) {
                                                $color = $result['ETAT'] == 1 ? 'success' : 'secondary';
                                        ?>
                                                <tr>
                                                    <td class="align-middle"><?= $result["USERNAME"] ?></td>
                                                    <td class="align-middle"><?= $result["PWD"] ?></td>
                                                    <td class="align-middle"><?= $result["ROLE"] ?></td>
                                                    <td class="align-middle">
                                                        <span class="badge rounded-pill badge-<?= $color ?> p-2"><?= $result['ETAT'] == 1 ? 'activé' : 'désactivé' ?></span>
                                                    </td>
                                                    <td class="align-middle"><?= date("d-m-y", strtotime($result['created_at'])) ?></td>
                                                    <td>
                                                        <button type="button" value="<?= $result['ID_UTILISATEUR'] ?>" class="btn btn-primary btn-sm editBtn" data-toggle="modal" data-target="#editAccModal"><i class="fas fa-pen fa-fw"></i></button>
                                                        <button type="button" value="<?= $result['ID_UTILISATEUR'] ?>" class="btn btn-outline-danger btn-sm deleteAccBtn" data-toggle="modal" data-target="#deleteAccModal"><i class="fas fa-trash fa-fw"></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="7" class="alert alert-success text-center" role="alert">
                                                    ✅ il n'y a pas de demandes pour le moment ✅
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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

    <!-- Create Account Modal-->
    <div class="modal fade" id="createAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crée Compte</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="createAcc">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                        <div class="mb-3">
                            <label for="username_new">Nom d'utilisateur</label>
                            <input type="text" name="username_new" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="pwd_new">Mote de passe</label>
                            <input type="text" name="pwd_new" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="role_new">Role :</label>
                            <select class="form-control mr-sm-2" name="role_new">
                                <option selected>Choose...</option>
                                <option value="presense">Securite</option>
                                <option value="secretaire">Secretaire</option>
                                <option value="chef">Chef DEP</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="etat_new">Etat de compte</label> <br />
                            <input type="radio" name="etat_new" value="1" class="form-check-label mx-2">Activé
                            <input type="radio" name="etat_new" value="0" class="form-check-label mx-2">Desactivé
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Departement Modal-->
    <div class="modal fade" id="editAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Compte</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateAcc">
                    <div class="modal-body">
                        <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                        <input type="hidden" name="acc_id" id="acc_id">
                        <div class="mb-3">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" name="username" id="username-acc" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="pwd">Mote de passe</label>
                            <input type="text" name="pwd" id="pwd-acc" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="role">Role :</label>
                            <select class="form-control mr-sm-2 roleUpdate" name="role">
                                <option selected>Choose...</option>
                                <option value="presense">Securite</option>
                                <option value="secretaire">Secretaire</option>
                                <option value="chef">Chef DEP</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="etat">Etat de compte</label> <br />
                            <input type="radio" name="etat" id="acc-on" value="1" class="form-check-label mx-2">Activé
                            <input type="radio" name="etat" id="acc-off" value="0" class="form-check-label mx-2">Desactivé
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

    <?php include("../includes/scripts.php"); ?>

    <!-- Page level plugins -->
    <script src="../../resources/vendor/alertify/alertify.min.js"></script>

    <script>
        $(document).ready(function() {
            //Fetch And Fill Inputs Modal Before Update Presence
            $(document).on('click', '.editBtn', function(e) {

                let acc_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "handle-acc.php?acc_id=" + acc_id,
                    success: function(response) {

                        let res = jQuery.parseJSON(response)

                        if (res.status === 404) {

                            $('#message').removeClass('d-none');
                            $('#errorMessageUpdate').text(res.message);

                        } else if (res.status === 200) {

                            $('#exampleModalLabel').text("Edit compte [ " + res.data.USERNAME + " ]")
                            $('#acc_id').val(res.data.ID_UTILISATEUR)
                            $('#username-acc').val(res.data.USERNAME)
                            $('#pwd-acc').val(res.data.PWD)
                            $("select.roleUpdate option[value=" + res.data.ROLE + "]").attr("selected", "selected");
                            res.data.ETAT ?
                                $('#acc-on').prop('checked', true) :
                                $('#acc-off').prop('checked', false)

                        }
                    }
                });
            });

            // Create Account
            $(document).on('submit', '#createAcc', function(e) {

                e.preventDefault();
                let formData = new FormData(this);
                formData.append("create_acc", true);

                $.ajax({
                    type: "POST",
                    url: "handle-acc.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        let res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            $('#errorMessageUpdate').removeClass('d-none');
                            $('#errorMessageUpdate').text(res.message);

                        } else if (res.status === 200) {
                            $('#errorMessageUpdate').addClass('d-none');
                            $('#createAccModal').modal('hide');
                            $('#createAcc')[0].reset();
                            $("#accTable").load(location.href + " #accTable");
                            alertify.success(res.message);
                        }
                    }
                });
            });

            //Update Account
            $(document).on('submit', '#updateAcc', function(e) {

                e.preventDefault();
                let formData = new FormData(this)
                formData.append("update_acc", true)

                $.ajax({
                    type: "POST",
                    url: "handle-acc.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        let res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            $('#errorMessageUpdate').removeClass('d-none');
                            $('#errorMessageUpdate').text(res.message);

                        } else if (res.status === 200) {
                            $('#errorMessageUpdate').addClass('d-none');
                            $('#editAccModal').modal('hide');
                            $('#updateAcc')[0].reset();
                            $("#accTable").load(location.href + " #accTable");
                            alertify.success(res.message);
                        }
                    }
                });
            });

            //Delete Presence
            $(document).on('click', '.deleteAccBtn', function(e) {

                e.preventDefault();

                if (confirm("are you sure u want delete this record?")) {
                    let acc_id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "handle-acc.php",
                        data: {
                            'delete_acc': true,
                            'acc_id': acc_id,
                        },
                        success: function(response) {
                            let res = jQuery.parseJSON(response);

                            if (res.status === 500) {

                                alertify.error('Error');

                            } else if (res.status === 200) {
                                alertify.success('Success');
                                $("#accTable").load(location.href + " #accTable");
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>