<?php
//session_start();
include("../config/database.php");
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="../public/js/script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/js/bootstrap.min.js">
    <link rel="stylesheet" href="../public/css/main.css">
    <title>forgot password</title>


    <style>
    	.error{color: red;}
        .login-form {
        width: 340px;
        margin: 30px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .login-form .hint-text {
        color: #777;
        padding-bottom: 15px;
        text-align: center;
    }
    /*.form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }*/
    .login-btn {        
        font-size: 15px;
        font-weight: bold;
    }
    .or-seperator {
        margin: 20px 0 10px;
        text-align: center;
        border-top: 1px solid #ccc;
    }
    .or-seperator i {
        padding: 0 10px;
        background: #f7f7f7;
        position: relative;
        top: -11px;
        z-index: 1;
    }
    .social-btn .btn {
        margin: 10px 0;
        font-size: 15px;
        text-align: left; 
        line-height: 24px;       
    }
    .social-btn .btn i {
        float: left;
        margin: 4px 15px  0 5px;
        min-width: 15px;
    }
    .input-group-addon .fa{
        font-size: 18px;
    }</style>
</head>
<body>
<?php
		$message="";
		$change="select username from users where id='98'";
		$query=mysqli_query($conn,$change);
		if ($query) {
			$message="connection successful";
		}
		else
			{
				$message="connection failed";
			}
	//echo $message;
// check if button is set
if (isset($_POST['submit'])) {
								$messageerr=$passworderr="";
								$usernameerr="";
								$password=$_POST["password1"];
								$username=$_POST['password'];
								$change="select * from users where username='$username'";
								$query=mysqli_query($conn,$change);
									if (!$query){
													$usernameerr="username was not found";
												}
									else {
											if (mysqli_num_rows($query)>0) {
															$row=mysqli_fetch_assoc($query);
															$check=$row['username'];
															$hashe=password_hash($password, PASSWORD_DEFAULT);
															$update="update users set password='$hashe' where username='$username'";
															$result=mysqli_query($conn,$update);
															if ($result) {
																			$messageerr="password was changed successfully";
																		}
															else
																		{
																			$messageerr="could not change password";
																		}
																			}
												else
													{
													 $usernameerr ="that username does not exist";
													}
								}
	}
// echo $messageerr;
					
	?>
<div class="login-form">
    <form action="" method="POST">
		<div class="container"> 
        <h2 class="text-center">PASSWORD RESET</h2>   
        <div class="form-group">
        <label for="username">username</label>
		<input type="text" name="password" class="form-control" value="<?php echo $username?>">
		<span class="error"><?php echo $usernameerr?></span>	
        </div>
		<div class="form-group">
		<label for="newpassword">password</label><br>
		<input type="password" name="password1" value="<?php echo $password;?>" class="form-control">
		<span class="error"><?php echo $passworderr?></span>    
        </div>   
        <div class="row"> 
        <div class="col-md-4">
        	<input type="submit" class="btn btn-outline-info" value="change" name="submit">
        </div>
        <div class="col-md-4">
        	<input type="submit" class="btn btn-outline-info" value="click" name="submit">
        </div>
    </div>
    </div>
    </form>
    <div class="clearfix">
			<span class="error"><?php echo $messageerr?></span>;
           
        </div>
   </div>
</body>
</html>   




