<?php require_once('./dao/productDAO.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Week 11 Demo App</title>
    </head>
    <body>
        <h1> The Makeup Shop's Inventory</h1>
        <?php
        try{
            $productDAO = new productDAO();
            //Tracks errors with the form fields
            $hasError = false;
            //Array for our error messages
            $errorMessages = Array();

        
            if(isset($_POST['productId']) ||
                isset($_POST['productName']) || 
		isset($_POST['productPrice']) ||
                isset($_POST['inStock'])){
            
                if(!is_numeric($_POST['productId']) || $_POST['productId'] == ""){
                    $hasError = true;
                    $errorMessages['productIdError'] = 'Please enter the numeric Product ID.';
                }

                if($_POST['productName'] == ""){
                    $errorMessages['productNameError'] = "Please enter the product name.";
                    $hasError = true;
                }

                if($_POST['productPrice'] == ""){
                    $errorMessages['productPriceError'] = "Please enter the product price.";
                    $hasError = true;
                }

		if($_POST['inStock'] == ""){
                    $errorMessages['productPriceError'] = "Please select if the product is in stock.";
                    $hasError = true;
                }

                if(!$hasError){
                    $product = new Product($_POST['productId'], $_POST['productName'], $_POST['productPrice'], $_POST['inStock']);
                    $addSuccess = $productDAO->addProduct($product);
                    echo '<h3>' . $addSuccess . '</h3>';
                }
            }  

            if(isset($_GET['deleted'])){
                if($_GET['deleted'] == true){
                    echo '<h3>Product Deleted</h3>';
                }
            }
            
            
        ?>
        <form name="addProduct" method="post" action="index.php">
        <table>
            <tr>
                <td>Product ID:</td>
                <td><input type="text" name="productId" id="productId">
                <?php 
                //If there was an error with the productId field, display the message
                if(isset($errorMessages['productIdError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['productIdError'] . '</span>';
                      }
                ?></td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td><input name="productName" type="text" id="productName">
                <?php 
                //If there was an error with the productName field, display the message
                if(isset($errorMessages['productNameError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['productNameError'] . '</span>';
                      }
                ?>
                </td>
            </tr>
            <tr>
                <td>Product Price:</td>
                <td><input type="text" name="productPrice" id="productPrice">
                <?php 
                //If there was an error with the productPrice field, display the message
                if(isset($errorMessages['productPriceError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['productPriceError'] . '</span>';
                      }
                ?>
                </td>
            </tr>
            <tr>
                <td>In Stock?</td>
                <td><input type="text" name="inStock" id="inStock">
                <?php 
                //If there was an error with the inStock field, display the message
                if(isset($errorMessages['inStockError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['inStockError'] . '</span>';
                      }
                ?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Add Product"></td>
                <td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>
            </tr>
        </table>
            
        <?php

        $products = $productDAO->getProducts();
            if($products){
                echo '<table border=\'1\'>';
                echo '<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>In Stock</th></tr>';
                foreach($products as $product){
                    echo '<tr>';
                    echo '<td><a href=\'edit_product.php?productId='. $product->getProductId() . '\'>' . $product->getProductId() . '</a></td>';
                    echo '<td>' . $product->getProductName() . '</td>';
                    echo '<td>' . $product->getProductPrice() . '</td>';
		    echo '<td>' . $product->getInStock() . '</td>';
                    echo '</tr>';
                }
            }
        
        }catch(Exception $e){
            echo '<h3>Error on page.</h3>';
            echo '<p>' . $e->getMessage() . '</p>';            
        }
        ?>
        </form>
    </body>
</html>
