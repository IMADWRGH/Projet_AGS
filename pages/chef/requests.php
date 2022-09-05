<?php
session_start();
$t = $_SESSION['role'];
$allowed = array("chef", "admin");
if (!isset($_SESSION['role'])) {
    header("location: ../403.html?ID=$t&d=1");
    die;
}

if (!in_array($t, $allowed)) {
    header("location: ../403.html?ID=$t&d=2");
    die;
}

if (!isset($_SESSION['chef'])) {
?>
    <div class="alert alert-warning alert-dismissible fade show m-0 text-center" role="alert">
        <strong>Mode Super Chef </strong>: Les résultats seront pour toutes les departemnts
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
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

            <li class="nav-item active">
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
                    <h1 class="h3 mb-2 text-gray-800">Demandes en attente</h1>

                    <div class="row">

                        <div class="card shadow mb-4 flex-fill">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="demandeTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">CV</th>
                                                <th scope="col">Nom Prenom</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Niveau</th>
                                                <th scope="col">Ecole</th>
                                                <th scope="col">Durée</th>
                                                <th scope="col" style="width: 150px;">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require("../../helpers/condb.php");
                                            $nomChef = !isset($_SESSION['chef']) ? "" : $_SESSION['chef'];
                                            $query = "SELECT sr.NOM, sr.PRENOM, sr.NIVEAU, sr.ETABLISSEMENT, st.DATE_D, st.DATE_F, st.TYPE, d.CV, d.ASSURANCE, d.updated_at, dp.NOM AS DP_NOM, st.ID_DEPARTEMENT, st.ID_STAGE
                                            FROM stage AS st
                                            LEFT JOIN stagiaire AS sr ON sr.ID_STAGE = st.ID_STAGE
                                            LEFT JOIN dossier AS d ON d.ID_STAGE = st.ID_STAGE
                                            LEFT JOIN departement AS dp ON dp.ID_DEPARTEMENT = st.ID_DEPARTEMENT
                                            WHERE d.STATUT = 'en attente' AND dp.CHEF LIKE '%$nomChef'
                                            ORDER BY d.updated_at DESC
                                            LIMIT 30";
                                            $query_run = mysqli_query($con, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $result) {
                                                    $date_s = new DateTime($result['DATE_D']);
                                                    $date_e = new DateTime($result['DATE_F']);
                                                    $diff = date_diff($date_s, $date_e);
                                            ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php if ($result['CV']) { ?>
                                                                <a href="../../uploads/cv/<?= $result["CV"] ?>" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                            <?php } ?>
                                                        </th>
                                                        <td> <?= $result['NOM'] . " " . $result['PRENOM'] ?> </td>
                                                        <td><?= strtoupper($result['TYPE']) ?></td>
                                                        <td><?= $result['NIVEAU'] ?></td>
                                                        <td><?= $result['ETABLISSEMENT'] ?></td>
                                                        <td>
                                                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="left" title="<?= date("d/m", strtotime($result['DATE_D'])) . "⬌" . date("d/m", strtotime($result['DATE_F'])) ?>"></i>
                                                            <small><?= $diff->format("%aj") ?></small>
                                                        </td>
                                                        <td>
                                                            <button type="button" value="<?= $result['ID_STAGE'] ?>" class="btn btn-secondary btn-sm viewBtn" data-toggle="modal" data-target="#demandeDetails"><i class="fas fa-eye fa-fw"></i></button>
                                                            <button type="button" value="<?= $result['ID_STAGE'] ?>" class="btn btn-success btn-sm checkBtn"><i class="fas fa-check fa-fw"></i></button>
                                                            <button type="button" value="<?= $result['ID_STAGE'] ?>" class="btn btn-outline-danger btn-sm removeBtn" data-toggle="modal" data-target="#rejectModal"><i class="fas fa-times fa-fw"></i></button>
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
                            <div class="card-footer"><small><i class="fas fa-info-circle text-gray-400"></i>Demandes triées de l'ancienne à la nouvelle</small></div>
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

    <!-- Demande Details Modal-->
    <div class="modal fade" id="demandeDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Demande Détails</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body px-4" id="viewDetails">
                    <div class="alert alert-warning d-none" id="errorMessageFetch"></div>
                    <input type="hidden" name="stage_id" id="stage_id">
                    <ul class="list-inline d-flex justify-content-between">
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">C.I.N</label>
                                <p id="cin" class="form-control">-</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Nom Prenom</label>
                                <p id="nom" class="form-control">-</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Sexe</label>
                                <p id="sexe" class="form-control">-</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline d-flex justify-content-between">
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Tel</label>
                                <p id="tel" class="form-control">-</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Email</label>
                                <p id="email" class="form-control">-</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Le nombre de ses demandes dans les archives de l'institution"></i>
                                <label class="font-weight-bold">Fois</label>
                                <p id="fois" class="form-control">0</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline d-flex justify-content-between">
                        <li class="list-inline-item flex-fill">
                            <div class="mb-3">
                                <label class="font-weight-bold">Address</label>
                                <p id="adresse" class="form-control">-</p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Ville</label>
                                <p id="ville" class="form-control">-</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline d-flex justify-content-between">
                        <li class="list-inline-item flex-fill">
                            <div class="mb-3">
                                <label class="font-weight-bold">Pièces Jointes</label>
                                <p id="pj" class="form-control">
                                    <i class="fas fa-paperclip"></i>
                                    <a class="cvLink" target="_blank" hidden>CV</a> ;
                                    <a class="deLink" target="_blank" hidden> Demande</a> ;
                                    <a class="asLink" target="_blank" hidden> Assurance</a>
                                </p>
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div class="mb-3">
                                <label class="font-weight-bold">Demande Déposé</label>
                                <p id="dateDepose" class="form-control">-</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline d-flex">
                        <li class="list-inline-item flex-fill">
                            <div class="mb-3">
                                <label class="font-weight-bold">Secretaire Commentaire</label>
                                <p id="cmntr" class="form-control text-break">-</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Modifier</button> -->
                    <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Demande Modal-->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Refuser</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning d-none" id="errorMessageUpdate"></div>
                    <p class="font-weight-bold">Souhaitez-vous refuser le stagiaire?</p>
                    <label>Raison</label>
                    <textarea class="form-control" id="raison" rows="2" maxlength="255" placeholder="Optionnel"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger rejectBtn" type="button" data-dismiss="modal">Refuser</button>
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
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
        // Bootstrap Tooltip
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // Reset modal data when close
        $('.modal').on('hidden.bs.modal', function(e) {
            $(this).removeData();
            // viewModal
            $('#viewDetails a').attr("hidden", true);
            // rejectModal
            $('textarea').val("")
        });

        // Modal autofocus input
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('textarea').focus();
        });
    </script>

    <script>
        $(document).ready(function() {
            //Fetch And Fill Inputs Modal Before Update Presence
            $(document).on('click', '.viewBtn', function(e) {

                let stage_id = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "handleDemandes.php",
                    data: {
                        'view_demande': true,
                        'stage_id': stage_id
                    },
                    success: function(response) {

                        let res = jQuery.parseJSON(response)

                        if (res.status === 404) {

                            $('#message').removeClass('d-none');
                            $('#errorMessageFetch').text(res.message);

                        } else if (res.status === 200) {

                            $('#cin').text(res.data.CIN);
                            $('#nom').text(res.data.NOM + " " + res.data.PRENOM);
                            $('#sexe').text(res.data.SEXE);
                            $('#tel').text(res.data.TEL);
                            $('#email').text(res.data.EMAIL);
                            $('#adresse').text(res.data.ADRESSE);
                            $('#ville').text(res.data.VILLE);
                            res.data.CV && $('.cvLink').removeAttr('hidden').attr('href', "../../uploads/cv/" + res.data.CV);
                            res.data.DEMANDE && $('.deLink').removeAttr('hidden').attr('href', "../../uploads/demande/" + res.data.DEMANDE);
                            res.data.ASSURANCE && $('.asLink').removeAttr('hidden').attr('href', "../../uploads/assurance/" + res.data.ASSURANCE);
                            $('#dateDepose').text((res.data.DATE_DEPOSE))
                            $('#cmntr').text(res.data.OBSERVATION);
                        }
                    }
                });
            });

            // When click rejectBtn update 'dossier[STATUT] = 'accepte''
            $(document).on('click', '.checkBtn', function(e) {

                let stage_id = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "handleDemandes.php",
                    data: {
                        'accepte_demande': true,
                        'stage_id': stage_id
                    },
                    success: function(response) {

                        let res = jQuery.parseJSON(response)

                        if (res.status === 500) {

                            alertify.error(res.message);

                        } else if (res.status === 200) {

                            alertify.success(res.message);
                            $("#demandeTable").load(location.href + " #demandeTable");
                        }
                    }
                });
            });

            // When click removeBtn pass data [stage_id] to modal 'rejectModal'
            $(".removeBtn").click(function() {
                let stage_id = $(this).val();
                $("#rejectModal .rejectBtn").val(stage_id);
            });

            // When click rejectBtn update 'dossier[STATUT] = 'refuse''
            $(document).on('click', '.rejectBtn', function(e) {

                let stage_id = $(this).val();
                let raison = $("#raison").val();

                $.ajax({
                    type: "POST",
                    url: "handleDemandes.php",
                    data: {
                        'refuse_demande': true,
                        'stage_id': stage_id,
                        'raison': raison,
                    },
                    success: function(response) {

                        let res = jQuery.parseJSON(response)

                        if (res.status === 500) {

                            alertify.error(res.message);

                        } else if (res.status === 200) {

                            alertify.success(res.message);
                            $("#demandeTable").load(location.href + " #demandeTable");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>