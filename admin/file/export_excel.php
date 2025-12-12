<?php
include '../../config/koneksi.php';

// Query data
$q = mysqli_query($conn, "
    SELECT 
        bulan,
        COALESCE(masuk, 0) AS masuk,
        COALESCE(keluar, 0) AS keluar
    FROM (
        SELECT MONTH(tanggal) AS bulan, SUM(jumlah) AS masuk
        FROM barang_masuk
        GROUP BY MONTH(tanggal)
    ) bm
    LEFT JOIN (
        SELECT MONTH(tanggal) AS bulan, SUM(jumlah) AS keluar
        FROM barang_keluar
        GROUP BY MONTH(tanggal)
    ) bk USING (bulan)
    ORDER BY bulan
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