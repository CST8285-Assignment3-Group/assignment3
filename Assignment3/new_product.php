

<!DOCTYPE html>

<head>
    <title>Insert Product</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<?php

include "DAO.php";
//connection to the database
$connection=get_connection();

	
if(isset($_POST['code'])){
	if(save_product($connection, $_POST['code'], $_POST['name'],$_POST['price'],$_POST['category'])){
		echo '<h1>Product sucsessfully saved</h1>';
		echo '<a class="link" href="new_product.php">Create new product</a>';
	}
	
}
//form for adding a product
else{
$categories=get_product_categories($connection);
echo'<h1>Create product:</h1>';
echo '<form method="POST" action="new_product.php">
<div class="input"><label>Code</label><input type="text" name="code"></div>
<div class ="input"><label>Name</label><input type="text" name="name"></div>
<div class ="input"><label>Price</label><input type="text" name="price"></div>';

echo'<div class ="input"><label>Category</label><select name="category">';
while($row = $categories ->fetch_assoc()){
       echo '<option value='.$row['id'].'>'.$row['category_name'].'</option>';
	}
echo'</select></div>';
echo '<div class ="input"><input type="Submit" value="Save data"></div>';
echo '</form>';
}
echo '<a class="link" href="index.php">Product list</a>';


?>
</body>
</html>