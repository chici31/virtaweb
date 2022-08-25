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
            <!-- <form action="cek_login.php" method="POST"> -->
                <input type="text" name="username" placeholder="Username" class="input-control" required="required" id="username">
                <input type="password" name="password" placeholder="Password" class="input-control" required="required" id="password">
                <!-- <input type="submit" name="submit" value="Login" class="btn" id="submit"> -->
                <button onclick="login()" class="btn">Login</button>
                <!--<h5>-->
                <!--    Belum punya akun?-->
                <!--    <a href="register.php">Buat</a>-->
                <!--</h5>-->
            <!-- </form> -->
            
        </div>

</body>


<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDd58g_ssB7662eu4-t6aknkVCOntfDm0Q",
    authDomain: "virta-apps.firebaseapp.com",
    databaseURL: "https://virta-apps-default-rtdb.firebaseio.com",
    projectId: "virta-apps",
    storageBucket: "virta-apps.appspot.com",
    messagingSenderId: "144623965772"
  };
  firebase.initializeApp(config);
</script>

<script src="index.js"></script>
<script type="text/javascript">
    function login(){

      var userEmail = document.getElementById("username").value;
      var userPass = document.getElementById("password").value;

      firebase.auth().signInWithEmailAndPassword(userEmail, userPass).then(function(user) {
        var user = firebase.auth().currentUser;
        var uid = user.uid;
        var email = user.email;

        window.location.href="cek_login.php?uid="+uid+"&email="+email;

        // console.log(uid);
        // httpPost("cek_login.php", {uid:uid, email:email});
        // window.location.href = "index.php";
      }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;

        window.alert("Error : " + errorMessage);

        // ...

      });

      

    }
</script>

</html>