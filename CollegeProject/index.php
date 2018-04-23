<?php 
   session_start();
    if(isset($_SESSION['email'])){
?>
  <div class="bg"><?php 
   include("3_one.php"); 
   include("header.php");
   $result1=false;
   $result2=false;
   $date=date("y-m-d");
   if(isset($_POST['submit']))
   {
       $records=mysqli_query($con,"select * from present_record where date='$date'");
       $num=mysqli_num_rows($records);
       if($num)
       {
          foreach($_POST['status'] as $id=>$status)
          {
           $student= $_POST['student_name'][$id];
           $roll=$_POST['roll_number'][$id];
           $branch=$_POST['branch'][$id];
           $year=$_POST['year'][$id];
           $result2= mysqli_query($con,"update present_record set attend_status='$status' where date='$date' AND roll_number='$roll'");   
          }
       }
       else
       {
       foreach($_POST['status'] as $id=>$status)
       {  
           $student= $_POST['student_name'][$id];
           $roll=$_POST['roll_number'][$id];
           $branch=$_POST['branch'][$id];
           $year=$_POST['year'][$id];
           $result1= mysqli_query($con,"insert into present_record(roll_number,student_name,branch,year,attend_status,date)values('$roll',
           '$student','$branch','$year','$status','$date')");
       }
       }
   }
 ?>
 <div class="container">
    
     <div class="panel panel-default">
         <div class="panel-heading">
             <a class="btn btn-success" href="add.php">Add Student</a>
             <a class="btn btn-info pull-right" href="view.php">View Student</a>
         </div>
         <?php 
         if($result1){
         ?>
         <div class="alert alert-success">Attendence is <strong>successfully</strong> submitted!!</div>
         <?php }?>
         <?php 
         if($result2){
         ?>
         <div class="alert alert-success">Attendence is <strong>successfully</strong> updated!!</div>
         <?php }?>
         <h3 class="text-center well">DATE : <?php echo date("d-m-y")?></h3> 
         <div class="panel panel-body">
             <form action="index.php" method="post">
                 <table class="table table-striped">
                     <tr>
                       <th>ROLL NUMBER</th>
                       <th>STUDENT NAME</th>
                       <th>BRANCH</th>
                       <th>YEAR</th> 
                       <th>Attendence Status</th>
                    </tr>
                 
              <?php $result=mysqli_query($con,"select * from attendence_system");
                 $count=0;
                 while($row=mysqli_fetch_array($result))
                 {
              ?>
                <tr>
                    <td><?php echo $row['roll_number'];?></td>
                    <td><?php echo $row['student_name'];?></td>
                    <td><?php echo $row['branch'];?></td>
                    <td><?php echo $row['year'];?></td>
                    <input type="hidden" value="<?php echo $row['roll_number'];?>" name="roll_number[]">
                    <input type="hidden" value="<?php echo $row['student_name'];?>" name="student_name[]">
                    <input type="hidden" value="<?php echo $row['branch'];?>" name="branch[]">
                    <input type="hidden" value="<?php echo $row['year'];?>" name="year[]">
                    <td>
                       
                        <input type="radio" name="status[<?php echo $count;?>]" value=1
                        <?php
                        if(isset($_POST['status'][$count])&&$_POST['status'][$count]=='1')
                          echo "checked=checked" ; 
                        ?>
                        required>Present
                       
                        <input type="radio" name="status[<?php echo $count;?>]" value=0
                         <?php
                        if(isset($_POST['status'][$count])&&$_POST['status'][$count]=='0')
                          echo "checked=checked" ; 
                        ?>
                        required>Absent
                    </td>
                </tr>
              <?php 
                     $count++;
                 }
                 ?>
                 </table>
                 <input type="submit" name="submit" value="submit" class="btn btn-primary">
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

         background-position: center;
         background-repeat: repeat-y;
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