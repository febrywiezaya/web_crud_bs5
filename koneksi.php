<?php
$con = new mysqli('localhost', 'root', '', 'web');
if ($con->connect_error) echo "Koneksi gagal! " . $con->connect_error;
