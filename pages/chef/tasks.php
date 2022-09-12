<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("location: ../403.html");
    die;
}

$allowed = array("chef", "admin");
if (!in_array($_SESSION['role'], $allowed)) {
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
    <title>Panel - Chef</title>
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
                <a class="nav-link" href="requests.php">
                    <i class="fas fa-fw fa-inbox"></i>
                    <span>dernières demandes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="list.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>liste des stagiaires</span></a>
            </li>

            <li class="nav-item active">
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
                    <h1 class="h3 mb-2 text-gray-800">Activités réalisés pendant le stage</h1>

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
                            <form id="createTache">
                                <div class="form-row justify-content-between">
                                    <div class="form-group col-auto">
                                        <label>Nom Prénom</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="stagiaire_name" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label>Stage type</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-code-branch"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="stage_type" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label>Stage durée</label>
                                        <div class="input-group col-auto p-0 mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="stage_duree" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr class="sidebar-divider m-0 mb-3">
                                <div class="form-row justify-content-between">
                                    <div class="form-group col-auto">
                                        <label for="nom">Tâches réalisées</label>
                                        <textarea class="form-control" name="nom_tache" cols="25"></textarea>
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="temps">Temps déployé</label>
                                        <input type="number" class="form-control" name="temps" placeholder="(jours)">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="materiels">Matériels</label>
                                        <textarea class="form-control" name="materiels" cols="25"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-auto float-right" style="margin-top:32px">
                                    <button type="submit" class="btn btn-primary" id="stage_id" disabled><i class="fas fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- list tasks -->
                    <div id="listeTaches">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Stagiaires tâches</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                require "../../helpers/condb.php";
                                $query = "SELECT ID_TACHE, TACHE, TEMPS, MATERIEL, t.ID_STAGE, sr.NOM, sr.PRENOM
                                        FROM tache AS t
                                        LEFT JOIN stage AS st ON st.ID_STAGE = t.ID_STAGE
                                        LEFT JOIN stagiaire AS sr ON sr.ID_STAGE = t.ID_STAGE
                                        ORDER BY t.created_at DESC";

                                $query_run = mysqli_query($con, $query);

                                //TODO: Switch to presente result in table (DataTable)
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $task) {
                                ?>
                                        <form name="<?= $task['ID_TACHE'] ?>" id="updateTache">
                                            <div class="form-row justify-content-between">
                                                <div class="form-group col-auto">
                                                    <div class="input-group col-auto p-0 mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="far fa-user"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" value="<?= $task['NOM'] . " " . $task['PRENOM'] ?>" id="stagiaire_name" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group col-auto align-self-end">
                                                    <button type="button" class="btn btn-primary editBtn" value="<?= $task['ID_TACHE'] ?>"><i class="fas fa-pen"></i></button>
                                                    <button type="submit" class="btn btn-success d-none saveBtn" value="<?= $task['ID_TACHE'] ?>"><i class="fas fa-save"></i></button>
                                                </div>
                                            </div>
                                            <div class="form-row justify-content-between">
                                                <div class="form-group col-auto">
                                                    <label for="nom">Tâches réalisées</label>
                                                    <textarea class="form-control toggle-input" name="nom_tache_update" cols="25" rows="1" disabled><?= $task['TACHE'] ?></textarea>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <label for="temps">Temps déployé (j)</label>
                                                    <input type="number" class="form-control toggle-input" name="temps_update" value="<?= $task['TEMPS'] ?>" disabled>
                                                </div>
                                                <div class="form-group col-auto">
                                                    <label for="materiels">Matériels</label>
                                                    <textarea class="form-control toggle-input" name="materiels_update" cols="25" rows="1" disabled><?= $task['MATERIEL'] ?></textarea>
                                                </div>
                                            </div>
                                            <hr class="sidebar-divider m-0 mb-3">
                                        </form>
                                <?php
                                    }
                                }
                                ?>
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
    <script src="../../resources/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../resources/vendor/jquery-timepicker/jquery.timeAutocomplete.js"></script>

    <script>
        $(document).ready(function() {
            //Live Search Stagiaire
            $("#autocomplete").keyup(function() {

                $("#autocomplete").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            type: 'POST',
                            url: "handle-task.php",
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function(data) {
                                response(data);

                                const DATE_D = (new Date(data[1].DATE_D)).toLocaleDateString('en-GB', {
                                    month: 'numeric',
                                    day: 'numeric'
                                });
                                const DATE_F = (new Date(data[1].DATE_F)).toLocaleDateString('en-GB', {
                                    month: 'numeric',
                                    day: 'numeric'
                                });

                                $("#stage_id").val(data.ID_STAGE);
                                $("#stage_type").val(data[1].TYPE);
                                $("#stage_duree").val(DATE_D + " -> " + DATE_F);
                                $("#listeTaches").load(location.href + " #listeTaches");
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#autocomplete').val(ui.item.label); // display the selected text
                        $('#stagiaire_name').val(ui.item.label); // cast full name to input
                        $("#stage_id").val(ui.item.value); // save id stagiaire to saveBtn
                        $("#listeTaches").load(location.href + " #listeTaches");
                        return false;
                    },
                    focus: function(event, ui) {
                        $("#autocomplete").val(ui.item.label);
                        $("#stagiaire_name").val(ui.item.label);
                        $("#stage_id").val(ui.item.value);
                        $("#listeTaches").load(location.href + " #listeTaches");
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

            //Create Tache
            $(document).on('submit', '#createTache', function(e) {

                e.preventDefault();
                let stage_id = e.originalEvent.submitter.value;

                let formData = new FormData(this);
                formData.append("create_tache", true);
                formData.append("stage_id", stage_id);

                $.ajax({
                    type: "POST",
                    url: "handle-task.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        let res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            alertify.error(res.message);
                            console.error(res.error)
                            $("#stage_id").prop('disabled', true);

                        } else if (res.status === 200) {

                            alertify.success(res.message);
                            $('#autocomplete').val("");
                            $('#createTache')[0].reset();
                            $("#stage_id").prop('disabled', true);
                            $("#listeTaches").load(location.href + " #listeTaches");
                        }
                    }
                });
            });

            // When click editBtn enable inputs and show saveBtn
            $(document).on('click', '.editBtn', function(e) {
                let tache_id = $(this).val();
                $("form[name=" + tache_id + "] .toggle-input").prop('disabled', false);
                $(".editBtn[value=" + tache_id + "]").hide();
                $(".saveBtn[value=" + tache_id + "]").removeClass("d-none");
            });

            //Update TACHE (task)
            $(document).on('submit', '#updateTache', function(e) {

                e.preventDefault();
                let tache_id = $(this).attr('name');

                formData = new FormData(this)
                formData.append("update_tache", true)
                formData.append("tache_id", tache_id);

                $.ajax({
                    type: "POST",
                    url: "handle-task.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        let res = jQuery.parseJSON(response);

                        if (res.status === 500) {

                            alertify.error(res.message);
                            console.error(res.error)

                        } else if (res.status === 200) {

                            alertify.success(res.message);
                            $("#listeTaches").load(location.href + " #listeTaches");

                        }
                    }
                });
            });
        });
    </script>

</body>

</html>