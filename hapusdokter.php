<?php

require 'fungsi.php';

$id = $_GET["id"];

if (hapusdokter($id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus');
                document.location.href = 'tabdokter.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Di Hapus');
                document.location.href = 'tabdokter.php';
            </script>
        ";
}
