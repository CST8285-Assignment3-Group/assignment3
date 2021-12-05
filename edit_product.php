<?php
require_once('./dao/productDAO.php');

if(!isset($_GET['productId']) || !is_numeric($_GET['productId'])){
//Send the user back to the main page
header("Location: index.php");
exit;

} else{
    $productDAO = new productDAO();
    $product = $productDAO->getProduct($_GET['productId']);
    if($product){
?>    
        
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Week 11 Demo App - Edit Product - <?php echo $product->getProductName() . ' ' . $product->getProductPrice(). ' ' . $product->getInStock();?></title>
        <script type="text/javascript">
            function confirmDelete(productName){
                return confirm("Do you wish to delete " + productName + "?");
            }
        </script>
    </head>
    <body>
        
        <?php
        if(isset($_GET['recordsUpdated'])){
                if(is_numeric($_GET['recordsUpdated'])){
                    echo '<h3> '. $_GET['recordsUpdated']. ' Product Record Updated.</h3>';
                }
        }
        if(isset($_GET['missingFields'])){
                if($_GET['missingFields']){
                    echo '<h3 style="color:red;'> Please enter product name, price and if it's in stock.</h3>';
                }
        }?>
        <h3>Edit Product</h3>
        <form name="editProduct" method="post" action="process_product.php?action=edit">
            <table>
                <tr>
                    <td>Product ID:</td>
                    <td><input type="hidden" name="productId" id="productId" 
                               value="<?php echo $product->getProductId();?>"><?php echo $product->getProductId();?></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><input type="text" name="productName" id="productName" 
                               value="<?php echo $product->getProductName();?>"></td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td><input type="text" name="productPrice" id="productPrice" 
                               value="<?php echo $product->getProductPrice();?>"></td>
                </tr>
                <tr>
                    <td>Product Price:</td>
                    <td><input type="text" name="inStock" id="inStock" 
                               value="<?php echo $product->getInStock();?>"></td>
                </tr>
                <tr>
                    <td cospan="2"><a onclick="return confirmDelete('<?php echo $product->getProductName() . ' ' . $product->getProductPrice(). ' ' . $product->getInStock();?>')" href="process_product.php?action=delete&productId=<?php echo $product->getProductId();?>">DELETE <?php echo getProductName() . ' ' . $product->getProductPrice(). ' ' . $product->getInStock();?></a></td>
                </tr>
                <tr>
                    <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Update Product"></td>
                    <td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>
                </tr>
            </table>
        </form>
        <h4><a href="index.php">Back to main page</a></h4>
    </body>
</html>
<?php } else{
//Send the user back to the main page
header("Location: index.php");
exit;
}

} ?>