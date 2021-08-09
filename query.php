<?php
ob_start();
session_start();
error_reporting(0);
include('../../system/database.php');

$username = $_POST['username'];
$password = $_POST['password'];

$md5pass = md5($password);

if ($_POST) {
    if (($username == '') or ($password == '')) {
        echo 'Lütfen boşluk bırakmayınız.';
        header('location:../');
    } elseif (($username != '') and ($password != '')) {
        $_SESSION['user'] = $username;
        $sql = "Select * from admins where username='$username' and password='$md5pass'";
        $user_query = mysqli_query($con, $sql);
        $query = mysqli_fetch_array($user_query, mysql_assoc);
        if (mysqli_num_rows($user_query) == 1) {

            header('location: ../../');
        } else {
            echo 'giriş başarısız';
        }
    } else {
        echo 'yanlış bişeyler var';
        header('location: ../');
        session_destroy();
    }
} else {
    echo 'yanlış bişeyler var';
    header('location: ../');
    session_destroy();
}
