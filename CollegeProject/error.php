<?php
if(isset($_POST['Submit']))
{
 session_start();
 include("3_one.php");
$user=$_POST['email'];
$pass=$_POST['pass'];
$logi=mysqli_query($con,"select * from login_table where User_Id='$user'");
$logres=mysqli_fetch_array($logi);
if($logi!=null && $logres['Password']==$pass){
    $_SESSION['email']=$user;
    header("location:index.php");
}
else
{
?>
<script>
    alert("Login details are not correct!");
    location.href='loginIndex.php';
</script>

<?php
}
}
?>
