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
/*$query = "SELECT P_ID, Fac_ID,Paper_title,Paper_type,Paper_N_I,Paper_category,Date_from,Date_to
,Location,paper_path,certificate_path,report_path,Paper_co_authors,volume FROM faculty";*/
$query = "SELECT * from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID ";

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
if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu')
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
	$display = 0;
	if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
	{
		$display = 1;
	}
	else if($_SESSION['username'] == 'member@somaiya.edu')
	{
		$display = 2;
	}
    ?>
    <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Online Course Organised</h2>
                </div><!-- /.box-header -->
				<div style="text-align:right">
					<a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
				</div>
                <div class="box-body">
                <div class="scroll">
    <table  class="table table-stripped table-bordered " id = 'example1'>
        <thead>
            <tr>
                <th>Faculty</th>
                <th>Name</th>
                <th>Duration From</th>
                <th>Duration To</th>
                <th>Organised By</th>
                <th>Purpose</th>
                <th>Target Audience</th>

                <!-- My CODE -->
                
                <th>Faculty Role</th>
                <th>Full/Part time</th>
                <th>Participants</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Sponsored</th>
                <th>Name of sponsored</th>
                <th>Approved</th>

                <!-- My Code End  -->
                
                <th>Certificate</th>
                <th>Report</th>
				
		<?php 
				if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
				{
			?>		
                <th>Attendence Record</th>
                <th>Upload Certificate</th>
                <th>Upload Report</th>
                <th>Upload Attendence Record</th>
                <th>Edit</th>
                <th>Delete</th>
		<?php }?>		
            </tr>
        </thead>
        <?php
        if(mysqli_num_rows($result)>0){
            //we have data to display 
            while($row =mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['F_NAME']."</td>";
                echo "<td>".$row['Course_Name']."</td>";
                echo "<td>".$row['Date_From']."</td>";
                echo "<td>".$row['Date_To']."</td>";
                echo "<td>".$row['Organised_By']."</td>";
                echo "<td>".$row['Purpose']."</td>";
                echo "<td>".$row['Target_Audience']."</td>";

                /* MY CODE */

                echo "<td>".$row['faculty_role']."</td>";
                echo "<td>".$row['full_part_time']."</td>";
                echo "<td>".$row['no_of_part']."</td>";
                echo "<td>".$row['duration']."</td>";
                echo "<td>".$row['status']."</td>";
                echo "<td>".$row['sponsored']."</td>";
                echo "<td>".$row['name_of_sponsor']."</td>";
                echo "<td>".$row['is_approved']."</td>";

                /* My Code End */

                $_SESSION['OC_O_ID'] = $row['OC_O_ID'];
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
                if(($row['attendence_path']) != "")
                {
                        if(($row['attendence_path']) == "NULL")
                            echo "<td>not yet available</td>";
                        else if(($row['attendence_path']) == "not_applicable") 
                            echo "<td>not applicable</td>";
                        else
                            echo "<td> <a href = '".$row['attendence_path']."'>View Attendence Record</td>";
                }
                else
                        echo "<td>no status </td>";
					
		 if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
				{  			
                echo "<td>
                    <form action = 'upload-certificate-organised.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_O_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm' id='hide_value' value = '".$row['OC_O_ID']."'>
                            <span class='glyphicon glyphicon-upload'></span>
                        </button>
                    </form>
                </td>";
                echo "<td>
                    <form action = 'upload-report-organised.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_O_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm' id='hide_value' value = '".$row['OC_O_ID']."'>
                            <span class='glyphicon glyphicon-upload'></span>
                        </button>
                    </form>
                </td>";
                
                echo "<td>
                    <form action = 'upload-attendence.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_O_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm' id='hide_value' value = '".$row['OC_O_ID']."'>
                            <span class='glyphicon glyphicon-upload'></span>
                        </button>
                    </form>
                </td>";
                                
                echo "<td>
                    <form action = '3_edit_online_organised_hod.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_O_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm'>
                            <span class='glyphicon glyphicon-edit'></span>
                        </button>
                    </form>
                </td>";
                echo "<td>
                    <form action = '4_delete_online_organised.php' method = 'POST'>
                        <input type = 'hidden' name = 'id' value = '".$row['OC_O_ID']."'>
                        <button type = 'submit' class = 'btn btn-primary btn-sm'>
                            <span class='glyphicon glyphicon-trash'></span>
                        </button>
                    </form>
                </td>";
                echo"</tr>";
				}
            }
        }
        else{
            //if ther are no entries
            echo "<div class='alert alert-warning'>You have no courses organised</div>";
        }	
        ?>
        
    </table>
	
       
	</div>
	            <div class="text-left"><a href="actcount_course_organised.php"type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus">Add Course</span></a>
	            <a href="count_all_online.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Count Online Course Attended/Organised </span></a> 
		<a href="export_to_excel.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Export to Excel</span></a> 
        
        <?php
        $_SESSION["type"] = "Oragnise";
        ?>

        <a href="chart.php" type="button" class="btn btn-success btn-sm"><span class="glyphicon ">Show Charts</span></a>
	           
			   <!--<a href="mail_reminder.php" type="button" class="btn btn-success btn-sm" target="_blank"><span class="glyphicon ">Mail Reminder</span></a>-->
                 </div>

    </div>
	
	
	
              </div>
             </div>
            </div>
          </section>
    
</div>
   
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    
    
<?php include_once('footer.php'); ?>
   
   