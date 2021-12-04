<?php
require_once('./abstractDAO.php');
require_once('../model/product.php');

class productDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    public function getProducts(){

        $result = $this->mysqli->query('SELECT * FROM products');
        $products = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
           
                $product = new Product($row['productId'], $row['productName'], $row['productPrice'], $row['inStock']);
                $products[] = $product;
            }
            $result->free();
            return $products;
        }
        $result->free();
        return false;
    }
    

    public function getProduct($productId){
        $query = 'SELECT * FROM products WHERE productId = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $product = new Product($temp['productId'], $temp['productName'],  $temp['productPrice'], $temp['inStock']);
            $result->free();
            return $product;
        }
        $result->free();
        return false;
    }

    public function addProduct($product){
        if(!is_numeric($product->getProductId())){
            return 'ProductId must be a number.';
        }
        if(!$this->mysqli->connect_errno){
        
            $query = 'INSERT INTO products VALUES (?,?,?,?)';
        
            $stmt = $this->mysqli->prepare($query);
        
            $stmt->bind_param('iss', 
                    $product->getProductId(), 
                    $product->getProductName(), 
                    $product->getProductPrice(),
                    $product->getInStock());
      // there's an error here
            $stmt->execute();
            
            if($stmt->error){
                return $stmt->error;
            } else {
                return $product->getProductName() . ' ' . $product->ProductPrice() . ' added successfully, not bad!';
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    
    public function deleteProduct($productId){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM products WHERE productId = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function editProduct($productId, $productName, $productPrice, $inStock){
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE products SET productName = ?, productPrice = ?, inStock = ? WHERE productId = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssi', $productName, $productPrice, $inStock, $productId);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return $stmt->affected_rows;
            }
        } else {
            return false;
        }
    }
}

?>
