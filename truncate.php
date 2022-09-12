<?php
//specify the server name
$server_name = "localhost";

//specify the username
$user_name = "root";

//specify the password - it is empty
$password = "";

//specify the database name
$database_name = "patikraja";

// Creating the connection by specifying the connection details
$connection = mysqli_connect($server_name, $user_name, $password, $database_name);

//delete all records
$query = "TRUNCATE table antrian";


if (mysqli_multi_query($connection, $query)) {
    echo "<script>
            alert('Tabel Antrian Di Kosongkan');
        </script>";
    header("location:tabantrian.php");
} else {
    echo "Error:" . mysqli_error($connection);
}

//close the connection
mysqli_close($connection);
