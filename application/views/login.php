<?php
session_start();
include 'koneksi.php'; // Panggil koneksi

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lindungi dari SQL Injection dengan prepared statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password); // dua string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username; // Simpan username ke session
        header("Location: dashboard.php");
        exit();
    } else {
        // Login gagal
        echo "<script>alert('Username atau Password salah!'); window.location='index.php';</script>";
    }
}
?>