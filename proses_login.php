<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);
    $data=mysqli_fetch_array($result);
    // $data=$result->fetch_assoc();
    if ($result->num_rows == 1) {
        $_SESSION['login'] = TRUE;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];
        $_SESSION['user_id']=$data['id'];
        // Login berhasil, arahkan ke halaman lain
        header("Location: index.php");
        exit;
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
}
