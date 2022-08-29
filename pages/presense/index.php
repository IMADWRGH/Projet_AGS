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
    <link href="../../resources/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Suivi les heures de présence</h1>

                    <!-- Saisi -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Recherche et Saisi</h6>
                                <div class="form-group col-auto p-0 m-0">
                                    <div class="input-group col-auto p-0 position-relative">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-search" style="color:darkgray"></i></div>
                                        </div>
                                        <input type="search" class="form-control form-control-sm" id="autocomplete" autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="createPresence">
                                <div class="form-row justify-content-between">
                                    <div class="form-group col-auto">
                                        <label for="email">Nom Prenom</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="stagiaire_name" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="m-in">Horaires de présence</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" class="form-control timepicker" name="m-in" id="inlineFormInputGroup" placeholder="M.Entre">
                                            <input type="text" class="form-control" name="m-out" id="inlineFormInputGroup" placeholder="M.Sortie">
                                            <input type="text" class="form-control" name="a-in" id="inlineFormInputGroup" placeholder="A.Entre">
                                            <input type="text" class="form-control" name="a-out" id="inlineFormInputGroup" placeholder="A.Sortie">
                                        </div>
                                    </div>
                                    <div class="form-group col-auto" style="margin-top:32px">
                                        <button type="submit" class="btn btn-primary" id="stage_id" disabled><i class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- In Only -->
                    <div id="listeStagiaireIn">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Stagiaires présents</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                require "../../helpers/condb.php";

                                $query = "SELECT h.*, sr.NOM, sr.PRENOM
                                        FROM presence AS h
                                        LEFT JOIN stagiaire AS sr ON h.ID_STAGE = sr.ID_STAGE
                                        WHERE `DATE` = CURRENT_DATE";

                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $presence) {
                                ?>
                                        <form name="<?= $presence['ID_PRESENCE'] ?>">
                                            <div class="form-row justify-content-between">
                                                <input type="hidden" name="presence_id" id="presence_id">
                                                <div class="form-group col-auto">
                                                    <div class="input-group col-auto p-0 mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-user"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" value="<?= $presence['NOM'] . " " . $presence['PRENOM'] ?>" id="stagiaire_name" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="input-group col-auto p-0 mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control toggle-input" name="m-in" value="<?= date("H:i", strtotime($presence["HR_ENTRE_M"])) ?>" id="inlineFormInputGroup" placeholder="M.Entre" disabled>
                                                        <input type="text" class="form-control toggle-input" name="m-out" value="<?= date("H:i", strtotime($presence["HR_SORTIE_M"])) ?>" id="inlineFormInputGroup" placeholder="M.Sortie" disabled>
                                                        <input type="text" class="form-control toggle-input" name="a-in" value="<?= date("H:i", strtotime($presence["HR_ENTRE_A"])) ?>" id="inlineFormInputGroup" placeholder="A.Entre" disabled>
                                                        <input type="text" class="form-control toggle-input" name="a-out" value="<?= date("H:i", strtotime($presence["HR_SORTIE_A"])) ?>" id="inlineFormInputGroup" placeholder="A.Sortie" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <button type="button" class="btn btn-info"><i class="fas fa-magic"></i></button>
                                                    <button type="button" class="btn btn-primary editBtn" value="<?= $presence['ID_PRESENCE'] ?>"><i class="fas fa-pen"></i></button>
                                                    <button type="button" class="btn btn-success d-none saveBtn" value="<?= $presence['ID_PRESENCE'] ?>"><i class="fas fa-save"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                <?php
                                    }
                                }
                                ?>
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
    <script src="../../resources/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../resources/vendor/jquery-timepicker/jquery.timeAutocomplete.js"></script>
    <script src="../../resources/vendor/jquery-timepicker/formatters/24hr.js"></script>

    <script>
        $(document).ready(function() {
            // Call the dataTables jQuery plugin
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            //Live Search Stagiaire
            $("#autocomplete").keyup(function() {

                $("#autocomplete").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            type: 'POST',
                            url: "search.php",
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#autocomplete').val(ui.item.label); // display the selected text
                        $('#stagiaire_name').val(ui.item.label); // cast full name to input
                        $("#stage_id").val(ui.item.value); // save id stagiaire to saveBtn
                        updateTimePicker();
                        return false;
                    },
                    focus: function(event, ui) {
                        $("#autocomplete").val(ui.item.label);
                        $("#stagiaire_name").val(ui.item.label);
                        $("#stage_id").val(ui.item.value);
                        updateTimePicker();
                        return false;
                    },
                    response: function(event, ui) {
                        if (ui.content.length == 0) {
                            $("#stage_id").prop('disabled', true);

                        } else if (ui.content.length != 0) {
                            $("#stage_id").prop('disabled', false);
                        }
                    }
                });
            });

            //Create Presence
            $(document).on('submit', '#createPresence', function(e) {

                e.preventDefault();
                var stage_id = e.originalEvent.submitter.value

                var formData = new FormData(this)
                formData.append("create_presence", true)
                formData.append("stage_id", stage_id);

                $.ajax({
                    type: "POST",
                    url: "create.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        var res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            alertify.error(res.message);
                            console.error(res.error)
                            $("#stage_id").prop('disabled', true);
                            $('input.timepicker').data('timeAutocomplete').destroy();

                        } else if (res.status === 200) {

                            alertify.success(res.message);
                            $('#autocomplete').val("");
                            $('#createPresence')[0].reset();
                            $("#stage_id").prop('disabled', true);
                            $("#listeStagiaireIn").load(location.href + " #listeStagiaireIn");
                            $('input.timepicker').data('timeAutocomplete').destroy();
                        }
                    }
                });
            });
        });

        // in-only enable inputs when click editBtn
        $(document).on('click', '.editBtn', function(e) {
            var presence_id = $(this).val();
            $("form[name=" + presence_id + "] input.toggle-input").prop('disabled', false);
            $(".editBtn[value=" + presence_id + "]").hide();
            $(".saveBtn[value=" + presence_id + "]").removeClass("d-none")
        });


        function updateTimePicker() {
            $('input.timepicker').timeAutocomplete({
                formatter: '24hr',
                auto_complete: false,
                value: (new Date()).toLocaleTimeString('en-GB'),
                increment: 1
            });
        }
    </script>

</body>

</html>