<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
</head>
<body>

<style type="text/css">
	  #text-center
                    {
                        height: 100px;
                        width: auto;
                        margin-bottom: 20px;
                    }
        #text-center input[type='text']
                    {
                        height: 50px;
                    }
        #text-center input[placeholder]{padding: 20px ;}
        #text-center button{height: 52px;}
        .error{color:red;}
        .row
            {
                margin-left: 0px;
            }
            .column{margin:3px; border: 2px solid black;}
           .footer{margin-top: 50px;}

</style>
<?php
include("../init.php");
include_once("../../templates/header.php")
?>
<div class="kt mt-5"></div>
<div class="kt mt-5">controls
<div>

<div class="container">
	<h1 class="mt-5"></h1>
	<form action="" method="POST">
	<div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search by your product name, brand or description" id="search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-info" id="search-btn" name="submit">Search <i class="fa fa-search"></i></button></span>
                        </div>
                </div>
    </form>
  <!-- search implementation -->
 <?php
if (isset($_POST['submit'])) 
{
	echo '<style type="text/css">
		#container{display: none;}
	</style>';
	$search=$_POST['search'];
	$message='';
	$query1="select p.name as product_name,p.images as image,o.id,r.selling_price,o.item_id from products p inner join orders o on o.product_id=p.id inner join ready_sale r on o.item_id=r.id where o.receipt_status='awaiting' and o.supplier_id='97' and p.name like '%$search%'";
	$result1=mysqli_query($conn,$query1);
	if (!$result1) {
	$message="query could not be executed".mysqli_error($conn);
}
else{
	
	if (mysqli_num_rows($result1)>0) {
		echo "<div class='row'>";
		?>
		<?php
		while ($row=mysqli_fetch_assoc($result1)) {
			$image=$row['image'];
			$src="../../upload/".$image;
			?>
			<!-- <div class="card"> -->
				<div class="col-md-3 sm-3 card">
					<div class="product">
					<img src="<?php echo $src;?>" width="200 px" height="200 px" class="img-responsive">
					<div class="product-item"><?php echo $row['product_name'];?></div>
					<div class="product-item"><?php echo "KSH"." ".$row['selling_price']?></div>
					<div class="product-item"><form action="" method="POST"><input type="submit" name="generate" id="generate" value="accept payment" class="btn btn-danger"><input type="hidden" id="gen" name="gen" value="<?php echo $row['id'];?>" ></form></div></div>
				</div>
		<!-- 	</div> -->
			<?php
		}
	echo "</div>";	

	}

	else{
		$message="<center><div class='alert alert-warning'>no product was found</div></center>";
	}
}echo $message;}

?>

 <!-- end of search -->
<div class="container" id="container">
<center><h1 class="mt-5 alert alert-success">view orders</h1></center>
<?php 
$message='';
$query="select p.name as product_name,p.images as image,o.id,r.selling_price,o.item_id from products p inner join orders o on o.product_id=p.id inner join ready_sale r on o.item_id=r.id where o.receipt_status='awaiting' and o.supplier_id=$user_id";
$result=mysqli_query($conn,$query);
if (!$result) {
	$message="query could not be executed".mysqli_error($conn);
}
else{
	if (mysqli_num_rows($result)>0) {
		echo '<div class="row" id="container">';
		?>
		<?php
		while ($row=mysqli_fetch_assoc($result)) {
			$image=$row['image'];
			$src="../../upload/".$image;
			?>
			<!-- <div class="card"> -->
				<div class="col-md-3 sm-3 card">
					<div class="product">
					<img src="<?php echo $src;?>" width="200 px" height="200 px" class="img-responsive">
					<div class="product-item"><?php echo $row['product_name'];?></div>
					<div class="product-item"><?php echo "KSH"." ".$row['selling_price']?></div>
					<div class="product-item"><form action="" method="POST"><input type="submit" name="generate" id="generate" value="accept payment" class="btn btn-danger"><input type="hidden" id="gen" name="gen" value="<?php echo $row['id'];?>" ></form></div></div>
				</div>
		<!-- 	</div> -->
			<?php
		}
		
echo "</div>";
	}
	else{
		$message="<p style='margin-left: 30px;''>no records found</p>";
	
	}
}
echo $message;
?>
</div>
</div>
<?php
$state="";
if(isset($_POST['generate']))
							{
								$status=$_POST["gen"];
								$query2="update orders set receipt_status='accepted' where id='$status'";
								$result=mysqli_query($conn,$query2);
								if (!$result) {
									$state="<div class='alert alert-danger'>could not execute request at this time try again later</div>";
								}
								else
									{
										$check="select receipt_status from orders where id=$status";
										$rcheck=mysqli_query($conn,$check);
										if (mysqli_num_rows($rcheck)>0) {
										$num=mysqli_fetch_assoc($rcheck);
										$chkresult=$num['receipt_status'];
													if ($chkresult=='accepted') {
														#code
									}
							}}}
							echo $state;
?>
<!-- the already accepted orders awaiting payment-->
<div class="mt-5">
<div class="container" id="container">
<center><h1 class="alert alert-success">Good accepted</h1></center>
<?php 
$message='';
$query="select p.name as product_name,p.images as image,o.id,r.selling_price,o.item_id from products p inner join orders o on o.product_id=p.id inner join ready_sale r on o.item_id=r.id where o.receipt_status='accepted' and o.supplier_id='$user_id'";
$result=mysqli_query($conn,$query);
if (!$result) {
	$message="query could not be executed".mysqli_error($conn);
}
else{
	if (mysqli_num_rows($result)>0) {
		echo '<div class="row">';
		?>
		<?php
		while ($row=mysqli_fetch_assoc($result)) {
			$image=$row['image'];
			$src="../../upload/".$image;
			?>
			<!-- <div class="card"> -->
				<div class="col-md-3 sm-3 card">
					<div class="product">
					<img src="<?php echo $src;?>" width="200 px" height="200 px" class="img-responsive">
					<div class="product-item"><?php echo $row['product_name'];?></div>
					<div class="product-item"><?php echo "KSH"." ".$row['selling_price']?></div>
					<div class="product-item"><form action="" method="POST"><input type="submit" name="generate" id="generate" value="remove" class="btn btn-danger"><input type="hidden" id="gen" name="gen" value="<?php echo $row['id'];?>" ></form></div></div>
				</div>
		<!-- 	</div> -->
			<?php
		}
		
echo "</div>";
	}
	else{$message="could not find all records";}
}
echo $message;
?>
</div>
</div>

<script type="text/javascript">
document.getElementById("generate").onclick=clickHello;
function clickHello(){
	window.location.reload(true);
}
</script>
<div class="mt-5"></div>
<div class="mt-5"></div>
<div class="footer">
<?php include("../../templates/footer.php");?>
</div>
</body>
</html>
