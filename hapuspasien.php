<?php

require 'fungsi.php';

$id = $_GET["id"];

if (hapuspasien($id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus');
                document.location.href = 'admin.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Di Hapus');
                document.location.href = 'admin.php';
            </script>
        ";
}
