<?php 
ob_start();
  session_start();
  if(!isset($_SESSION['loggedInUser'])){
    //send the iser to login page
    header("location:index.php");
}
 $_SESSION['active'] = 1;
  $_SESSION['actcount'] = 1;


  include_once('head.php'); 
 include_once('header.php'); 
  $_SESSION['currentTab']="Online";
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
                  <h3 class="box-title">Form for applying activities </h3>
				
                </div><!-- /.box-header -->
				<div style="text-align:right">
				<a href="menu.php?menu=1 " style="text-align:right"> <u>Back to Paper Publication/Presentation Menu</u></a> 
                </div>
                <!-- form start -->
				<?php //echo $_SESSION['username'];?>
                <form role="form" action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                    <label for="activity">Number of papers to be entered</label>
                    <input type="number" id="count" name="count"/>
                    </div>
					
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="submit_count" id="submit" value="" class="btn btn-primary">Log Activity!</button>
                    <button type="submit" name="cancel" id="cancel" value="" class="btn btn-primary">Cancel</button>


                  </div>
				  <?php
				  $username = $_SESSION['username'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					 if(isset($_POST['submit_count']))
					  {
						$count = $_REQUEST["count"];
					  }
					  else{
					  $count = 0;
					  }
					$_SESSION['count'] = $count;
					if($count <=0 )
					{
						$result="Don't enter zero or negative value<br>";
						echo '<div class="error">'.$result.'</div>';

					}
					else{
					if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu')
					{
						header("location:1_add_paper_multiple_hod.php?alert=success");

					}
					else
						header("location:1_add_paper_multiple.php?alert=success");
					}
					}
						 
					if(isset($_POST['cancel']))
					  {
					if($_SESSION['username'] == 'hodextc@somaiya.edu' || $_SESSION['username'] == 'member@somaiya.edu' || $_SESSION['username'] == 'hodcomp@somaiya.edu')
						{
							header("location:2_dashboard_hod.php");

						}
						else
							header("location:2_dashboard.php");
						
					  }
						
					?>
                </form>
                
                </div>
              </div>
           </div>      
        </section>               
  </div><!-- /.content-wrapper -->        






    
    
<?php include_once('footer.php'); ?>

   
   
