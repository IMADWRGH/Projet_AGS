<?php
session_start();
$allowed = array("chef", "admin");
if (!isset($_SESSION['role'])) {
    header("location: ../403.html");
    die;
}

if (!in_array($_SESSION['role'], $allowed)) {
    header("location: ../403.html");
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
    <!-- Custom styles for this page -->
    <link href="../../resources/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Alertify styles -->
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/alertify.css" />
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/themes/bootstrap.css" />
    <!-- Font Awesome  -->
    <link href="../../resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Style Details Control ( first column in table ) -->
    <style>
        td.details-control {
            text-align: center;
            color: forestgreen;
            cursor: pointer;
        }

        tr.shown td.details-control {
            text-align: center;
            color: red;
        }
    </style>
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

            <li class="nav-item active">
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
                    <h1 class="h3 mb-2 text-gray-800">Liste Des Stagiaires</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Aperçu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            <th>Nom Prenom</th>
                                            <th>Type</th>
                                            <th>Date_D</th>
                                            <th>Date_F</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Registre de présence</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Recherche</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="presenceTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Nom Prenom</th>
                                            <th>Entre_M</th>
                                            <th>Sortie_M</th>
                                            <th>Entre_A</th>
                                            <th>Sortie_A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require "../../helpers/condb.php";
                                        $query = "SELECT sr.ID_STAGE, sr.NOM, sr.PRENOM, p.DATE, p.HR_ENTRE_M, p.HR_SORTIE_M, p.HR_ENTRE_A, p.HR_SORTIE_A
                                            FROM presence AS p
                                            LEFT JOIN stagiaire AS sr ON sr.ID_STAGE = p.ID_STAGE
                                            WHERE sr.NOM LIKE '%' OR sr.PRENOM LIKE '%' OR sr.ID_STAGE = ''";

                                        $query_run = mysqli_query($con, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $presence) {
                                        ?>
                                                <tr>
                                                    <td class="align-middle"><?= date("d-m-y", strtotime($presence["DATE"])) ?></td>
                                                    <td class="align-middle"><?= $presence["NOM"] ?> <?= $presence["PRENOM"] ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_ENTRE_M"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_SORTIE_M"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_ENTRE_A"])) ?></td>
                                                    <td class="align-middle"><?= date("H:i", strtotime($presence["HR_SORTIE_A"])) ?></td>
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
                <!-- /.container-fluid -->
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
    <script src="../../resources/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resources/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../resources/vendor/alertify/alertify.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            // list stagiaire table
            $('#dataTable').DataTable();
            // Precense table
            $('#presenceTable').DataTable();
        });
    </script>

    <script type="text/javascript">
        // list stagiaire table
        let dt = $("#dataTable").DataTable({
            'ajax': {
                url: 'list-data.php'
            },
            columns: [{
                    'className': 'details-control',
                    'orderable': false,
                    'data': null,
                    'defaultContent': '',
                    'render': function() {
                        return '<i class="fas fa-plus"></i>'
                    }
                },
                {
                    data: 'NOM',
                },
                {
                    data: 'TYPE',
                },
                {
                    data: 'DATE_D',
                    render: function(data, type, row) {
                        if (type === "sort" || type === "type") {
                            return data;
                        }
                        return (new Date(data)).toLocaleDateString('en-GB');
                    }
                },
                {
                    data: 'DATE_F',
                    render: function(data, type, row) {
                        if (type === "sort" || type === "type") {
                            return data;
                        }
                        return (new Date(data)).toLocaleDateString('en-GB');
                    }
                },
            ],
            order: [
                [1, 'asc']
            ],
        })

        function format(d) {
            return '<table class="table table-borderless table-sm m-0" pl-2>' +
                '<tr>' +
                '<th>CIN : ' + '</th>' +
                '<td>' + d.CIN + '</td>' +
                '<th>Sexe : ' + '</th>' +
                '<td>' + d.SEXE + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Niveau : ' + '</th>' +
                '<td>' + d.NIVEAU + '</td>' +
                '<th>Etablissement : ' + '</th>' +
                '<td>' + d.ETABLISSEMENT + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Tel : ' + '</th>' +
                '<td>' + d.TEL + '</td>' +
                '<th>Email : ' + '</th>' +
                '<td>' + d.EMAIL + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Ville : ' + '</th>' +
                '<td>' + d.VILLE + '</td>' +
                '<th>Adresse : ' + '</th>' +
                '<td>' + d.ADRESSE + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Departement : ' + '</th>' +
                '<td>' + d.DP_NOM + '</td>' +
                '<th>Encadrant : ' + '</th>' +
                '<td>' + d.ENCADRANT + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Demande Statut : ' + '</th>' +
                '<td>' + d.STATUT + '</td>' +
                '<th>Evaluation Termine : ' + '</th>' +
                '<td>' + (d.TERMINE ? "oui" : "non") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th>Piece Jointes : ' + '</th>' +
                '<td colspan="2">' +
                (d.CV ? '<a class="pr-3" href="../../uploads/cv/' + d.CV + '" target="_blank"><i class="fas fa-external-link-alt"></i>CV</a>' : '--- | ') +
                (d.DEMANDE ? '<a class="pr-3" href="../../uploads/demande/' + d.DEMANDE + '" target="_blank"><i class="fas fa-external-link-alt"></i>Demande</a>' : '--- | ') +
                (d.ASSURANCE ? '<a class="pr-3" href="../../uploads/assurance/' + d.ASSURANCE + '" target="_blank"><i class="fas fa-external-link-alt"></i>Assurance</a>' : '---') +
                '</td>' +
                '</tr>'

        }

        let detailRows = [];

        $('#dataTable tbody').on('click', 'tr td.details-control', function() {
            let tr = $(this).closest('tr');
            let row = dt.row(tr);
            let idx = detailRows.indexOf(tr.attr('id'));

            if (row.child.isShown()) {
                tr.removeClass('details');
                row.child.hide();
                tr.removeClass('shown');
                $('tr i').attr('class', 'fas fa-plus');

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');
                row.child(format(row.data())).show();
                tr.addClass('shown');
                $('tr.shown i').attr('class', 'fas fa-minus');

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
        });

        dt.on('draw', function() {
            detailRows.forEach(function(id, i) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });
    </script>
</body>

</html>