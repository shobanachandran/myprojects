<?php 
include('includes/config.php');
if($_SESSION['userid']!=''){
	echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP Software">
    <meta name="author" content="IOrange Innovation">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?php echo SITE_TITLE;?> - Login Page</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<style>
	/* Define the CSS class to set the background image */
/* Define the CSS class to set the background image */
.bg-image {
    background-image: url('dist/images/bg/bg2.jpg'); /* Set the background image */
    background-repeat: no-repeat;
   
    background-size: 100% 100%; /* Cover the entire column */
    padding: 0; /* Remove any padding or margins */
}


	</style>
</head>

<body >   
<div class="container-fluid" >
    <div class="row">
        <!-- Column for Background Image -->
          <div class="col-md-6 bg-image" >
        </div>
        <!-- Column for Login Details -->
        <div class="col-md-6" style="margin-top:200px;margin-bottom:200px" >
            <div class="card" style="border-radius: 25px;" >
                <form name="loginForm" id="loginForm" action="" method="post">
                    <div class="card-body" style="text-align: center;">
                        <img src="" height="70" style="padding: 10px;">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" id="usrname" name="usrname" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" required class="form-control" id="usrpwd" name="usrpwd" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="action" id="action" value="userlogin" />
                        <button type="submit" class="btn btn-primary" style="margin-left: 160px;">Submit</button>
                        <br><br>
                        <!-- <p style="margin-left: 100px;">Forgot Password &nbsp;&nbsp;&nbsp;<a href="#" style="color: red; text-decoration: underline;">Click Here</a></p> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            <!-- footer -->
   			<!--?php include('includes/footer.php');?-->
            <!-- End footer -->
  
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>

<script>
 $("form#loginForm").submit(function(e) {
	e.preventDefault();    
		var formData = new FormData(this);
		if($('#usrname').val()==''){
			alert("Please enter Username");
			$('#usrname').focus();
			return false;
		}
		if($('#usrpwd').val()==''){
			alert("Please enter Password");
			$('#usrpwd').focus();
			return false;
		}
		$.ajax({
			url: "ajax/users.php",
			type: 'POST',
			data: formData,
			success: function (data) {
				alert(data);
				if($.trim(data)==true){
					 window.location="index.php";
				}
				if($.trim(data)=="error"){
					alert("Invalid Username and Password");
					document.getElementById("userInfo").reset();
					$('.loader').hide();
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});

</script>	
</body>
</html>
