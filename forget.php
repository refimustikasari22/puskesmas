<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['submit_email'])) {

    include  'fungsi.php';
    $email = $_POST['email'];

    $inEmail = mysqli_query($conn, "SELECT email,password FROM user WHERE  email='$email'");
    if (mysqli_num_rows($inEmail) == 1) {
        while ($row = mysqli_fetch_array($inEmail)) {
            $email = $row['email'];
            $pass = md5($row['password']);
        }
        //$link="<a href='localhost:8080/phpmailer/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
        require_once('phpmail/class.phpmailer.php');
        require_once('phpmail/class.smtp.php');
        require 'vendor/autoload.php';
        $mail = new PHPMailer();

        $body      = "Klik link berikut untuk reset Password, <a href='http://localhost:80/patikraja/reset_pass.php?reset=$pass&key=$email'>$pass<a>"; //isi dari email

        // $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth = true;
        // GMAIL username
        $mail->Username = "refimustikasari22@gmail.com";
        // GMAIL password
        $mail->Password = "zhbqiutenuwhauyg";
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From = 'refimustikasari22@gmail.com';
        $mail->FromName = 'Admin Puskesmas Patikraja';

        $email = $_POST['email'];

        $mail->AddAddress($email, 'User Sistem');
        $mail->Subject  =  'Reset Password';
        $mail->IsHTML(true);
        $mail->MsgHTML($body);
        if ($mail->Send()) {
            echo "<script> alert('Link reset password telah dikirim ke email anda, Cek email untuk melakukan reset'); window.location = 'login.php'; </script>"; //jika pesan terkirim

        } else {
            echo "Mail Error - >" . $mail->ErrorInfo;
        }
    } else {
        echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'login.php'; </script>"; //jika pesan terkirim

    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center" style="padding-top: 50px;">
        <div class="card text-center" style="width: 18rem;">
            <img src="images/password.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Masukan Email Yang Sudah Terdaftar</h5>
                <form action='' method='post'>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary" name='submit_email'>Kirim</button>
                    <a href="login.php" id="cf-submit" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>