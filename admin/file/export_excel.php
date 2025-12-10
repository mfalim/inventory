<?php
include '../config/koneksi.php';

// Query data
$q = mysqli_query($conn, "
    SELECT 
        MONTH(tanggal) bulan,
        (SELECT SUM(jumlah) FROM barang_masuk WHERE MONTH(tanggal)=MONTH(bm.tanggal)) masuk,
        (SELECT SUM(jumlah) FROM barang_keluar WHERE MONTH(tanggal)=MONTH(bm.tanggal)) keluar
    FROM barang_masuk bm GROUP BY MONTH(bm.tanggal)
");

$filename = "laporan_barang.xls";
$file = fopen($filename, "w");

// write header
fwrite($file, "Bulan\tBarang Masuk\tBarang Keluar\n");

// write data
while ($d = mysqli_fetch_assoc($q)) {
    fwrite($file, $d['bulan'] . "\t" . $d['masuk'] . "\t" . $d['keluar'] . "\n");
}

fclose($file);

// download file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
readfile($filename);
unlink($filename); // optional: hapus setelah download
exit;
?>