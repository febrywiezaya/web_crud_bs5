<?php
session_start();
include('koneksi.php');

$id = htmlspecialchars($_GET['id']);
$query = $con->prepare("DELETE FROM mahasiswa WHERE id=?");
$query->bind_param("i", $id);
$query->execute();


if ($query->affected_rows > 0) {
    $query->close();
    $con->close();
    $_SESSION['hapus'] = 'yes';
    header('location: index.php');
} else {
    $query->close();
    $con->close();
    $_SESSION['hapus'] = 'yes';
    header('location: index.php');
}
