<?php session_start();
require_once '../init.php';
?>
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
        input[type='text']
                    {
                        margin-left: 120px;
                       
                    }
        #search-btn{margin-right: 120px;}
        #text-center input[placeholder]{padding: 20px ;}
        #text-center button{height: 52px;}
        .error{color:red;}
        .row
            {
                margin-left: 0px;
            }
            .card{margin:3px;}


          
    </style>
<?php include_once("../../templates/header.php")?>
<div class="margins mt-5">mystufff</div>
<center><div class="margins mt-5"></div></center>
<?php 
echo '
    <form action="" method="POST">
        <div class="input-group mb-3 text-center">
                        <input type="text" class="form-control" id="search" name="product" placeholder="Search by your product name, brand or description" id="search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-info" id="search-btn" name="search">Search</button></span>
                        </div>
    </div>
    </form>';
?>
<div class="container text-center">
    <?php
if (isset($_POST['submit'])) {
    echo "<style>#products{display:none;}</style>";
        $search=$_POST["search"];
        $sql = "select p.sku as sku, p.name as product_name, p.description as description, p.images as images, 
        r.id as ready_id, r.fraction as fraction, r.product_id as id, r.selling_price as selling_price, r.quantity as quantity
        from products p 
        inner join ready_sale r on p.id = r.product_id  where p.supplier_id='$user_id' and p.name like '%$search%'
     ";
     $result=mysqli_query($conn,$sql);
     if (mysqli_num_rows($result)>0) 
            {
            echo "<div class='row'>";
            while ($row=mysqli_fetch_assoc($result)) {
            $image=$row["images"];
            $src="../../upload/".$image;
            ?>
            <div class="col-md-3 sm-3 card">
                <div class="products">
                    <img src="<?php echo $src;?>" class="img_responsive" width="200" height="200">
                    <div class="product_item"><?php echo $row['product_name'];?></div>
                    <h3 class="text-danger"> <?php echo "ksh"." ".$row['selling_price'];?></h3>
                    <div class="product_item"><?php echo "fraction:"." ".$row['fraction'];?></div>
                </div>
            </div>
              <?php
             }
              echo '</div>';
         } 

         else{echo "<div class='alert alert-warning'>product was not found</div>";}
     }

?>
</div>

                
<br/>
<!-- display the products that are in the store -->
<div class="container" id="products">
    <h1 class="text-center alert alert-success">prepared products</h1>
<?php

        $sql = "select p.sku as sku, p.name as product_name, p.description as description, p.images as images, 
        r.id as ready_id, r.fraction as fraction, r.product_id as id, r.selling_price as selling_price, r.quantity as quantity
        from products p 
        inner join ready_sale r on p.id = r.product_id where supplier_id='$user_id';
     ";
     $result=mysqli_query($conn,$sql);
     if (mysqli_num_rows($result)>0) {
        echo "<div class='row'>";
         while($row=mysqli_fetch_assoc($result))
         {
            $image=$row["images"];
            $src="../../upload/".$image;
            ?> 
            <div class="col-md-3 sm-3 card">
                <div class="products">
                    <img src="<?php echo $src;?>" class="img_responsive" width="200" height="200">
                    <div class="product_item"><?php echo $row['product_name'];?></div>
                    <div>
                    <h3 class="text-danger"> <?php echo "ksh"." ".$row['selling_price'];?></h3>
                    </div>
                    <div class="product_item"><?php echo "fraction:"." ".$row['fraction'];?></div>
                </div>
            </div>
              <?php
        }
     echo "</div>"; }
// $searcherr="";
//         if(empty($_POST["search"])) {
//             $searcherr="error! cant submit empty value" ;
//           
//             <!-- <div class="error alert alert-warning"><?php echo $searcherr;></div> -->
//            
?>
</div>
<?php include("../../templates/footer.php")?>
</body>
</html>

