<?php
// koneksi database
$conn = mysqli_connect("localhost", "root", "", "patikraja");
// mengambil data balita
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function reg($data)
{
    global $conn;
    $level = htmlspecialchars($data["level"]);
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = htmlspecialchars($data["jk"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $agama = htmlspecialchars($data["agama"]);
    $jawab = htmlspecialchars($data["jawab"]);
    $kawin = htmlspecialchars($data["kawin"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $pembayaran = htmlspecialchars($data["pembayaran"]);
    $hp = htmlspecialchars($data["hp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $diagnosa = htmlspecialchars($data["diagnosa"]);
    $resep = htmlspecialchars($data["resep"]);

    //cek username sudah ada atau belom
    $result = mysqli_query($conn, "SELECT nik FROM user WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('NIK Sudah ada');
            </script>";
        return false;
    }


    // tamabah user ke database
    mysqli_query($conn, "INSERT INTO user VALUES (null,'$level','$nik','$nama','$email','$jk','$ttl','$password','$agama','$jawab','$kawin','$pekerjaan','$pembayaran','$hp','$alamat','$diagnosa','$resep','')");

    return mysqli_affected_rows($conn);
}
function reguser($data)
{
    global $conn;
    $level = htmlspecialchars($data["level"]);
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = htmlspecialchars($data["jk"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $agama = htmlspecialchars($data["agama"]);
    $hp = htmlspecialchars($data["hp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    //cek username sudah ada atau belom
    $result = mysqli_query($conn, "SELECT nik FROM user WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('NIK Sudah ada');
            </script>";
        return false;
    }


    // tamabah user ke database
    mysqli_query($conn, "INSERT INTO user VALUES (null,'$level','$nik','$nama','$email','$jk','$ttl','$password','$agama','','','','','$hp','$alamat','','','')");

    return mysqli_affected_rows($conn);
}
function ambilantri($data)
{
    global $conn;
    $nama  = htmlspecialchars($data['nama']);
    $nik  = htmlspecialchars($data['nik']);
    $poli  = htmlspecialchars($data['poli']);
    $tanggal_antrian  = htmlspecialchars($data['tanggal_antrian']);


    $sql = "SELECT max(right(antrian, 4)) AS kode_antrian FROM antrian WHERE poli = '$poli'";
    $q = $conn->query($sql);

    if ($q->num_rows > 0) {
        foreach ($q as $qq) {
            $no = ((int)$qq['kode_antrian']) + 1;
            $kd = sprintf("%04s", $no);
        }
    } else {
        $kd = "0001";
    }

    $kode = $poli . $kd;
    $query = "INSERT INTO antrian VALUES (null,'$nama','$nik','$poli','$tanggal_antrian','$kode')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function dokter($data)
{
    global $conn;
    $poli  = htmlspecialchars($data['poli']);
    $nama  = htmlspecialchars($data['nama']);
    $jadwal  = htmlspecialchars($data['jadwal']);
    $kode  = htmlspecialchars($data['kode']);

    $query = "INSERT INTO dokter VALUES (null,'$poli','$nama','$jadwal','$kode')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapuspasien($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapusdokter($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM dokter WHERE id = $id");
    return mysqli_affected_rows($conn);
}
function hapusantri($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM antrian WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubahpasien($data)
{
    global $conn;
    $id = $data["id"];
    $level = htmlspecialchars($data["level"]);
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = htmlspecialchars($data["jk"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $agama = htmlspecialchars($data["agama"]);
    $jawab = htmlspecialchars($data["jawab"]);
    $kawin = htmlspecialchars($data["kawin"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $pembayaran = htmlspecialchars($data["pembayaran"]);
    $hp = htmlspecialchars($data["hp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $diagnosa = htmlspecialchars($data["diagnosa"]);
    $resep = htmlspecialchars($data["resep"]);



    $query = "UPDATE user SET level='$level',nik='$nik',nama='$nama',email='$email',jk='$jk',ttl='$ttl',password='$password',agama='$agama',jawab='$jawab',kawin='$kawin',pekerjaan='$pekerjaan',pembayaran='$pembayaran',hp='$hp',alamat='$alamat',diagnosa='$diagnosa',resep='$resep' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahdiagnosa($data)
{
    global $conn;
    $id = $data["id"];
    $diagnosa = htmlspecialchars($data["diagnosa"]);


    $query = "UPDATE user SET diagnosa='$diagnosa' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahresep($data)
{
    global $conn;
    $id = $data["id"];
    $resep = htmlspecialchars($data["resep"]);
    $status = htmlspecialchars($data["status"]);

    $query = "UPDATE user SET resep='$resep',status='$status' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahdokter($data)
{
    global $conn;
    $id = $data["id"];
    $poli = htmlspecialchars($data["poli"]);
    $nama = htmlspecialchars($data["nama"]);
    $jadwal = htmlspecialchars($data["jadwal"]);
    $kode = htmlspecialchars($data["kode"]);

    $query = "UPDATE dokter SET poli='$poli',nama='$nama',jadwal='$jadwal' ,kode='$kode' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $level = htmlspecialchars($data["level"]);
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = htmlspecialchars($data["jk"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $password = htmlspecialchars($data["password"]);
    $agama = htmlspecialchars($data["agama"]);
    $jawab = htmlspecialchars($data["jawab"]);
    $kawin = htmlspecialchars($data["kawin"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $pembayaran = htmlspecialchars($data["pembayaran"]);
    $hp = htmlspecialchars($data["hp"]);
    $alamat = htmlspecialchars($data["alamat"]);



    $query = "UPDATE user SET level = '$level',nik = '$nik',nama = '$nama',email = '$email',jk = '$jk',ttl = '$ttl',password = '$password',agama = '$agama',jawab = '$jawab',kawin = '$kawin',pekerjaan = '$pekerjaan',pembayaran = '$pembayaran',hp = '$hp',alamat = '$alamat' WHERE id =  $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahuser($data)
{
    global $conn;
    $id = $data["id"];
    $level = htmlspecialchars($data["level"]);
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = htmlspecialchars($data["jk"]);
    $ttl = htmlspecialchars($data["ttl"]);
    $password = htmlspecialchars($data["password"]);
    $agama = htmlspecialchars($data["agama"]);
    $hp = htmlspecialchars($data["hp"]);
    $alamat = htmlspecialchars($data["alamat"]);



    $query = "UPDATE user SET level = '$level',nik = '$nik',nama = '$nama',email = '$email',jk = '$jk',ttl = '$ttl',password = '$password',agama = '$agama',hp = '$hp',alamat = '$alamat' WHERE id =  $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}