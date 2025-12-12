<?php
include '../../config/koneksi.php';

$file = fopen("laporan.txt", "w");
fwrite($file, "=== LAPORAN BARANG MASUK & KELUAR ===\n\n");

for ($i = 1; $i <= 12; $i++) {
    $masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) total FROM barang_masuk WHERE MONTH(tanggal)=$i"))['total'] ?? 0;
    $keluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) total FROM barang_keluar WHERE MONTH(tanggal)=$i"))['total'] ?? 0;

    fwrite($file, "Bulan: $i | Masuk: $masuk | Keluar: $keluar\n");
}

fclose($file);

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=laporan.txt");
readfile("laporan.txt");
unlink("laporan.txt");
exit;
?>