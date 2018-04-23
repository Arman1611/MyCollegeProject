<?php
   session_start();
    if(isset($_SESSION['email'])){
?>
<div class='bg'><?php
 include("header.php");
 include("3_one.php");

$result=false;
 if(isset($_POST['submit']))
 {
     $sql="insert into attendence_system(student_name,roll_number,branch,year) values('$_POST[name]','$_POST[roll]'
     ,'$_POST[branch]','$_POST[year]')";
     $result=mysqli_query($con, $sql);

 }
?>

<div class="container">
 <div class="panel panel-default">
     <?php if($result)  {?>

          <div class="alert alert-success">Attendence data is <strong>successfully</strong> inserted!!</div>
       <?php }?>
     <div class="panel-heading">
         <a href="view.php" class="btn btn-success">View Student</a>
         <a href="index.php" class="btn btn-info pull-right">Home</a>
     </div>

     <div class="panel-body">
         <form action="add.php" method="post">
             <div class="form-group" >
                 <label for="name">Student Name</label>
                 <input type="text" name="name" id="name" class="form-control" required>
             </div>

             <div class="form-group">
                 <label for="roll">Roll Number</label>
                 <input type="text" name="roll" id="roll" class="form-control" required>
             </div>
             <div class="form-group">
                 <label for="branch">Branch</label>
                 <input type="text" name="branch" id="branch" class="form-control" required>
             </div>
             <div class="form-group">
                 <label for="year">Year</label>
                 <input type="text" name="year" id="year" class="form-control" required>
             </div>
             <div class="form-group">
                 <input type="submit" name="submit" value="submit" class="btn btn-primary" required>
             </div>
         </form>
     </div>
 </div>
</div>
</div>



<style>
            body, html {
                height: 100%;
                margin: 0;
          }

        .bg {
         background-image: url("images/repose.jpg");
         height: 100%;

         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
        }
</style>
<?php
    }
else
{
    echo'<script>
    alert("You are not logged in!");</script>';
    echo"<script>
    location.href='loginIndex.php';
</script>";
}
?>
