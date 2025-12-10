<?php
include '../../config/koneksi.php';
$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM kategori WHERE id=$id");
header('Location: index.php');