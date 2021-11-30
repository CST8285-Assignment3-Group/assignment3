<?php
require_once('./dao/productDAO.php');
if(isset($_GET['action'])){
    if($_GET['action'] == "edit"){
        if(isset($_POST['productId']) && 
                isset($_POST['productName']) && 
		isset($_POST['productPrice']) && 
                isset($_POST['inStock'])){
        
        if(is_numeric($_POST['productId']) &&
                $_POST['productName'] != "" &&
		$_POST['productPrice'] != "" &&
                $_POST['inStock'] != ""){    
               
                $productDAO = new productDAO();
                $result = $productDAO->editProduct($_POST['productId'], 
                        $_POST['productName'],$_POST['productPrice'], $_POST['inStock']);

                if($result > 0){
                    header('Location:edit_product.php?recordsUpdated='.$result.'&productId=' . $_POST['productId']);
                } else {
                    header('Location:edit_product.php?productId=' . $_POST['productId']);
                }
            } else {
                header('Location:edit_product.php?missingFields=true&productId=' . $_POST['productId']);
            }
        } else {
            header('Location:edit_product.php?error=true&productId=' . $_POST['productId']);
        }
    }
    
    if($_GET['action'] == "delete"){
        if(isset($_GET['productId']) && is_numeric($_GET['productId'])){
            $productDAO = new productDAO();
            $success = $productDAO->deleteProduct($_GET['productId']);
            echo $success;
            if($success){
                header('Location:index.php?deleted=true');
            } else {
                header('Location:index.php?deleted=false');
            }
        }
    }
}
?>
