<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Abhoer - Login</title>

    <!-- Custom fonts for this template-->
    <link href="./resources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./resources/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary vh-100">

    <div class="container h-100">

        <!-- Outer Row -->
        <div class="row h-100 justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Récupérer mot de passe</h1>
                                    </div>
                                    <form action="./helpers/recover_pass_mail.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"  placeholder="Nom utilisateur..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="mail" name="mail" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="E-mail..." required>
                                        </div>
                                        <input type="submit" name="reset" value="Reset password" class="btn btn-primary btn-user btn-block">
                                        <hr>
                                    </form>
                                      <div class="text-center">
                                        <a href="index.php"  >Login </a>
                                    </div>
                                    <div class="text-center">
                                        <p>Agence du Bassin Hydraulique<br>De l'Oum Er Rbia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./resources/vendor/jquery/jquery.min.js"></script>
    <script src="./resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./resources/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./resources/js/sb-admin-2.js"></script>

</body>

</html>