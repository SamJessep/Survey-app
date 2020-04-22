<h1>Download survey results</h1>

 <script>
const USERNAME = 'admin';
const SECRETPASSWORD = '12345';
 function login(){
   var username = prompt("Please enter your username:", "");
   var password = prompt("Please enter your password:", "");
   if(username == USERNAME && password == SECRETPASSWORD){
     alert("logged in!");
     window.location = "/admin/download.php";
   }else{
     alert("invalid login");
     login();
   }
 }
 login();
 </script>
