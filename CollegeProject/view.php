<?php 
   session_start();
    if(isset($_SESSION['email'])){
?>
  <div class="bg"><?php 
   include("header.php");
   include("3_one.php");
   
 ?>
 <div class="container">
    
     <div class="panel panel-default">
         <div class="panel-heading">
             <a class="btn btn-success" href="add.php">Add Student</a>
             <a class="btn btn-info pull-right" href="index.php">Home</a>
         </div>
        
         <div class="panel panel-body">
                 <table class="table table-striped">
                     <tr>
                       <th>Serial Number</th>
                       <th>Date</th>
                       <th>Show Attendance</th>
                    </tr>
                 
              <?php $result=mysqli_query($con,"select distinct date from present_record");
                 $count=0;
                 while($row=mysqli_fetch_array($result))
                 {
                     $count++;
              ?>
                <tr>
                    <td><?php echo $count?></td>
                    
                    <td><?php echo $row['date'];?></td>                     
                    <td>
                       <form action="show_attendence.php" method="post">
                        <input type="hidden" value="<?php echo $row['date'] ?>" name="date">

                        <input type="submit" value="Show Attendence" class="btn btn-primary">
                      </form>
                    </td>
                    
                </tr>
              <?php
                 }
                 ?>
                 
             </table>

             
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