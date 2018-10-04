<?php 
session_start();
 if(!isset($_SESSION['loggedInUser'])){
    //send the iser to login page
    header("location:index.php");
}
include_once('head.php'); 
$_SESSION['currentTab']="Online";?>
<?php include_once('header.php'); ?>

<?php

	    include_once('sidebar_hod.php');
?>
<?php 
include_once("includes/functions.php");
//include custom functions files 
include_once("includes/scripting.php");
?>
<style>
div.scroll
{
overflow:scroll;

}


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-xs-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Analysis of Online Course</h3>
                </div><!-- /.box-header -->
				<div style="text-align:right">
					<a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
				</div>
                <!-- form start -->
                <form role="form" action = "" method="post">
                  <div class="box-body">
                  <div class="form-group col-md-6">
					<div class="form-group col-md-6">
                    <label for="fname">Faculty *</label>
                    <?php
                    include("includes/connection.php");

                    $query="SELECT * from facultydetails";
                    $result=mysqli_query($conn,$query);
                    echo "<select name='fn' id='fname' class='form-control input-lg'><option value=''>Select your choice</option>";
                    while ($row =mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['F_NAME'] ."'>" . $row['F_NAME'] ."</option>";
                    }
                    echo "</select>";
                    ?>
                    </div>
				
                  	 	<div class="form-group row col-md-6" style="display:block ; margin-left:5px " >
						<label for="type">Select Type:</label>
						<select required name='type' id='type' class='form-control input-lg'>
							<option value=''>Select your choice</option>
							<option value="Attended">Attended</option>
							<option value="Organised">Organised</option>
						</select>
						</div>
					
					 <div class="form-group col-md-6" style="margin-left:5px ">
                        <label for="InputDateFrom">Date from :</label>
						&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="min_date">
					</div>
 					
					 <div class="form-group col-md-6" style="margin-left:5px ">

					<label for="InputDateTo">Date To :</label>
					&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<input type="date" name="max_date">
                    </div>    
					</div>					
                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" class="btn btn-primary" name="count" value = "Count Courses"></input>
                    <a href="2_dashboard_hod_online_attended.php" type="button" class="btn btn-primary">Back to View Mode </a>
                  </div>
				   <?php 
						if(isset($_POST['count']))
						{
							$f = 0;
							$v = 0;
							$flag1=0;
							$both_set = 0;
							$_SESSION['flag_count'] = 0;
							$_SESSION['value'] = 4;
							$_SESSION['type'] = $_POST['type'];
							if(empty($_POST['type'])){
								$result="Select type of course<br>";
								echo $result;
								$flag1=1;
							}
							if (empty($_POST['min_date']) && empty($_POST['max_date']))
							{
								$result="Date field cannot be empty<br>";
 								$v = 1;
							}
							if (empty($_POST['fn']))
							{
								$result="Name cannot be empty<br>";
								$v = 2;
							}
							if(empty($_POST['fn']) && empty($_POST['min_date']))
							{
								$result="Both fields cannot be empty<br>";
								$f = 1;
								$both_set = 1;
							}
							if(!empty($_POST['fn']) && !empty($_POST['min_date']))
							{	
								$both_set = 2;
							}
							if((strtotime($_POST['min_date']))>(strtotime($_POST['max_date'])))
							{
								$result="Incorrect date entered. Date from cannot be greater than Date to<br>";
								echo '<div class="error">'.$result.'</div>';
								$flag=1;
							}
							 
							if($f == 1)
							{
								echo '<div class="error">'.$result.'</div>';
							}
							if($f!=1 && $both_set != 2 && $flag1!=1)
							{
								if ($v !=1 )
								{
									$_SESSION['from_date'] = $_POST['min_date'];
									$_SESSION['to_date'] = $_POST['max_date'];
									$_SESSION['flag_count'] = 1;
									execute_query()	;	

								}
								else if($v !=2)
								{
									$_SESSION['sname'] = validateFormData($_POST['fn']);
									$_SESSION['flag_count'] = 2;
									execute_query();	

								}
							}
							else if($both_set == 2)
							{
								$_SESSION['from_date'] = $_POST['min_date'];
								$_SESSION['to_date'] = $_POST['max_date'];
								$_SESSION['sname'] = validateFormData($_POST['fn']);

								$_SESSION['flag_count'] = 3;
								execute_query();
							}
							
	
						}	//end of count
						
				   ?>


<?php	
function execute_query()
{
		include("includes/connection.php");

	$flag=1;
	$display = 0;	
	$type = $_SESSION['type'];
	if($_SESSION['type']=='Attended'){
	
		if($_SESSION['flag_count'] == 1)
		{
			$from_date =  $_SESSION['from_date'] ;
			$to_date = $_SESSION['to_date'] ;
			$sql1 = "select count(*) from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID where Date_From >= '$from_date' and Date_From <= '$to_date' ";

			$result=mysqli_query($conn,$sql1);
			$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
				 
			$pr.="<table class='table table-stripped table-bordered ' border='1' cellpadding=5px cellspacing = 0px style='margin-bottom: 0px;'>
				<tr>
				<th>Total Count</th>";
					$pr.= "<th>".$row['count(*)']."</th></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Total Count</th>
				<?php
					echo "<th>".$row['count(*)']."</th></tr>";
				?>
			</table>
<?php
			$sql1 = "select F_NAME,Date_From,Date_To,Course_Name,Organised_by,Purpose,FDC_Y_N,type_of_course,status_of_activity,duration,credit_audit from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID where Date_From >= '$from_date' and Date_From <= '$to_date' ";
			//$_SESSION['Sql_1']=$sql1;
			$_SESSION['sql']=$sql1;
			$display = 1;
					$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
					
?>	
						<div class="scroll">
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Faculty</th>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>
								
								<!-- MY CODE -->
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                <!-- My Code End  -->

							</tr>
<?php
						$pr.="<table border='1' cellspacing = 0px class='table table-stripped table-bordered'>
							<tr>
								<th>Faculty</th>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                

							</tr>";

						while($row =mysqli_fetch_assoc($result)){
							$fname = $row['F_NAME'];
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$fname."</td>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";

							

							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['FDC_Y_N']."</td>";
			                echo "<td>".$row['type_of_course']."</td>";
			                echo "<td>".$row['status_of_activity']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['credit_audit']."</td>";                

							
							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$fname."</td>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							
							

							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['FDC_Y_N']."</td>";
			                $pr.= "<td>".$row['type_of_course']."</td>";
			                $pr.= "<td>".$row['status_of_activity']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['credit_audit']."</td>";                

							

							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.= "</table>";
						$_SESSION['A_1']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class='btn btn-primary' target='_blank'>Print</a>
						&nbsp;<a href='ExportToExcel_online_hod.php' type='button' class='btn btn-primary' target='_blank'>Export To Excel</a>
						<?php 
					}
					else{
						echo "No records to display<br>";
					}
		}
		else if ($_SESSION['flag_count'] == 2)
		{
				$sname = $_SESSION['sname'] ;
				$sql1 = "SELECT count(*) from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' ";
			$result=mysqli_query($conn,$sql1);
			$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
			$pr.="<table class='table table-stripped table-bordered ' border='1' cellspacing =0 style='margin-bottom: 0px'>
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>";
					$pr.= "<td>".$sname."</td>";
					$pr.= "<td>".$row['count(*)']."</td></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>
				<?php
					echo "<td>".$sname."</td>";
					echo "<td>".$row['count(*)']."</td></tr>";
				?>
			</table>
<?php




				$sql1 = "SELECT F_NAME,Date_From,Date_To,Course_Name,Organised_by,Purpose,FDC_Y_N,type_of_course,status_of_activity,duration,credit_audit from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' ";
				$display = 2;
				//$_SESSION['Sql_2']=$sql1;
				$_SESSION['sql']=$sql1;
				$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
					
?>
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								<!-- MY CODE -->
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                <!-- My Code End  -->

							</tr>
<?php
						$pr.="<table border='1' cellspacing =0 class='table table-stripped table-bordered '>
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                

							</tr>";
						while($row =mysqli_fetch_assoc($result)){
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";

							

							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['FDC_Y_N']."</td>";
			                echo "<td>".$row['type_of_course']."</td>";
			                echo "<td>".$row['status_of_activity']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['credit_audit']."</td>";                

							
							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['FDC_Y_N']."</td>";
			                $pr.= "<td>".$row['type_of_course']."</td>";
			                $pr.= "<td>".$row['status_of_activity']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['credit_audit']."</td>";                

							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.="</table>";
						$_SESSION['A_2']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class='btn btn-primary' target='_blank'>Print</a>
						&nbsp;<a href='export_to_excel.php' type='button' class='btn btn-primary' target='_blank'>Export To Excel</a><?php
					}
					
					else{
						echo "No records to display<br>";
					}
		}
		else if($_SESSION['flag_count'] == 3)
		{
			$from_date =  $_SESSION['from_date'] ;
			$to_date = $_SESSION['to_date'] ;
			$sname = $_SESSION['sname'] ;
$sql1 = "SELECT count(*) from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' and online_course_attended.Date_from >= '$from_date' and online_course_attended.Date_from <= '$to_date'";
			$display = 3;
			$result=mysqli_query($conn,$sql1);
			$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
			$pr.="<table class='table table-stripped table-bordered ' border='1' cellspacing = 0px style='margin-bottom: 0px'>
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>";

					$pr.= "<td>".$sname."</td>";
					$pr.= "<td>".$row['count(*)']."</td></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>
				<?php
					echo "<td>".$sname."</td>";
					echo "<td>".$row['count(*)']."</td></tr>";
				?>
			</table>
<?php



			$sql1 = "SELECT F_NAME,Date_From,Date_To,Course_Name,Organised_By,Purpose,FDC_Y_N,type_of_course,status_of_activity,duration,credit_audit from online_course_attended inner join facultydetails on online_course_attended.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' and online_course_attended.Date_from >= '$from_date' and online_course_attended.Date_from <= '$to_date'";
			//$_SESSION['Sql_3']=$sql1;
			$_SESSION['sql']=$sql1;
					$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
					
?>
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								<!-- MY CODE -->
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                <!-- My Code End  -->

							</tr>
<?php
						$pr.="<table class='table table-stripped table-bordered ' border='1' cellspacing = 0px >
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								
								
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>FDC Status</th>
				                <th>Type of Course</th>
				                <th>Status</th>
				                <th>Duration</th>
				                <th>Credit/Audit</th>

				                

							</tr>";
						while($row =mysqli_fetch_assoc($result)){
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";


							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['FDC_Y_N']."</td>";
			                echo "<td>".$row['type_of_course']."</td>";
			                echo "<td>".$row['status_of_activity']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['credit_audit']."</td>";                

							
							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['FDC_Y_N']."</td>";
			                $pr.= "<td>".$row['type_of_course']."</td>";
			                $pr.= "<td>".$row['status_of_activity']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['credit_audit']."</td>"; 
							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.= "</table>";
						$_SESSION['A_3']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class='btn btn-primary' target='_blank'>Print</a>
						&nbsp;<a href='ExportToExcel_online_hod.php' type='button' class='btn btn-primary' target='_blank'>Export To Excel</a><?php
					}
					else{
						echo "No records to display<br>";
					}
		}
	}
	if($_SESSION['type']=='Organised'){
	
		if($_SESSION['flag_count'] == 1)
		{
			$from_date =  $_SESSION['from_date'] ;
			$to_date = $_SESSION['to_date'] ;
			$sql1 = "select count(*) from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID where Date_From >= '$from_date' and Date_From <= '$to_date' ";

			$result=mysqli_query($conn,$sql1);
			$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
			$pr.="<table border='1' cellspacing = 0px class='table table-stripped table-bordered ' style='margin-bottom: 0px'>
				<tr>
				<th>Total Count</th>";
					$pr.= "<th>".$row['count(*)']."</th></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Total Count</th>
				<?php
					echo "<th>".$row['count(*)']."</th></tr>";
				?>
			</table>
<?php


			$sql1 = "select F_NAME,`Course_Name`, `Date_From`, `Date_To`, `Organised_By`, `Purpose`, `Target_Audience`, `faculty_role`, `full_part_time`, `no_of_part`, `duration`, `status`, `sponsored`, `name_of_sponsor`, `is_approved` from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID where Date_From >= '$from_date' and Date_From <= '$to_date' ";
			//$_SESSION['Sql_4']=$sql1;
			$_SESSION['sql']=$sql1;
			$display = 4;
					$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
					
?>
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Faculty</th>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								<!-- MY CODE  -->

								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsored</th>
				                <th>Approved</th>

				                <!-- My Code End  -->

							</tr>
<?php
						$pr.="<table border='1' cellspacing = 0px class='table table-stripped table-bordered '>
							<tr>
								<th>Faculty</th>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsored</th>
				                <th>Approved</th>
							</tr>";
						while($row =mysqli_fetch_assoc($result)){
							$fname = $row['F_NAME'];
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$fname."</td>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";
							
							

							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['Target_Audience']."</td>";
			                echo "<td>".$row['faculty_role']."</td>";
			                echo "<td>".$row['full_part_time']."</td>";
			                echo "<td>".$row['no_of_part']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['status']."</td>";
			                echo "<td>".$row['sponsored']."</td>";
			                echo "<td>".$row['name_of_sponsor']."</td>";
			                echo "<td>".$row['is_approved']."</td>";

			                

							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$fname."</td>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['Target_Audience']."</td>";
			                $pr.= "<td>".$row['faculty_role']."</td>";
			                $pr.= "<td>".$row['full_part_time']."</td>";
			                $pr.= "<td>".$row['no_of_part']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['status']."</td>";
			                $pr.= "<td>".$row['sponsored']."</td>";
			                $pr.= "<td>".$row['name_of_sponsor']."</td>";
			                $pr.= "<td>".$row['is_approved']."</td>";
							
							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.= "</table>";
						$_SESSION['O_1']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class='btn btn-primary' target='_blank'>Print</a>
						&nbsp;<a href='ExportToExcel_online_hod.php' type='button' class='btn btn-primary' target='_blank'>Export To Excel</a><?php
					}
					else{
						echo "No records to display<br>";
					}
		}
		else if ($_SESSION['flag_count'] == 2)
		{
				$sname = $_SESSION['sname'] ;
				$sql1 = "SELECT count(*) from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' ";
				$result=mysqli_query($conn,$sql1);
				$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
				$pr.="<table class='table table-stripped table-bordered ' border='1' cellspacing = 0px style='margin-bottom: 0px'>
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>";
					$pr.= "<td>".$sname."</td>";
					$pr.= "<td>".$row['count(*)']."</td></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>
				<?php
					echo "<td>".$sname."</td>";
					echo "<td>".$row['count(*)']."</td></tr>";
				?>
			</table>
<?php

				$sql1 = "SELECT F_NAME,`Course_Name`, `Date_From`, `Date_To`, `Organised_By`, `Purpose`, `Target_Audience`, `faculty_role`, `full_part_time`, `no_of_part`, `duration`, `status`, `sponsored`, `name_of_sponsor`, `is_approved` from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' ";
				$display = 5;
				//$_SESSION['Sql_5']=$sql1;
				$_SESSION['sql']=$sql1;
				$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
?>
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								<!-- MY CODE  -->

								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsor</th>
				                <th>Approved</th>

				                <!-- My Code End  -->

							</tr>
<?php
						$pr.="<table class='table table-stripped table-bordered ' border='1' cellspacing = 0px >
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsored</th>
				                <th>Approved</th>
							</tr>";
						while($row =mysqli_fetch_assoc($result)){
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";

							

							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['Target_Audience']."</td>";
			                echo "<td>".$row['faculty_role']."</td>";
			                echo "<td>".$row['full_part_time']."</td>";
			                echo "<td>".$row['no_of_part']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['status']."</td>";
			                echo "<td>".$row['sponsored']."</td>";
			                echo "<td>".$row['name_of_sponsor']."</td>";
			                echo "<td>".$row['is_approved']."</td>";

			                

							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['Target_Audience']."</td>";
			                $pr.= "<td>".$row['faculty_role']."</td>";
			                $pr.= "<td>".$row['full_part_time']."</td>";
			                $pr.= "<td>".$row['no_of_part']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['status']."</td>";
			                $pr.= "<td>".$row['sponsored']."</td>";
			                $pr.= "<td>".$row['name_of_sponsor']."</td>";
			                $pr.= "<td>".$row['is_approved']."</td>";
							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.= "</table>";
						$_SESSION['O_2']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class='btn btn-primary' target='_blank'>Print</a>
						&nbsp;<a href='ExportToExcel_online_hod.php' type='button' class='btn btn-primary' target='_blank'>Export To Excel</a><?php
					}
					else{
						echo "No records to display<br>";
					}
		}
		else if($_SESSION['flag_count'] == 3)
		{
			$from_date =  $_SESSION['from_date'] ;
			$to_date = $_SESSION['to_date'] ;
			$sname = $_SESSION['sname'] ;
			$sql1 = "SELECT count(*) from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' and online_course_organised.Date_from >= '$from_date' and online_course_organised.Date_from <= '$to_date'";
			$display = 6;

$result=mysqli_query($conn,$sql1);
			$row =mysqli_fetch_assoc($result);
			$pr="<p align='center'  style='font-size:20px'><strong>K.J.Somaiya College of Engineering</strong></p>"."<p align='center'>(Autonomous College affiliated to University of Mumbai)</p>"."<p align='center'>Online Courses $type analysis</p>";
			$pr.="<table border='1' cellspacing = 0px class='table table-stripped table-bordered ' style='margin-bottom: 0px'>
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>";				
					$pr.= "<td>".$sname."</td>";
					$pr.= "<td>".$row['count(*)']."</td></tr></table>";
			?>
			<table class="table table-stripped table-bordered " style="margin-bottom: 0px">
				<tr>
				<th>Faculty</th>
				<th>Total Count</th></tr><tr>
				<?php
					echo "<td>".$sname."</td>";
					echo "<td>".$row['count(*)']."</td></tr>";
				?>
			</table>
<?php
			$sql1 = "SELECT F_NAME,`Course_Name`, `Date_From`, `Date_To`, `Organised_By`, `Purpose`, `Target_Audience`, `faculty_role`, `full_part_time`, `no_of_part`, `duration`, `status`, `sponsored`, `name_of_sponsor`, `is_approved` from online_course_organised inner join facultydetails on online_course_organised.Fac_ID = facultydetails.Fac_ID and facultydetails.F_NAME like '%$sname%' and online_course_organised.Date_from >= '$from_date' and online_course_organised.Date_from <= '$to_date'";
			$_SESSION['sql']=$sql1;
			//$_SESSION['Sql_6']=$sql1;
					$result=mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result)>0){
					
?>
						<table class="table table-stripped table-bordered ">
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>

								<!-- MY CODE  -->

								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsored</th>
				                <th>Approved</th>

				                <!-- My Code End  -->

							
							</tr>
<?php
						$pr.="<table border='1' cellspacing = 0px class='table table-stripped table-bordered '>
							<tr>
								<th>Date From</th>
								<th>Date To</th>
								<th>Course Name</th>
								<th>Organised By</th>
				                <th>Purpose</th>
								<th>Target Audience</th>
				                <th>Faculty Role</th>
				                <th>Full/Part time</th>
				                <th>Participants</th>
				                <th>Duration</th>
				                <th>Status</th>
				                <th>Sponsored</th>
				                <th>Name of sponsored</th>
				                <th>Approved</th>
							</tr>";
						while($row =mysqli_fetch_assoc($result)){
							$name = $row['Course_Name'];
							$startdate = $row['Date_From'];
							$enddate = $row['Date_To'];
							echo "<tr>";
							echo "<td>".$startdate."</td>";
							echo "<td>".$enddate."</td>";
							echo "<td>".$name."</td>";
							
							

							echo "<td>".$row['Organised_By']."</td>";
			                echo "<td>".$row['Purpose']."</td>";
			                echo "<td>".$row['Target_Audience']."</td>";
			                echo "<td>".$row['faculty_role']."</td>";
			                echo "<td>".$row['full_part_time']."</td>";
			                echo "<td>".$row['no_of_part']."</td>";
			                echo "<td>".$row['duration']."</td>";
			                echo "<td>".$row['status']."</td>";
			                echo "<td>".$row['sponsored']."</td>";
			                echo "<td>".$row['name_of_sponsor']."</td>";
			                echo "<td>".$row['is_approved']."</td>";

			                

							
							echo "</tr>";
							$pr.= "<tr>";
							$pr.= "<td>".$startdate."</td>";
							$pr.= "<td>".$enddate."</td>";
							$pr.= "<td>".$name."</td>";
							$pr.= "<td>".$row['Organised_By']."</td>";
			                $pr.= "<td>".$row['Purpose']."</td>";
			                $pr.= "<td>".$row['Target_Audience']."</td>";
			                $pr.= "<td>".$row['faculty_role']."</td>";
			                $pr.= "<td>".$row['full_part_time']."</td>";
			                $pr.= "<td>".$row['no_of_part']."</td>";
			                $pr.= "<td>".$row['duration']."</td>";
			                $pr.= "<td>".$row['status']."</td>";
			                $pr.= "<td>".$row['sponsored']."</td>";
			                $pr.= "<td>".$row['name_of_sponsor']."</td>";
			                $pr.= "<td>".$row['is_approved']."</td>";
							
							$pr.= "</tr>";
						}
						echo "</table>";
						$pr.= "</table>";
						$_SESSION['O_3']=$pr;
						?><a href='print_all_online.php?display=<?php echo $display;?>' style='margin-left:5px' type='button' class="btn btn-primary" target='_blank'>Print</a>
						<a href='ExportToExcel_online_hod.php' type='button' class="btn btn-primary" target='_blank'>Export To Excel</a>
						<?php
					}
					else{
						echo "No records to display<br>";
					}
		}
	}
}

?>

<?php 
function print1($op){
	$dompdf = new DOMPDF();
	$dompdf->load_html($op);
	$dompdf->set_paper('a4', 'portrait');
	$dompdf->render();
	$dompdf->stream('hi',array('Attachment'=>0));
}
?>
</form>
                
							</div> </div>
              </div>
           </div>      
        </section>
	</div>	
	
<?php include_once('footer.php'); ?>
