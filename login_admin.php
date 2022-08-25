<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">
</head>

<body id="bg-login">

    <?php
    if(isset($_GET['pesan'])){
     if($_GET['pesan']=="gagal"){
    //   echo "<div class='alert'>Username dan Password Salah !</div>";
      echo "<script>alert('Username dan Password Salah !')</script>";
     }
    }
    ?>

        <div class="box-login">
            <h2>Login</h2>
            <form action="cek_login_admin.php" method="POST">
                <input type="text" name="username" placeholder="Username" class="input-control" required="required" id="username">
                <input type="password" name="password" placeholder="Password" class="input-control" required="required" id="password">
                <input type="submit" name="submit" value="Login" class="btn" id="submit">
                <h5>
                    Belum punya akun?
                    <a href="register.php">Buat</a>
                </h5>
            </form>
            
        </div>

</body>


</html>