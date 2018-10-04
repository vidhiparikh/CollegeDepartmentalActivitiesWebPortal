<?php
session_start();
if(!isset($_SESSION['loggedInUser'])){
    //send them to login page
    header("location:index.php");
}
//connect to database
include("includes/connection.php");
$fid = $_SESSION['Fac_ID'];
//query and result
$query = "SELECT * FROM online_course_attended where Fac_ID ='".$_SESSION['Fac_ID']."' ;";
$result = mysqli_query($conn,$query);
$_SESSION['currentTab']="Online";
$successMessage="";
if(isset($_GET['alert'])){
    if($_GET['alert']=="success"){
        $successMessage='<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>
        <strong>Record added successfully</strong>
        </div>';  
    }
    elseif($_GET['alert']=="update"){
        $successMessage='<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>
        <strong>Record updated successfully</strong>
        </div>';  
    }
    elseif($_GET['alert']=="delete"){
        $successMessage='<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
            </button>
        <strong>Record deleted successfully</strong>
        </div>';  
    }
}
?>





<?php include_once('head.php'); ?>
<?php include_once('header.php'); ?>
<?php 
if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
  {
	    include_once('sidebar_hod.php');

  }
  else
	  include_once('sidebar.php');
 ?>

<style>
div.scroll
{
overflow:scroll;

}


</style>



<div class="content-wrapper">
    <?php 
        {
        echo $successMessage;
    }
    ?>
    <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Online Course Attended</h2>
                </div><!-- /.box-header -->
				<div style="text-align:right">
				<a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
				</div>
                <div class="box-body">
				<div class="scroll">
    <table  class="table table-stripped table-bordered " id = 'example1'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Duration From</th>
                <th>Duration To</th>
                <th>Organised By</th>
                <th>Purpose</th>
				<th>FDC Status</th>
                
                <!-- My CODE -->
                
                <th>Type of Course</th>
                <th>Status</th>
                <th>Duration</th>
                <th>Credit/Audit</th>

                <!-- My Code End  -->

                <th>Certificate</th>
                <th>Report</th>
                <th>Upload Certificate</th>
                <th>Upload Report</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <?php
        if(mysqli_num_rows($result)>0){
            //we have data to display 
            while($row =mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['Course_Name']."</td>";
                echo "<td>".$row['Date_From']."</td>";
                echo "<td>".$row['Date_To']."</td>";
                echo "<td>".$row['Organised_by']."</td>";
                echo "<td>".$row['Purpose']."</td>";
                echo "<td>".$row['FDC_Y_N']."</td>";

                /* My Code */

                echo "<td>".$row['type_of_course']."</td>";
                echo "<td>".$row['status_of_activity']."</td>";
                echo "<td>".$row['duration']."</td>";
                echo "<td>".$row['credit_audit']."</td>";                


                /*My COde End*/

				$_SESSION['OC_A_ID'] = $row['OC_A_ID'];
				if(($row['certificate_path']) != "")
				{
						if(($row['certificate_path']) == "NULL")
							echo "<td>not yet available</td>";
						else if(($row['certificate_path']) == "not_applicable") 
							echo "<td>not applicable</td>";
						else
							echo "<td> <a href = '".$row['certificate_path']."'>View certificate</td>";
				}
				else
						echo "<td>no status </td>";
				
				if(($row['report_path']) != "")
				{
						if(($row['report_path']) == "NULL")
							echo "<td>not yet available</td>";
						else if(($row['report_path']) == "not_applicable") 
							echo "<td>not applicable</td>";
						else
							echo "<td> <a href = '".$row['report_path']."'>View report</td>";
				}
				else
						echo "<td>no status </td>";
                echo "<td>
                    <form action = 'upload-certificate-attended.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_A_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm' id='hide_value' value = '".$row['OC_A_ID']."'>  <span class='glyphicon glyphicon-certificate'></span> </button>
                    </form>
                </td>";
				echo "<td>
                    <form action = 'upload-report-attended.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_A_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm' id='hide_value' value = '".$row['OC_A_ID']."'>
                            <span class='glyphicon glyphicon-upload'></span>
                        </button>
                    </form>
                </td>";
				
                echo "<td>
                    <form action = '3_edit_online_attended.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_A_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm'>
                            <span class='glyphicon glyphicon-edit'></span>
                        </button>
                    </form>
                </td>";
                echo "<td>
                    <form action = '4_delete_online_attended.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_A_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm'>
                            <span class='glyphicon glyphicon-trash'></span>
                        </button>
                    </form>
                </td>";
                echo"</tr>";
            }
        }
        else{
            //if ther are no entries
            echo "<div class='alert alert-warning'>You have no courses attended</div>";
        }
        ?>
    </table>
	</div>
	            <div class="text-left"><a href="actcount_course_attended.php"type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus">Add Course</span></a>
	            <a href="count_your_online.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Count Courses</span></a> 
	            <a href="ExportToExcel_online.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Export to Excel</span></a> 
	            <?php
            $_SESSION["type"] = "Attended";
        ?>
        <a href="select_faculty.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Show Charts</span></a> 
    </div>
              </div>
             </div>
            </div>
          </section>
</div>
<?php include_once('footer.php'); ?>