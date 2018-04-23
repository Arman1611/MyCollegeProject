<?php 
   session_start();
    if(isset($_SESSION['email'])){
?>


<head>
    <style>
        .bg { 
         background-image: url("images/repose.jpg");
        height: 100%;
         background-position: center;
         background-repeat: repeat-y;
         background-size: cover;
        }
</style>
</head>
<body>
<div class='bg'><?php
   include("3_one.php");
   include("header.php");
?>
  <div class="container">
      <div class="panel panel-default">
          <div class="panel-heading">
              <a href="add.php" class="btn btn-success">Add Student</a>
              <a href="view.php" class="btn btn-info pull-right">Back</a>
          </div>
          <div class="panel-heading">
              <h3 class="text-center"> <?php echo $_POST['date'] ?></h3>
          </div>
          
          <div class="panel-body">
              <table class="table table-striped">
                 <tr>
                  <th>Roll Number</th>
                  <th>Student Name</th>
                  <th>Atendance Status</th>
                <th>Average Atendance</th>
                </tr>
                 
                 <?php 
                   
                   $result=mysqli_query($con,"select * from present_record where date='$_POST[date]' order by roll_number");
                   while($row=mysqli_fetch_array($result))
                   {
                       $roll=$row['roll_number'];
                       $name=$row['student_name'];
                       
                  ?>
                  <tr>
                      <td><?php echo $roll ; ?></td>
                      <td><?php echo $name ; ?></td>
                    
                      <td><?php
                       if($row['attend_status']==1)
                       echo "  Present  "; 
                       else
                       echo "  Absent  ";
                       ?></td>
                       <td><?php 
                           
                       $average=mysqli_query($con,"SELECT AVG(attend_status) as aver FROM present_record where roll_number='".$roll."'");
                       $res=mysqli_fetch_assoc($average);
                       echo ($res['aver']*100);?>%
                          
                           </td>
                      
                  </tr>
                  <?php 

                   }?>
              </table>
              
          </div>
          
      </div>
      
  </div>   
</div>
</body>
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