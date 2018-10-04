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



//setting error variables
$nameError="";
$emailError="";
$type_of_course = $status_of_activity = $duration = $credit_audit = $course = $startDate = $endDate = $organised = $purpose = "";
$flag= 0;
$success = 0;
		$fid = $_SESSION['Fac_ID'];
	$count1 = $_SESSION['count'];
	
        $faculty_name= $_SESSION['loggedInUser'];
		$_SESSION['currentTab']="Online";
$query="SELECT * from online_course_attended where Fac_ID = $fid ";
    $result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
		
	}
//check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST['add'])){

    //the form was submitted
    
	$course_array = $_POST['course'];
	$startDate_array = $_POST['startDate'];
	$endDate_array = $_POST['endDate'];
	$organised_array = $_POST['organised'];
    $purpose_array = $_POST['purpose'];
	$fdc_array = $_POST['fdc'];

	/*  MY CODE */
	$type_of_course_array = $_POST['type'];
	$status_of_activity_array = $_POST['status'];
	$duration_array = $_POST['duration'];
	$credit_audit_array = $_POST['creau'];

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
$course = mysqli_real_escape_string($conn,$course_array[$i]);

$startDate = mysqli_real_escape_string($conn,$startDate_array[$i]);
$endDate = mysqli_real_escape_string($conn,$endDate_array[$i]);
$organised = mysqli_real_escape_string($conn,$organised_array[$i]);
$purpose = mysqli_real_escape_string($conn,$purpose_array[$i]);

/*  MY CODE */
$type_of_course = mysqli_real_escape_string($conn,$type_of_course_array[$i]);
$status_of_activity = mysqli_real_escape_string($conn,$status_of_activity_array[$i]);
$duration = mysqli_real_escape_string($conn,$duration_array[$i]);
$credit_audit = mysqli_real_escape_string($conn,$credit_audit_array[$i]);


$fdc = mysqli_real_escape_string($conn,$fdc_array[$i]);
$_SESSION['fdc'] = $fdc;


 
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
	if(empty($_POST['organised[]'])){
        $nameError="Please enter organised";
        $flag = 0;
    }
    else{
        $organised=validateFormData($organised);
        $organised = "'".$organised."'";
        $flag=1;
    }
	  //following are not required so we can directly take them as it is

		
	
	  //checking if there was an error or not
        $query = "SELECT Fac_ID from facultydetails where Email='".$_SESSION['loggedInEmail']."';";
        $result=mysqli_query($conn,$query);
       if($result){
            $row = mysqli_fetch_assoc($result);
            $author = $row['Fac_ID'];
	   }

	   	// MY QUERY
        $sql="INSERT INTO online_course_attended(Fac_ID,Course_Name, Date_from, Date_to,Organised_by, Purpose, FDC_Y_N,type_of_course,status_of_activity,duration,credit_audit) VALUES ('$author','$course','$startDate','$endDate','$organised','$purpose','$fdc','$type_of_course','$status_of_activity','$duration','$credit_audit')";
        echo $sql;
			if ($conn->query($sql) === TRUE) {
				$success = 1;
			//header("location:2_dashboard.php?alert=success");
                /*
Notice: Undefined variable: author in C:\xampp\htdocs\extc\1_add_course_attended.php on line 128
INSERT INTO online_course_attended(Fac_ID,Course_Name, Date_from, Date_to,Organised_by, Purpose, FDC_Y_N) VALUES ('','abcdte','2017-01-01','2017-12-31','test','testing','no')Error: INSERT INTO online_course_attended(Fac_ID,Course_Name, Date_from, Date_to,Organised_by, Purpose, FDC_Y_N) VALUES ('','abcdte','2017-01-01','2017-12-31','test','testing','no')
Cannot add or update a child row: a foreign key constraint fails (`department`.`online_course_attended`, CONSTRAINT `fk_id` FOREIGN KEY (`Fac_ID`) REFERENCES `facultydetails` (`Fac_ID`) ON UPDATE CASCADE*/
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			if($success == 1 && $fdc == 'yes')
			{
				$sql="INSERT INTO fdc_online_course(Fac_ID,Course_Name) VALUES ('$author','$course')";
				$result = mysqli_query($conn,$sql);
				
			}
}//end of for
			if($success == 1)	
			{
				$query = "SELECT * FROM online_course_attended where Fac_ID = $author and FDC_Y_N = 'yes' ;";
				$result = mysqli_query($conn,$query);
				 if(mysqli_num_rows($result)>0 && $fdc == 'yes'){
 					header("location:5_fdc_dashboard.php?alert=success");

				 }
				 else
  					header("location:2_dashboard_online_attended.php?alert=success");
			}			        
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
                  <h3 class="box-title">Online Course Attended</h3>
                </div>
                <div style="text-align:right">
                <a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
	
				<div class="form-group col-md-6">

                         <label for="faculty-name">Faculty Name</label>
                         <input required type="text" class="form-control input-lg" id="faculty-name" name="facultyName" value="<?php echo $faculty_name; ?>" readonly>
                     </div><br/> <br/> <br/> <br/> 
	<?php
			
					for($k=0; $k<$_SESSION['count'] ; $k++)
					{

				?>
            <p>   ***********************************************************
            <?php echo nl2br("\nForm " . ($k+1)); ?>
			<form role="form" method="POST" class="row" action ="" style= "margin:10px;" >

                      <div class="form-group col-md-6">
                          <label for="type">Type Of Course*</label>
                          <select required class="form-control input-lg" id="type" name="type[]">
                              <option value = "online">Online</option>
                              <option value = "offline">Offline</option>
                          </select>
                      </div>
                     <div class="form-group col-md-6">
                         <label for="course-name">Name of course *</label>
                      <!--   <input required type="text" class="form-control input-lg" id="paper-title" name="course[]">-->
					  <input required  type="text" class="form-control input-lg"  name="course[]">
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
                         <label for="fdc">Applied for FDC ? *</label>
                         <select required class="form-control input-lg" id="fdc" name="fdc[]">
                             <option value = "yes">Yes</option>
                             <option value = "no">No</option>
                         </select>
                     </div>
					<div class="approved-div">
                          <div class="form-group col-md-6">serial no, period
                              <label for="minno">Min No</label>
                              <input  type="text" class="form-control input-lg" id="minno" name="minno[]">
                          </div>
                          <div class="form-group col-md-6">serial no, period
                              <label for="minno">Min No</label>
                              <input  type="text" class="form-control input-lg" id="minno" name="minno[]">
                          </div>
                          <div class="form-group col-md-6">serial no, period
                              <label for="minno">Min No</label>
                              <input  type="text" class="form-control input-lg" id="minno" name="minno[]">
                          </div>
                          
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
                          <label for="duration">Enter the duration of the course in hrs/week</label>
                          <input required type="text" class="form-control input-lg" id="duration" name="duration[]">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="creau">Credit/Audit *</label>
                          <select required class="form-control input-lg" id="creau" name="creau[]">
                              <option value = "credit">Credit</option>
                              <option value = "audit">Audit</option>
                          </select>
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