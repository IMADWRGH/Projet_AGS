<?php
session_start();
if (!isset($_SESSION['role'])) {
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
    <title>Panel - Secretaire</title>
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../resources/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../resources/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- Alertify styles -->
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/alertify.css" />
    <link rel="stylesheet" href="../../resources/vendor/alertify/css/themes/bootstrap.css" />
    <!-- Fileinput plugin styling CSS file -->
    <link rel="stylesheet" href="../../resources/vendor/input-file/css/fileinput.min.css" />
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

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
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
                    <h1 class="h3 mb-2 text-gray-800">Ajouter Un Stagiaire</h1>

                    <!-- Content Row -->
                    <form method="POST" action="create.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-xs-4 col-md-3">
                                        <label for="cin" class="control-label"> CIN :</label>
                                        <input type="text" name="cin" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-4 flex-fill">
                                        <label for="nom" class="control-label">Nom :</label>
                                        <input type="text" class="form-control" name="nom" id="inlineFormInputGroup">
                                    </div>
                                    <div class="form-group col-xs-4 flex-fill">
                                        <label for="prenom" class="control-label">Prénom :</label>
                                        <input type="text" class="form-control" name="prenom" id="inlineFormInputGroup">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-xs-4 flex-fill">
                                        <label for="mail">Email :</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email...">
                                    </div>
                                    <div class="form-group col-xs-4 col-md-5">
                                        <label for="tel">Tel :</label>
                                        <input type="tel" class="form-control" name="tel" placeholder="+212">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-xs-4 flex-fill">
                                        <label for="adress">Adresse :</label>
                                        <input type="text" class="form-control" name=" adress" placeholder="Rue 45 bloc 8...">
                                    </div>
                                    <div class="form-group col-xs-4 col-md-5">
                                        <label class="control" for="ville">Ville :</label>
                                        <select class="custom-select mr-sm-2" name="ville">
                                            <option selected>Choose...</option>
                                            <option value="fes">Fes</option>
                                            <option value="bm">BM</option>
                                            <option value="casa">Casa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-xs-4 col-md-4">
                                        <label for="niveau">Niveau</label>
                                        <input type="text" class="form-control" name="niveau" placeholder="Bac+...">
                                    </div>
                                    <div class="form-group col-xs-4 flex-fill">
                                        <label for="uv">Etablissement</label>
                                        <input type="text" class="form-control" name="uv" placeholder="université...">
                                    </div>
                                    <div class="form-group col-xs-4 col-md-auto">
                                        <label class="control-label mb-3">Sexe :</label>
                                        <div class="radio pl-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sexe" id="inlineRadio1" value="M" style="transform: scale(1.5);">
                                                <label class=" form-check-label pl-2" for="sexe">Masculin</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sexe" id="inlineRadio2" value="F" style="transform: scale(1.5);">
                                                <label class="form-check-label pl-2" for="sexe">Feminim</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-row">
                                    <div class="form-group col-xs-4 col-md-auto ml-1 flex-fill">
                                        <label class="file-label" for="assurance">Assurance :</label>
                                        <input type="file" class="file-input border mb-2" name="assurance" id="inputFile">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-xs-4 col-md-auto ml-1 flex-fill">
                                        <label class="file-label" for="demande">Demande :</label>
                                        <input type="file" class="file-input border mb-2" name="demande" id="inputFile">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-xs-4 col-md-auto ml-1 flex-fill">
                                        <label class="file-label" for="cv">CV :</label>
                                        <input type="file" class="file-input border" name="cv" id="inputFile">
                                    </div>
                                </div>
                                <p class="pl-2"><i class="fas fa-file-code fa-lg"></i> type autorisé :
                                    <small class="badge badge-danger" style="background-color: rgba( 220, 53, 69, 0.7);">PDF</small>
                                    <small class="badge badge-primary" style="background-color: rgba( 0, 123, 255, 0.7);">DOCX</small>
                                    <small class="badge badge-success" style="background-color: rgba( 40, 167, 69, 0.7);">IMAGE</small>
                                </p>
                                <p class="pl-2"><i class="fas fa-file-archive fa-lg"></i> taille maximale :
                                    <small class="badge badge-success" style="background-color: rgba( 23, 162, 184, 0.7);">5 MB</small>
                                </p>
                            </div>
                        </div>
                        <div class="row justify-content-end align-items-end">
                            <!-- <div class="form-row justify-content-end align-items-end"> -->
                            <div class="form-group col-xs-4 align-self-end">
                                <button type="submit" class="btn btn-primary mr-2" name="ok">Ajouter</button>
                            </div>
                            <div class="form-group col-xs-4">
                                <button type="reset" class="btn btn-outline-dark" name="ok">Cancel</button>
                            </div>
                            <!-- </div> -->
                        </div>
                    </form>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("../includes/scripts.php"); ?>

    <!-- buffer.min.js and filetype.min.js are necessary in the order listed for advanced mime type parsing and more correct
     preview. This is a feature available since v5.5.0 and is needed if you want to ensure file mime type is parsed 
     correctly even if the local file's extension is named incorrectly. This will ensure more correct preview of the
     selected file (note: this will involve a small processing overhead in scanning of file contents locally). If you 
     do not load these scripts then the mime type parsing will largely be derived using the extension in the filename
     and some basic file content parsing signatures. -->
    <script src="../../resources/vendor/input-file/js/plugins/buffer.min.js" type="text/javascript"></script>
    <script src="../../resources/vendor/input-file/js/plugins/filetype.min.js" type="text/javascript"></script>

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="../../resources/vendor/input-file/js/plugins/piexif.min.js" type="text/javascript"></script>

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
    <script src="../../resources/vendor/input-file/js/plugins/sortable.min.js" type="text/javascript"></script>

    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="../../resources/vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- the main fileinput plugin script JS file -->
    <script src="../../resources/vendor/input-file/js/fileinput.min.js"></script>

    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
    <script src="../../resources/vendor/input-file/themes/fa5/theme.min.js"></script>

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="../../resources/vendor/input-file/js/locales/fr.js"></script>

</body>

</html>