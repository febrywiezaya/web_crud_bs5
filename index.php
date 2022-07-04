<?php
session_start();
include('koneksi.php');

$sql = $con->query("SELECT * FROM mahasiswa");
$datas = $sql->fetch_all(MYSQLI_ASSOC);

// Pengkondisian Tambah
if (isset($_SESSION['tambah']) && $_SESSION['tambah'] == "yes") {
    echo "<script>alert('Tambah Data Mahasiswa Berhasil!')</script>";
} elseif (isset($_SESSION['tambah']) && $_SESSION['tambah'] == "no") {
    echo "<script>alert('Tambah Data Mahasiswa Gagal!')</script>";
}
// Pengkondisian Tambah
// Pengkondisian Edit
if (isset($_SESSION['edit']) && $_SESSION['edit'] == "yes") {
    echo "<script>alert('Edit Data Mahasiswa Berhasil!')</script>";
} elseif (isset($_SESSION['edit']) && $_SESSION['edit'] == "no") {
    echo "<script>alert('Edit Data Mahasiswa Gagal!')</script>";
}
// Pengkondisian Edit
// Pengkondisian Hapus
if (isset($_SESSION['hapus']) && $_SESSION['hapus'] == "yes") {
    echo "<script>alert('Hapus Data Mahasiswa Berhasil!')</script>";
} elseif (isset($_SESSION['hapus']) && $_SESSION['hapus'] == "no") {
    echo "<script>alert('Hapus Data Mahasiswa Gagal!')</script>";
}
// Pengkondisian Hapus


session_destroy();
$con->close();
?>

<?php include('layout/header.php'); ?>

<h1>Tabel Mahasiswa</h1>

<a class="btn btn-primary" href="tambah.php">Tambah Data</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Jurusan</th>
            <th>Tombol Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($datas as $data) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['npm']; ?></td>
                <td><?= $data['jurusan']; ?></td>
                <td>
                    <a class="btn btn-warning" href="edit.php?id=<?= $data['id']; ?>">EDIT</a>
                    <a class="btn btn-danger" onclick="confirm('Yakin hapus data ini?')" href="hapus.php?id=<?= $data['id']; ?>">HAPUS</a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<?php include('layout/footer.php'); ?>