<?php
session_start();
include('koneksi.php');

$id = htmlspecialchars($_GET['id']);
$select = $con->prepare("SELECT * FROM mahasiswa WHERE id=?");
$select->bind_param("i", $id);
$select->execute();
$data = $select->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $npm = htmlspecialchars($_POST['npm']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $id = htmlspecialchars($_POST['id']);

    $query = $con->prepare("UPDATE mahasiswa SET nama=?,npm=?,jurusan=? WHERE id=?");
    $query->bind_param("sssi", $nama, $npm, $jurusan, $id);
    $query->execute();

    if ($query->affected_rows > 0) {
        $query->close();
        $con->close();
        $_SESSION['edit'] = 'yes';
        header('location: index.php');
    } else {
        $query->close();
        $con->close();
        $_SESSION['edit'] = 'yes';
        header('location: index.php');
    }
}
?>

<?php include('layout/header.php'); ?>

<h1>Edit Data Mahasiswa</h1>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <input name="id" type="hidden" value="<?= $data['id']; ?>">
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama" value="<?= $data['nama']; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">NPM</label>
        <input name="npm" type="text" class="form-control" placeholder="Masukkan NPM" value="<?= $data['npm']; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Jurusan</label>
        <input name="jurusan" type="text" class="form-control" placeholder="Masukkan Jurusan" value="<?= $data['jurusan']; ?>">
    </div>

    <button class="btn btn-primary" type="submit">Ubah</button>
</form>

<?php include('layout/footer.php'); ?>