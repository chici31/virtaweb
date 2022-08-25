firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.

    // document.getElementById("user_div").style.display = "block";
    // document.getElementById("login_div").style.display = "none";

    var user = firebase.auth().currentUser;

    if(user != null){

      var uid = user.uid;
      var email = user.email;
      // document.getElementById("user_para").innerHTML = "Welcome User : " + email_id;
      console.log(uid);

    }

  } else {
    // No user is signed in.   
    var uid = null;
    console.log(uid);

    // document.getElementById("user_div").style.display = "none";
    // document.getElementById("login_div").style.display = "block";

  }
});



function logout(){
  firebase.auth().signOut();
  window.location.href = "logout.php";
}