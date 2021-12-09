
<?php

function get_product_categories($connection){

$query = "select * from Catalog_categories";
return $connection->query($query);
}

function get_products($connection, $category){
$query = "select p.product_code, p.product_name, p.product_price from Catalog_products p join  Catalog_categories c on p.category_id=c.id where c.category_name='".$category."'";
return $connection->query($query);
}

function save_product($connection, $code, $name, $price,$category_id){
$query = 'insert into Catalog_products(product_code,product_name,product_price, category_id) values(\''.$code.'\',\''.$name.'\','.$price.','.$category_id.')';
return $connection->query($query);
}

function get_connection(){
	include "connection_settings.php";
	return new mysqli($host, $user, $password, $database);
}
?>