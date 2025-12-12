<?php
include '../../config/koneksi.php';
include '../sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $telp = mysqli_real_escape_string($conn, $_POST['no_telepon']);
    $email = $_POST['email'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Email Tidak Valid',
            text: 'Email harus mengandung @ dan format yang benar!'
        });
        </script>";
    } else {
        $email = mysqli_real_escape_string($conn, $email);

        $insert = mysqli_query(
            $conn,
            "INSERT INTO supplier (nama_supplier, no_telepon, email)
             VALUES ('$nama', '$telp', '$email')"
        );

        if ($insert) {
            echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Supplier berhasil ditambahkan!',
            }).then(() => {
                window.location='supplier.php';
            });
            </script>";
        } else {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menambahkan supplier!'
            });
            </script>";
        }
    }
}
?>



<div>
    <h1 class="text-2xl font-semibold">Tambah Supplier</h1>
    <form action="" method="post" class="mt-4 bg-white p-4 rounded shadow max-w-lg">

        <label class="block">Nama Supplier</label>
        <input type="text" name="nama_supplier" class="border p-2 w-full mt-2" required>

        <label class="block mt-4">No Telepon</label>
        <input type="text" name="no_telepon" class="border p-2 w-full mt-2" required>

        <label class="block mt-4">Email</label>
        <input type="email" name="email" class="border p-2 w-full mt-2" required>

        <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </form>
</div>

</div>
</div>