<?php
session_start();
include('koneksi.php');


if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['cari']) && $_GET['cari'] != null) {
    // $cari = "%" . htmlspecialchars($_GET['cari']) . "%"; WITHOUT CONCAT USE THIS.
    $cari = htmlspecialchars($_GET['cari']);

    $sql = $con->prepare("SELECT * FROM mahasiswa WHERE nama LIKE CONCAT('%',?,'%') OR npm LIKE CONCAT('%',?,'%') OR jurusan LIKE CONCAT('%',?,'%')");
    $sql->bind_param("sss", $cari, $cari, $cari);
    $sql->execute();
    $datas = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $sql = $con->query("SELECT * FROM mahasiswa");
    $datas = $sql->fetch_all(MYSQLI_ASSOC);
}

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

<div class="row">
    <div class="col-6">
        <a class="btn btn-primary" href="tambah.php">Tambah Data</a>
    </div>

    <div class="col-6">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
            <div class="input-group mb-3">
                <input name="cari" type="text" class="form-control" placeholder="Masukkan pencarian..">
                <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Jurusan</th>
            <th>Tombol Opsi</th>
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