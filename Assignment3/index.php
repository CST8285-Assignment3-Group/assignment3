<!DOCTYPE html>

<head>
    <title>Catalog</title>
	<link href="styles.css" rel="stylesheet">
</head>
<body>
<h3>Product list:</h3>
<div class='main'>
<?php

include "DAO.php";
//connection to the database
$connection=get_connection();

$categories=get_product_categories($connection);
$current_category='';
if(isset($_GET['category'])){
	$current_category=$_GET['category'];	
}

$i=0;
echo'<div>
<h3>Categories</h3>
<ul>';
//list of categories
while($row = $categories ->fetch_assoc()){
	if($i==0 and $current_category==''){
		$current_category=$row['category_name'];
		$i++;
	}
       echo '<li><a href="?category='.$row['category_name'].'">'.$row['category_name'].'</a></li>' ;
	}
echo'</ul></div>';
echo'<div>';
echo'<h3>'.$current_category.'</h3>';
echo '<table>';
  echo '<tr><td>code</td><td>name</td><td>price</td></tr>' ;
 //list of products and display it in a loop
$products=get_products($connection, $current_category);
while($row = $products ->fetch_assoc()){
       echo '<tr><td>'.$row['product_code'].'</td><td>'.$row['product_name'].'</td><td>'.$row['product_price'].'</td></tr>' ;
	}
echo '</table>';
echo '<a class="link" href ="new_product.php">Create product</a>';
echo'</div>';


?>
</div>
