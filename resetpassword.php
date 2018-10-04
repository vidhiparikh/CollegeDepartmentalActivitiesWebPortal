<?php 
ob_start();
session_start();
include_once('head.php');
include('includes/connection.php');
include('includes/functions.php');
$result='';
$flag=0;
$err='';

if(isset($_POST['submit']) )
	{
		$passwd1=$_POST['pass'];
		$passwd2=$_POST['pass2'];
		$email=$_POST['email'];
		
		if($passwd1 == $passwd2)
		{
			$str="0123456789qwertyuiopasdfghjklzxxcvbnm";
			$str=str_shuffle($str);
			$str=substr($str,0,10);
		


		
			$options = array("cost"=>4);
			$hashPassword = password_hash($passwd1,PASSWORD_BCRYPT,$options);
			
			
			$sql1="select Email from facultydetails where Email='$email'";
			
			
				$result1=$conn->query($sql1);
	
				if(($result1->num_rows)==1)
				{
					$sql2="UPDATE facultydetails set Password='$hashPassword' where Email='$email'";
					if(mysqli_query($conn,$sql2))
					{
						header("Location:index.php?alert=success");
					}
				
					else
					{
						header("Location:index.php?alert=error");

					}
				}
				else
				{
							echo "<script> alert('Email does not exist or duplicate entry') </script>";
	
				}
	
				
			
				
			
		}
		else
		{
			echo "<script> alert('Password do not match') </script>";

		}
		
	}
	if(isset($_POST['cancel']) )
	{
		header("Location:index.php");

	}
?>
 
<style>
input{
border-radius:5px;
 
}


input[type='text'] {
  width:300px;
height:30px 
}
input[type='email'] {
  width:300px;
height:30px 
}
input[type='password'] {
  width:300px;
height:30px 
}
.pagedesign{
	font-weight:bold;
	font-size:1.1em;
	margin-top:5px;
	margin-right:5px;
}
.error
{
	color:red;
	border:1px solid red;
	background-color:#ebcbd2;
	border-radius:10px;
	margin:3px;
	padding:5px;
	font-family:Arial, Helvetica, sans-serif;
	width:500px;
}

.noerror
{
	color:green;
	border:1px solid green;
	background-color:#d7edce;
	border-radius:10px;
	margin:3px;
	padding:5px;
	font-family:Arial, Helvetica, sans-serif;
	width:500px;
	height:40px;
}
body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("images/background.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	

}
</style>
<body>
<div class="bg" >
        <section class="content">
          <div class="row" style="width:800px; margin:0 auto; ">
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Reset Password</h3>
				<?php 
			
				?>  
                </div><!-- /.box-header -->
                <div class="box-body">
				<form role="form" action=""  method="post" enctype="multipart/form-data">
				
			Email ID :<br><input type="email" placeholder="Email Here" name="email" ><br><br>

			Enter New Password :<br><input type="password" placeholder="New Password" name="pass" ><br><br>
			Confirm Password :<br><input type="password" placeholder="Confirm Password" name="pass2" ><br><br>
				<div class="box-footer">
                    <input type="submit" value="Reset Password" class="btn btn-primary" name="submit">
					<input type = "submit" class = "btn btn-primary"  value = "Cancel" name = "cancel">

					
                  </div>
                </form>	
                
                
  </div><!-- /.content-wrapper --> 
  </div>
              </div>
             </div>
            </div>
          </section>
		  </div>
		  </body>
		  
		  <?php include_once('footer.php'); ?>
