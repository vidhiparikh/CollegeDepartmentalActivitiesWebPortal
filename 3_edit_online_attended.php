<?php
session_start();
//check if user has logged in or not

if(!isset($_SESSION['loggedInUser'])){
    //send the user to login page
    header("location:index.php");
}
//connect to database
include_once("includes/connection.php");

//include custom functions files 
include_once("includes/functions.php");
$_SESSION['currentTab']="Online";
//setting error variables
$nameError="";
$emailError="";
$courseName = $startDate = $endDate = $paperType = $paperLevel = $paperCategory = $location = $coAuthors = "";

$Fac_ID=null;
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "SELECT * from online_course_attended where OC_A_ID = $id";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    $Fac_ID = $row['Fac_ID'];
    $courseName = $row['Course_Name'];
    $startDate = $row['Date_From'];
    $endDate = $row['Date_To'];
    $organised = $row['Organised_by'];
    $purpose = $row['Purpose'];
    //echo $purpose."dhasjdjkanskdnkasnjkdnkjasnd".$endDate;
    $fdc = $row['FDC_Y_N'];

    /*  MY CODE */
    $type_of_course = $row['type_of_course'];
    $status_of_activity = $row['status_of_activity'];
    $duration = $row['duration'];
    $credit_audit = $row['credit_audit'];

}//Notice: Undefined variable: Fac_ID in C:\xampp\htdocs\extc\3_edit_online.php on line 41			
			$query2 = "SELECT * from facultydetails where Fac_ID = $Fac_ID";
			$result2 = mysqli_query($conn,$query2);
			if($result2)
			{
	            $row = mysqli_fetch_assoc($result2);
				$F_NAME = $row['F_NAME'];

			}
	   

//check if the form was submitted
if(isset($_POST['update'])){
    //the form was submitted
    $clientName=$clientEmail=$clientPhone=$clientAddress=$clientCompany=$clientNotes="";
    
    //check for any blank input which are required
    
   if(!$_POST['courseName']){
        $nameError="Please enter a Title<br>";
    }
    else{
        $courseName=validateFormData($_POST['courseName']);
        $courseName = "'".$courseName."'";
    }
    
    if(!$_POST['startDate']){
        $nameError="Please enter a start date<br>";
    }
    else{
        $startDate=validateFormData($_POST['startDate']);
        $startDate = "'".$startDate."'";
    }
    if(!$_POST['endDate']){
        $nameError="Please enter an end date<br>";
    }
    else{
        $endDate=validateFormData($_POST['endDate']);
        $endDate = "'".$endDate."'";
    }
    if(!$_POST['organised']){
        $organised="Please enter organised by purpose<br>";
    }
    else{
        $organised=validateFormData($_POST['organised']);
        $organised = "'".$organised."'";
    }
   if(!$_POST['type']){$nameError="Please enter a type<br>";}else{$type=validateFormData($_POST['type']);
       $type = "'".$type."'";}
   if(!$_POST['status']){$nameError="Please enter a status<br>";}else{$status=validateFormData($_POST['status']);
       $status = "'".$status."'";}
   if(!$_POST['duration']){$nameError="Please enter a duration<br>";}else{$duration=validateFormData($_POST['duration']);
       $duration = "'".$duration."'";}
   if(!$_POST['creau']){$nameError="Please enter a type<br>";}else{$creau=validateFormData($_POST['creau']);
       $creau = "'".$creau."'";}
    //following are not required so we can directly take them as it is
    
    $purpose=validateFormData($_POST["purpose"]);
    $purpose = "'".$purpose."'";	
	$fdc=validateFormData($_POST["fdc"]);
        $fdc = "'".$fdc."'";
    


    //checking if there was an error or not
  $query = "SELECT Fac_ID from facultydetails where Email='".$_SESSION['loggedInEmail']."';";
        $result=mysqli_query($conn,$query);
       if($result){
            $row = mysqli_fetch_assoc($result);
            $author = $row['Fac_ID'];
	   }
				$succ = 0;
				$success1 = 0;

	$sql = "update online_course_attended set Course_Name = $courseName,
							   Date_from = $startDate,
							   Date_to = $endDate, 
							   Organised_by = $organised,
							   Purpose =$purpose,
							   type_of_course=$type,
							   status_of_activity=$status,
							   duration=$duration,
							   credit_audit=$creau,
							   FDC_Y_N=$fdc
							   WHERE OC_A_ID = $id";

			if ($conn->query($sql) === TRUE) 
			{
				$success = 1;	
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			if($success ==1 )
			{
					if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
					{
					   header("location:2_dashboard_hod_online_attended.php?alert=update");

					}
					else
					{
						header("location:2_dashboard_online_attended.php?alert=update");

					}
			}
			else 
			   header("location:2_dashboard_online_attended.php");
}

//close the connection
mysqli_close($conn);
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
<div class="content-wrapper">    
    <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Online Course Attended</h3>
                </div><!-- /.box-header -->
				<div style="text-align:right">
				<a href="menu.php?menu=5 "> <u>Back to Online Course Attended Activities Menu</u></a>
				</div>
                <!-- form start -->
            <form role="form" method="POST" class="row" action ="" style= "margin:10px;" >
                <div class="form-group col-md-6">
                    <label for="type">Type Of Course*</label>
                    <select required class="form-control input-lg" value='<?php echo $type_of_course; ?>' id="type" name="type">
                        <option <?php if($type_of_course == "online") echo "selected = 'selected'" ?> value = "online">Online</option>
                        <option <?php if($type_of_course == "offline") echo "selected = 'selected'" ?> value = "offline">Offline</option>
                    </select>
                </div>

                    <input type = 'hidden' name ='id' value = '<?php echo $id; ?>'>
                     <div class="form-group col-md-6">
                         <label for="courseName">Name of course *</label>
                      <!--   <input required type="text" class="form-control input-lg" id="paper-title" name="course[]">-->
                      <input  type="text" class="form-control input-lg" id="courseName" value='<?php echo $courseName; ?>'  name="courseName">
                     </div>

                     <div class="form-group col-md-6">
                         <label for="start-date">Start Date *</label>
                         <input required type="date" class="form-control input-lg" value='<?php echo $startDate; ?>' id="start-date" name="startDate"
                         placeholder="03:10:10">
                     </div>

                    <div class="form-group col-md-6">
                         <label for="end-date">End Date *</label>
                         <input required type="date" class="form-control input-lg" <?php echo "value= '$endDate'"; ?> id="end-date" name="endDate"
                         placeholder="03:10:10">
                     </div>

                    <div class="form-group col-md-6">
                         <label for="organised">Course organised by *</label>
                         <input required type="text" class="form-control input-lg" value='<?php echo $organised; ?>' id="organised" name="organised">
                     </div>

                     <div class="form-group col-md-6">
                         <label for="purpose">Purpose of Course * </label>
                         <textarea  required class="form-control input-lg"  id="purpose" name="purpose" rows="2" value="$row"><?php echo $purpose; ?></textarea>
                     </div>
                     
                     <div class="form-group col-md-6">
                         <label for="fdc">Applied for FDC ? *</label>
                         <select required class="form-control input-lg" id="fdc" value='<?php echo $fdc; ?>' name="fdc">

                             <option <?php if($fdc == "yes") echo "selected = 'selected'" ?> value = "yes">Yes</option>
                             <option <?php if($fdc == "no") echo "selected = 'selected'" ?> value = "no">No</option>
                         </select>
                     </div>

                <div class="form-group col-md-6">
                    <label for="status">Status Of Activity *</label>
                    <select required class="form-control input-lg" id="status" value='<?php echo $status_of_activity; ?>' name="status">
                        <option <?php if($status_of_activity == "local") echo "selected = 'selected'" ?> value = "local">Local</option>
                        <option <?php if($status_of_activity == "state") echo "selected = 'selected'" ?> value = "state">State</option>
                        <option <?php if($status_of_activity == "national") echo "selected = 'selected'" ?> value="national">National</option>
                        <option <?php if($status_of_activity == "international") echo "selected = 'selected'" ?> value="international">International</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="duration">Enter the durationof the course in hrs/week</label>
                    <input required type="text" class="form-control input-lg" value='<?php echo $duration;?>' id="duration" name="duration">
                </div>
                <div class="form-group col-md-6">
                    <label for="creau">Credit/Audit *</label>
                    <select required class="form-control input-lg" id="creau" value='<?php echo $credit_audit; ?>' name="creau">
                        <option <?php if($credit_audit == "credit") echo "selected = 'selected'" ?> value = "credit">Credit</option>
                        <option <?php if($credit_audit == "audit") echo "selected = 'selected'" ?> value = "audit">Audit</option>
                    </select>
                </div>
                    <br/>
                    <div class="form-group col-md-12">
                         <a href="2_dashboard_online_attended.php" type="button" class="btn btn-warning btn-lg">Cancel</a>

                         <button name="update"  type="submit" class="btn btn-success pull-right btn-lg">Submit</button>
                    </div>
                </form>
                </div>
              </div>
           </div>      
        </section>
</div>
<?php include_once('footer.php'); ?>