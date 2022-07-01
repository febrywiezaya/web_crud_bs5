<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $npm = htmlspecialchars($_POST['npm']);
    $jurusan = htmlspecialchars($_POST['jurusan']);

    $query = $con->prepare("INSERT INTO mahasiswa (nama,npm,jurusan) VALUES (?,?,?)");
    $query->bind_param("sss", $nama, $npm, $jurusan);
    $query->execute();

    if ($query->affected_rows > 0) {
        $query->close();
        $con->close();
        $_SESSION['tambah'] = 'yes';
        header('location: index.php');
    } else {
        $query->close();
        $con->close();
        $_SESSION['tambah'] = 'no';
        header('location: index.php');
    }
}
?>

<?php include('layout/header.php'); ?>

<h1>Tambah Data Mahasiswa</h1>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama">
    </div>
    <div class="mb-3">
        <label class="form-label">NPM</label>
        <input name="npm" type="text" class="form-control" placeholder="Masukkan NPM">
    </div>
    <div class="mb-3">
        <label class="form-label">Jurusan</label>
        <input name="jurusan" type="text" class="form-control" placeholder="Masukkan Jurusan">
    </div>

    <button class="btn btn-primary" type="submit">Simpan</button>
</form>

<?php include('layout/footer.php'); ?>