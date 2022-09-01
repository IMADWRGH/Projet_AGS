<?php
session_start();
require("./condb.php");
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pwd = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($username)) {
        header("location: ../index.php?error=Username is required");
    } elseif (empty($username)) {
        header("location: ../index.php?error=Password is required");
    }

    $query = "SELECT * FROM utilisateur WHERE USERNAME = '$username' AND PWD = '$pwd'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if ($row["ROLE"] == "admin") {
            $_SESSION['role'] = $row['ROLE'];
            $_SESSION['username'] = $row['USERNAME'];
            header("location: ../pages/admin");
            die;
        } elseif ($row["ROLE"] == "presense") {
            $_SESSION['role'] = $row['ROLE'];
            $_SESSION['username'] = $row['USERNAME'];
            header("location: ../pages/presense");
            die;
        }else{
            $_SESSION['role'] = $row['ROLE'];
            $_SESSION['username'] = $row['USERNAME'];
            header("location: ../pages/secretaire");
            die;
        }
    } else {
        header("location: ../index.php?error=Incorrect username or password");
        die;
    }
}
