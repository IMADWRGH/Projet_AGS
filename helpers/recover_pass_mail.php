 <?php
session_start();
include_once "./condb.php";
if(isset($_POST["reset"])){
    $mail=$_POST["mail"];
    $username=$_POST["username"];
    $query="SELECT * FROM UTILISATEUR WHERE email='$mail' and username='$username'";
    $result = mysqli_query($con, $query);
    $count=mysqli_num_rows($result);
    if($count==0){
    
        header("location: ../forget_password.php?error=Incorrect E-mail");
        die;
    }else{
       
         header("location: ../Recovre_password.php");
            die;
    }
} 
 