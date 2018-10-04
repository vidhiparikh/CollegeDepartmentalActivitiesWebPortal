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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Activity Menu</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
                  

                  <div class="box-body">
              
                  </div>
				  <?php
				  $username = $_SESSION['username'];
				  $menu = 0;
				  $menu = $_GET['menu'];
				  
					if($_GET['menu'] != 0){
					
						switch ($menu) {
							
						case 1:
						  if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Paper Publication</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li class=""><a href="actcount.php"><i class="fa fa-circle-o"></i> Add Paper</a></li>
										<li><a href="2_dashboard_hod.php"><i class="fa fa-circle-o"></i> View/Edit Activity</a></li>
										<li><a href="5_fdc_dashboard_attend_hod.php"><i class="fa fa-circle-o"></i> FDC details</a></li>
										<li><a href="count_all.php"><i class="fa fa-circle-o"></i> Analysis</a></li>
									  </ul>
									</li>
						<?php  }
						  else
						  {
						
						?>
						
						

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Paper Publication</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li class=""><a href="actcount.php"><i class="fa fa-circle-o"></i> Add Paper</a></li>
										<li><a href="2_dashboard.php"><i class="fa fa-circle-o"></i> View/Edit Activity</a></li>
										<li><a href="5_fdc_dashboard.php"><i class="fa fa-circle-o"></i> FDC details</a></li>
										<li><a href="count_your.php"><i class="fa fa-circle-o"></i> Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						  }
						break;
						case 2:
						 if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							 <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Technical Papers Reviewed</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										 <li><a href="actcount_review.php"><i class="fa fa-circle-o"></i> Add Paper</a></li>
											 <li><a href="2_dashboard_hod_review.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>

										<li><a href="count_all_review.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li> 
					<?php	  }
						  else
						  {
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Technical Papers Reviewed</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li><a href="actcount_review.php"><i class="fa fa-circle-o"></i> Add Paper Reviewed details</a></li>
										<li><a href="2_dashboard_review.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>

										<li><a href="count_your_review.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						  }
						break;
						case 3:
						
						 if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {$_SESSION['currentTab']="Online";?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>STTP/Workshop/FDP Attended/Organised</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li class=""><a href="actcount_attend.php"><i class="fa fa-circle-o"></i>Add Activity attended</a></li>
												<li class=""><a href="actcount_organised.php"><i class="fa fa-circle-o"></i>Add Activity organised</a></li>

												<li><a href="2_dashboard_attend_hod.php"><i class="fa fa-circle-o"></i>View/Edit Activity attended</a></li>
												<li><a href="2_dashboard_organised_hod.php"><i class="fa fa-circle-o"></i>View/Edit Activity organised</a></li>

												<li><a href="5_fdc_dashboard_attend_hod.php"><i class="fa fa-circle-o"></i>FDC details</a></li>

										<li><a href="count_all_attend.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
					<?php	  }
						  else
						  {
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>STTP/Workshop/FDP Attended/Organised</strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li class=""><a href="actcount_attend.php"><i class="fa fa-circle-o"></i>Add Activity attended</a></li>
											<li class=""><a href="actcount_organised.php"><i class="fa fa-circle-o"></i>Add Activity organised</a></li>

											<li><a href="2_dashboard_attend.php"><i class="fa fa-circle-o"></i>View/Edit Activity attended</a></li>
											<li><a href="2_dashboard_organised.php"><i class="fa fa-circle-o"></i>View/Edit Activity organised</a></li>

											<li><a href="5_fdc_dashboard_attend.php"><i class="fa fa-circle-o"></i>FDC details</a></li>

										<li><a href="count_your_attend.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						  }
						break;
						case 4:
						if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Invited for/Organised Guest Lecture </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li><a href="guestlec.php"><i class="fa fa-circle-o"></i>Invited for Guest Lecture</a></li>
										<li><a href="orglec.php"><i class="fa fa-circle-o"></i>Guest Lecture Organised</a></li>
										<li><a href="view_invited_hod_lec.php"><i class="fa fa-circle-o"></i>View/Edit Invited</a></li>
										<li><a href="view_organised_hod_lec.php"><i class="fa fa-circle-o"></i>View/Edit Organised</a></li>

										<li><a href="analysis_h_i.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
						<?php   }
						  else
						  {
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Invited for/Organised Guest Lecture </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
										<li><a href="guestlec.php"><i class="fa fa-circle-o"></i>Invited for Guest Lecture</a></li>
										<li><a href="orglec.php"><i class="fa fa-circle-o"></i>Guest Lecture Organised</a></li>
										<li><a href="view_invited_lec.php"><i class="fa fa-circle-o"></i>View/Edit Invited</a></li>
										<li><a href="view_organised_lec.php"><i class="fa fa-circle-o"></i>View/Edit Orgainsed</a></li>

										<li><a href="analysis_i.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						  }
						break;
						case 5:
						if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Online Course </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									<li class=""><a href="actcount_course_attended.php"><i class="fa fa-circle-o"></i>Add Attended Course</a></li>
								  <li class=""><a href="actcount_course_organised.php"><i class="fa fa-circle-o"></i>Add Organised Course</a></li>
								  <li><a href="2_dashboard_hod_online_attended.php"><i class="fa fa-circle-o"></i>View/Edit Activity Attended</a></li>
								  <li><a href="2_dashboard_hod_online_organised.php"><i class="fa fa-circle-o"></i>View/Edit Activity Orgainsed</a></li>
								  <li><a href="5_fdc_dashboard_attend_hod.php"><i class="fa fa-circle-o"></i>FDC details</a></li>
								  <li><a href="count_all_online.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
					<?php	  }
						  else
						  {
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Online Course </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									<li class=""><a href="actcount_course_attended.php"><i class="fa fa-circle-o"></i>Add Attended Course</a></li>
									  <li class=""><a href="actcount_course_organised.php"><i class="fa fa-circle-o"></i>Add Organised Course</a></li>
									  <li><a href="2_dashboard_online_attended.php"><i class="fa fa-circle-o"></i>View/Edit Activity Attended</a></li>
									  <li><a href="2_dashboard_online_organised.php"><i class="fa fa-circle-o"></i>View/Edit Activity Orgainsed</a></li>
									  <li><a href="5_fdc_dashboard.php"><i class="fa fa-circle-o"></i>FDC details</a></li>
									  <li><a href="count_your_online.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						  }
						break;
						case 6:
						if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Co-curricular Activity </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									  <li><a href="actcount_cocurricular.php"><i class="fa fa-circle-o"></i>Add Activity</a></li>
										<li><a href="2_dashboard_hod_cocurricular.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="count_all_cocurricular.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
					<?php	  }
						  else
						  {
							  
						  
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Co-curricular Activity </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									  <li><a href="actcount_cocurricular.php"><i class="fa fa-circle-o"></i>Add Activity</a></li>
										<li><a href="2_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="count_your_cocurricular.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						}
						break;
						case 7:
						if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Extra-curricular Activity  </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									    <li><a href="actcount_excurricular.php"><i class="fa fa-circle-o"></i>Add Activity</a></li>
										<li><a href="2_dashboard_hod_excurricular.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="count_all_excurricular.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
						<?php  }
						  else
						  {
							  
						  
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Extra-curricular Activity </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									   <li><a href="actcount_excurricular.php"><i class="fa fa-circle-o"></i>Add Activity </a></li>
										<li><a href="2_dashboard_excurricular.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="count_your_excurricular.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						}
						break;
						
						case 10:
						if($_SESSION['username'] == ('hodextc@somaiya.edu') || $_SESSION['username'] == ('member@somaiya.edu') || $_SESSION['username'] == ('hodcomp@somaiya.edu') )
						  {?>
							  <li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Industrial Visit Attended/Organised </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									   <li><a href="/extc/IV.php?x=IV/select_menu/addcount.php"><i class="fa fa-circle-o"></i>Add Activity</a></li>
										<li><a href="/extc/IV.php?x=IV/select_menu/edit_menu.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="/extc/IV.php?x=IV/select_menu/view_menu.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
						<?php  }
						  else
						  {
							  
						  
						?>

									<li class="" style="list-style: none; font-size: 14px;">
									 
										<i class="fa " ></i> <span><strong>Industrial Visit Attended/Organised </strong></span> <i class="fa fa-angle-left pull-right"></i>
									
									  <ul class="" style="list-style: none;">
									   <li><a href="/extc/IV.php?x=IV/select_menu/addcount.php"><i class="fa fa-circle-o"></i>Add Activity</a></li>
										<li><a href="/extc/IV.php?x=IV/select_menu/edit_menu.php"><i class="fa fa-circle-o"></i>View/Edit Activity</a></li>
										<!--<li><a href="5_fdc_dashboard_cocurricular.php"><i class="fa fa-circle-o"></i>FDC details</a></li>-->
										<li><a href="/extc/IV.php?x=IV/select_menu/view_menu.php"><i class="fa fa-circle-o"></i>Analysis</a></li>
									  </ul>
									</li>
							
													

						<?php
						}
						break;
						
					}
						
						
						
				   } else {
				   echo "failed";
				   }
					?>
                </form>
                
                </div>
              </div>
           </div>      
        </section>               
  </div><!-- /.content-wrapper -->        






    
    
<?php include_once('footer.php'); ?>
   
   
