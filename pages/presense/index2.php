<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("location: ../403.html");
    die;
}
?>
<?php include("../includes/header.php") ?>
<?php include("../includes/sidebar.php") ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include("../includes/navbar.php") ?>

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

                                        $query = "SELECT h.*, sr.CIN, sr.NOM, sr.PRENOM
                                        FROM hr_presence AS h 
                                        LEFT JOIN stage AS st ON h.ID_PRESENSE = st.ID_PRESENSE 
                                        LEFT JOIN stagiaire AS sr ON sr.ID_STAGIAIRE = st.ID_STAGIAIRE";

                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $presense) {
                                        ?>
                                                <tr class="align-middle">
                                                    <td><?= date("d-m-y", strtotime($presense["DATE"])) ?></td>
                                                    <td><?= $presense["NOM"] ?> <?= $presense["PRENOM"] ?></td>
                                                    <td><?= $presense["CIN"] ?></td>
                                                    <td><?= date("H:i", strtotime($presense["HR_ENTRE_M"])) ?></td>
                                                    <td><?= date("H:i", strtotime($presense["HR_SORTIE_M"])) ?></td>
                                                    <td><?= date("H:i", strtotime($presense["HR_ENTRE_A"])) ?></td>
                                                    <td><?= date("H:i", strtotime($presense["HR_SORTIE_A"])) ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
    <!-- Page Wrapper -->


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

    <?php include("../includes/scripts.php") ?>

    <!-- Page level plugins -->
    <script src="../../resources/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resources/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>