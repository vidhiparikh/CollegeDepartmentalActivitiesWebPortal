    
<?php
ob_start();
session_start();
include_once('head.php'); 
 include_once('header.php'); 
//check if user has logged in or not

if(!isset($_SESSION['loggedInUser'])){
    //send the iser to login page
    header("location:index.php");
}
//connect ot database
include_once("includes/connection.php");

//include custom functions files 
include_once("includes/functions.php");
include_once("includes/scripting.php");

$_SESSION['currentTab']="Online";

//setting error variables
$nameError="";
$emailError="";
$faculty_role=$full_part_time=$no_of_part=$duration=$status=$sponcered=$name_of_sponcer=$is_approved=$course = $startDate = $endDate = $organised = $purpose = $target = "";
$flag= 0;
$success = 0;
		
	$count1 = $_SESSION['count'];
	
        $faculty_name= $_SESSION['loggedInUser'];

// $query="SELECT * from online_course_attended where Fac_ID = $fid ";
//     $result=mysqli_query($conn,$query);
// 	if(mysqli_num_rows($result)>0){
//         $row=mysqli_fetch_assoc($result);
		
// 	}
//check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST['add'])){

    //the form was submitted
    $fname_array = $_POST['fname'];
	$course_array = $_POST['course'];
	$startDate_array = $_POST['startDate'];
	$endDate_array = $_POST['endDate'];
	$organised_array = $_POST['organised'];
    $purpose_array = $_POST['purpose'];
    $target_array = $_POST['target'];
    $faculty_role_array = $_POST['role'];
    $full_part_time_array = $_POST['type'];
    $no_of_part_array = $_POST['participants'];
    $duration_array = $_POST['duration'];
    $status_array = $_POST['status'];
    $sponcered_array = $_POST['sponsored'];
    $name_of_sponcer_array = $_POST['sponsorer'];
    $is_approved_array = $_POST['isApproved'];

	/*	$min_no_array=$_POST['min_no'];
		$serial_no_array=$_POST['serial_no'];
				$period_array = $_POST['period'];

		$od_approv_array=$_POST['od_approv'];
		$od_avail_array=$_POST['od_avail'];
		$fee_sac_array=$_POST['fee_sac'];
		$fee_avail_array=$_POST['fee_avail'];*/
	
	
    //check for any blank input which are required
    		
for($i=0; $i<count($course_array);$i++)
{
    $fname = mysqli_real_escape_string($conn,$fname_array[$i]);
    $course = mysqli_real_escape_string($conn,$course_array[$i]);

    $startDate = mysqli_real_escape_string($conn,$startDate_array[$i]);
    $endDate = mysqli_real_escape_string($conn,$endDate_array[$i]);
    $organised = mysqli_real_escape_string($conn,$organised_array[$i]);
    $purpose = mysqli_real_escape_string($conn,$purpose_array[$i]);
    $target = mysqli_real_escape_string($conn,$target_array[$i]);
    $faculty_role = mysqli_real_escape_string($conn,$faculty_role_array[$i]);
    $full_part_time = mysqli_real_escape_string($conn,$full_part_time_array[$i]);
    $no_of_part = mysqli_real_escape_string($conn,$no_of_part_array[$i]);
    $duration = mysqli_real_escape_string($conn,$duration_array[$i]);
    $status = mysqli_real_escape_string($conn,$status_array[$i]);
    $sponcered = mysqli_real_escape_string($conn,$sponcered_array[$i]);
    $name_of_sponcer = mysqli_real_escape_string($conn,$name_of_sponcer_array[$i]);
    $is_approved = mysqli_real_escape_string($conn,$is_approved_array[$i]);
 
  if(empty($_POST['course[]'])){
        $nameError="Please enter Course Name";
		$flag = 0;
    }
    else{
        $course=validateFormData($course);
        $course = "'".$course."'";
		$flag=1;
    }
		
    if(empty($_POST['startDate[]'])){
        $nameError="Please enter a start date";
		$flag = 0;
    }
    else{
        $startDate=validateFormData($startDate);
        $startDate = "'".$startDate."'";
		$flag=1;
    }
	
	 if(empty($_POST['endDate[]'])){
        $nameError="Please enter end date";
		$flag = 0;
    }
    else{
        $endDate=validateFormData($endDate);
        $endDate = "'".$endDate."'";
		$flag=1;
    }
	 if(empty($_POST['location[]'])){
        $nameError="Please enter location";
    }
    else{
        $location=validateFormData($location);
        $location = "'".$location."'";
    }
	  
	  //following are not required so we can directly take them as it is

		
	
	  //checking if there was an error or not
        $query = "SELECT Fac_ID from facultydetails where F_NAME= '$fname'";
        echo $query;
        $result=mysqli_query($conn,$query);
       if($result){
            echo "stringdsandknaslkdnklasndlnasklndklnasdlnlansdklnaslndldnlasklnk";
            $row = mysqli_fetch_assoc($result);
            $author = $row['Fac_ID'];
       }

        $sql="INSERT INTO online_course_organised(Fac_ID,Course_Name, Date_from, Date_to,Organised_by, Purpose, Target_Audience,faculty_role, full_part_time, no_of_part, duration, status, sponcered, name_of_sponcer, is_approved) VALUES ('$author','$course','$startDate','$endDate','$organised','$purpose','$target','$faculty_role', '$full_part_time', '$no_of_part', '$duration', '$status', '$sponcered', '$name_of_sponcer', '$is_approved')";
			if ($conn->query($sql) === TRUE) {
				$success = 1;
                header("location:2_dashboard_hod_online_organised.php?alert=success");
			//header("location:2_dashboard.php?alert=success");
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			//Commented as no fdc in organised
            /*if($success == 1 && $fdc == 'yes')
			{
				$sql="INSERT INTO fdc(Fac_ID,Course_Name) VALUES ('$author','$course')";
				$result = mysqli_query($conn,$sql);
				
			}*/
}//end of for
            //Commented as no fdc in organised
            /*
			if($success == 1)	
			{
				$query = "SELECT * FROM online_course_organised where Fac_ID = $author and FDC_Y_N = 'yes' ;";
				$result = mysqli_query($conn,$query);
				 if(mysqli_num_rows($result)>0 ){
 					header("location:5_fdc_dashboard.php?alert=success");

				 }
				 else
  					header("location:2_dashboard_online_organised.php?alert=success");
			}*/		        
}
}
//close the connection
mysqli_close($conn);
?>

<?php 
if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
  {
	    include_once('sidebar_hod.php');

  }
  else
	  include_once('sidebar.php');

?>
 
<div class="content-wrapper">
    
    <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Online Course Organised</h3>
                </div>
                <div style="text-align:right">
                    <a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
	
				
	<?php
			
					for($k=0; $k<$_SESSION['count'] ; $k++)
					{

				?>
            <p>   ***********************************************************
            <?php echo nl2br("\nForm " . ($k+1)); ?>
			<form role="form" method="POST" class="row" action ="" style= "margin:10px;" >
					


                    <div class="form-group col-md-6">
                    <label for="fname">Faculty *</label>

                    <?php
                    include("includes/connection.php");

                    $query="SELECT * from facultydetails";
                    $result=mysqli_query($conn,$query);
                    echo "<select name='fname[]' id='fname' class='form-control input-lg'>";
                    while ($row =mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['F_NAME'] ."'>" . $row['F_NAME'] ."</option>";
                    }
                    echo "</select>";
                    ?>
                    </div>

				
                     <div class="form-group col-md-6">
                         <label for="course-name">Name of course *</label>
                      <!--   <input required type="text" class="form-control input-lg" id="paper-title" name="course[]">-->
					  <input  required type="text" class="form-control input-lg"  name="course[]">
                     </div>

                     <div class="form-group col-md-6">
                         <label for="start-date">Duration From *</label>
                         <input required type="date" class="form-control input-lg" id="start-date" name="startDate[]"
                         placeholder="03:10:10">
                     </div>

                    <div class="form-group col-md-6">
                         <label for="end-date">Duration To *</label>
                         <input required type="date" class="form-control input-lg" id="end-date" name="endDate[]"
                         placeholder="03:10:10">
                     </div>

                    <div class="form-group col-md-6">
                         <label for="organised">Course organised by *</label>
                         <input required type="text" class="form-control input-lg" id="organised" name="organised[]">
                     </div>

                     <div class="form-group col-md-6">
                         <label for="purpose">Purpose of Course * </label>
                         <textarea  required class="form-control input-lg" id="purpose" name="purpose[]" rows="2"></textarea>
                     </div>
                     
					 <div class="form-group col-md-6">
                         <label for="target">Target Audience * </label>
                         <textarea  required class="form-control input-lg" id="target" name="target[]" rows="2"></textarea>
                     </div>
                     <div class="form-group col-md-6">
                         <label for="role">Faculty Role</label>
                         <textarea  required class="form-control input-lg" id="role" name="role[]" rows="2"></textarea>
                     </div>
                      <div class="form-group col-md-6">
                          <label for="type">Fulltime/Part-time</label>
                          <select required class="form-control input-lg" id="type" name="type[]">
                              <option value = "fulltime">Full time</option>
                              <option value="parttime">Part time</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="noofparticipants">Number Of Participants</label>
                          <input  required type="text" class="form-control input-lg"  id="participants" name="participants[]">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="duration">Enter the durationof the course in hrs/week</label>
                          <input required type="text" class="form-control input-lg" id="duration" name="duration[]">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="status">Status Of Activity *</label>
                          <select required class="form-control input-lg" id="status" name="status[]">
                              <option value = "local">Local</option>
                              <option value = "state">State</option>
                              <option value="national">National</option>
                              <option value="international">International</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="sponsored">Sponsored?</label>
                          <input type='radio' name='sponsored' class='not-sponsored' value='not-sponsored' >Not Sponsored <br>
                          <input type='radio' name='sponsored' class='sponsored' value='sponsored' > Sponsored
                      </div>
                      <div class="sponsored-div">
                          <div class="form-group col-md-6">
                              <label for="sponsorer">Name Of Sponsorer</label>
                              <input  type="text" class="form-control input-lg" id="sponsorer" name="sponsorer[]">
                          </div>
                          <div class="form-group col-md-6">
                              <label for="isApproved">Approval Details</label>
                              <textarea requiredname="isApproved" id="isApproved" name="isApproved[]" cols="25" rows="2"></textarea>
                          </div>
                      </div>
                     
                   <?php
					}
					?>
					<br/>
                    <div class="form-group col-md-12">
                         

                         <button name="add"  type="submit" class="btn btn-success btn-lg">Submit</button>
                         <a href="menu.php?menu=5" type="button" class="btn pull-right btn-warning btn-lg">Cancel</a>
                    </div>
                </form>
                </div>
              </div>
           </div>      
        </section>
</div>
<?php include_once('footer.php'); ?>

