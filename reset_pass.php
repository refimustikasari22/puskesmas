<?php
if (isset($_POST['submit_password'])) {
  include('fungsi.php');
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $inEmail = mysqli_query($conn, "UPDATE user SET password='$pass' WHERE email='$email'") or die($mysqli->error());
  if ($inEmail) {
    echo "<script> alert('Reset password berhasil'); window.location = 'login.php'; </script>"; //jika pesan terkirim

  } else {
    echo "<script>alert('Gagal Menyimpan '); window.location = 'login.php';</script>";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex justify-content-center" style="padding-top: 50px;">
    <div class="card" style="width: 18rem;">
      <img src="images/password.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title text-center">Reset Password</h5>
        <?php
        if ($_GET['key'] && $_GET['reset']) {
          include('fungsi.php');
          $email = $_GET['key'];
          $pass = $_GET['reset'];
          $inEmail = mysqli_query($conn, "SELECT email,password FROM user WHERE  email='$email' AND md5(password)='$pass'");
          if (mysqli_num_rows($inEmail) == 1) {
        ?>
            <form action='' method='post'>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" onkeyup='check();'>
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="pass" value="<?php echo $pass; ?>">
              </div>
              <div class="mb-3">
                <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmasi" class="form-control" id="confirm_password" onkeyup='check();'>
              </div>
              <button type="submit" class="btn btn-primary" name='submit_password'>Kirim</button>
              <a href="login.php" id="cf-submit" class="btn btn-danger">Kembali</a>
            </form>
        <?php
          } else {
            echo "Data Tidak Ditemukan";
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var check = function() {
      if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Password dan Konfirmasi Sama';
      } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password dan Konfirmasi Tidak Sama';
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>