<?php 
ob_start();
  session_start();
  if(!isset($_SESSION['loggedInUser'])){
    //send the iser to login page
    header("location:index.php");
}
  include_once('head.php'); 
 include_once('header.php'); 
  
  if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
  {
	    include_once('sidebar_hod.php');

  }
  else
	  include_once('sidebar.php');
  
  /*$_SESSION["Username"] = 'test';
  $user = $_SESSION["Username"];
  echo $user;*/
  
 

?>
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
                  <h3 class="box-title">Please Select Following Forms for providing activity details</h3>
                  <h4 class=""><strong>(Please find related submenu for each category at the left sidebar)</strong></h4>

                </div><!-- /.box-header -->
                <!-- form start -->
				<?php //echo $_SESSION['username'];?>
                <form role="form" action="" method="POST">
                  

                  <div class="box-body">
				  <div class="form-group col-md-6">
                    <button type="submit" name="paper" id="submit" value="" class="btn btn-warning btn-lg">Paper Publication</button>
                  </div>
				  <div class="form-group col-md-6">

					<button type="submit" name="techpaper" id="submit" value="" class="btn btn-warning btn-lg">Technical Papers Reviewed</button>
                  </div>
				  <div class="form-group col-md-6">
				    <button type="submit" name="sttp" id="submit" value="" class="btn btn-warning btn-lg">STTP/Workshop/FDP Attended/Organised </button>
					</div>
					<div class="form-group col-md-6">
				  <button type="submit" name="online" id="submit" value="" class="btn btn-warning btn-lg">Online Course Completed/Organised</button>
					</div>  
					<div class="form-group col-md-6">					
				  <button type="submit" name="guest" id="submit" value="" class="btn btn-warning btn-lg">Invited for/Organised Guest Lecture</button>
					</div>
					<div class="form-group col-md-6">
			<button type="submit" name="iv" id="submit" value="" class="btn btn-warning btn-lg">Industrial Visit Attended/Organised</button>
                  </div>
				  <div class="form-group col-md-6">
				  <button type="submit" name="co" id="submit" value="" class="btn btn-warning btn-lg">Co-curricular Activity</button>
                   </div>
				   <div class="form-group col-md-6">
				   <button type="submit" name="ex" id="submit" value="" class="btn btn-warning btn-lg">Extra-curricular Activity</button>
					</div>
				</div>	
                  </div>
				  <?php
				  $username = $_SESSION['username'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					 if(isset($_POST['paper']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:2_dashboard_hod.php");

						}
						else
							header("location:actcount.php");
						
					  }
					 if(isset($_POST['techpaper']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:2_dashboard_hod_review.php");

						}
						else
							header("location:actcount_review.php");
						
					  }
					if(isset($_POST['sttp']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:2_dashboard_attend_hod.php");

						}
						else
							header("location:actcount_attend.php");
						
					  }
					  if(isset($_POST['online']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							$_SESSION['currentTab']="Online";
							header("location:menu.php?menu=5");

						}
						else
							$_SESSION['currentTab']="Online";
							/* MY CHANGE */
							header("location:menu.php?menu=5");
						
					  }
					   if(isset($_POST['guest']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:view_invited_hod_lec.php");

						}
						else
							header("location:guestlec.php");
						
					  }
						if(isset($_POST['iv']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:IV.php?x=IV/select_menu/edit_menu.php");

						}
						else
							header("location:IV.php?x=IV/select_menu/addcount.php");
						
					  }
					if(isset($_POST['co']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:2_dashboard_hod_cocurricular.php");

						}
						else
							header("location:actcount_cocurricular.php");
						
					  }
					  if(isset($_POST['ex']))
					  {
						if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu' )
						{
							header("location:2_dashboard_hod_excurricular.php");

						}
						else
							header("location:actcount_excurricular.php");
						
					  }
						 
					if(isset($_POST['cancel']))
					  {
						  if($username == 'hodextc@somaiya.edu')
						{
							header("location:2_dashboard_hod.php");

						}
						else
							header("location:2_dashboard.php");
						
					  }
					}
					?>
                </form>
                
                </div>
              </div>
           </div>      
        </section>               
  </div><!-- /.content-wrapper -->        






    
    
<?php include_once('footer.php'); ?>
   
   
