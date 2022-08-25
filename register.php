<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">
</head>

<body id="bg-login">

    <?php
    if(isset($_GET['pesan'])){
     if($_GET['pesan']=="gagal"){
      echo "<div class='alert'>Username dan Password Salah !</div>";
     }
    }
    ?>

        <div class="box-login">
            <h2>Register</h2>
            <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama" class="input-control" required="required">
                <input type="text" name="username" placeholder="Username" class="input-control" required="required">
                <input type="password" name="password" placeholder="Password" class="input-control" required="required">
                <input type="submit" name="submit" value="Register" class="btn">
                <h5>
                    Sudah punya akun?
                    <a href="login.php">Login</a>
                </h5>
            </form>
            <?php
            if(isset($_POST['submit'])) {
                session_start();
                include 'koneksi.php';
                $nama = mysqli_real_escape_string($conn, $_POST['nama']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                $level = 'user';
                $cek = mysqli_query($conn, "INSERT INTO tb_user (nama, username, password, level) VALUES ('$nama','$username','$password','$level')");
                if($cek){
                    echo '<script>window.location="login.php"</script>';
                }else{
                    echo '<script>alert("Periksa kembali username dan password Anda!")</script>';

                }
            }
             ?>
        </div>
</body>

</html>