<?php
$con = new mysqli('localhost', 'root', '', 'latihan');
if ($con->connect_error) echo "Koneksi gagal! " . $con->connect_error;
