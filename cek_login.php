<?php
    ini_set("display_errors",0);                            
    include('admin/koneksi.php');

    if(isset($_POST['go'])){
	
    $username = mysql_real_escape_string(htmlentities($_POST['username']));
    $password = mysql_real_escape_string(htmlentities($_POST['password']));
                                 
    $sql = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password' ") 
	or die(mysql_error());

    if(mysql_num_rows($sql) == 0){
	echo "<script>alert('Username / Password salah!')</script>";
    echo '<script type="text/javascript">window.location="index.html"</script>';

   }else{
		
	session_start();

    $row = mysql_fetch_assoc($sql);
	
    $_SESSION['id_login']	= $row['id_login'];
    $_SESSION['level']      = $row['level'];
                                    
    if($row['level'] == 'Admin'){
    echo "<script>alert('Success')</script>";
    echo '<script type="text/javascript">window.location="admin/index.php"</script>';
    }
	elseif($row['level'] == 'Dosen'){
    echo "<script>alert('Success')</script>";
    echo '<script type="text/javascript">window.location="dosen/index.php"</script>';
                                     
    }
    else{
    header('location:index.html');
    }
}
}
?>