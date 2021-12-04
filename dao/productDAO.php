<?php
require_once('./abstractDAO.php');
require_once('../model/product.php');

class makeupDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    public function getMakeups(){

        $result = $this->mysqli->query('SELECT * FROM products');
        $makeups = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
           
                $employee = new Employee($row['productId'], $row['productName'], $row['productPrice'], $row['inStock']);
                $makeups[] = $product;
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
            $makeup = new Makeup($temp['productId'], $temp['productName'],  $temp['productPrice'], $temp['inStock']);
            $result->free();
            return $makeup;
        }
        $result->free();
        return false;
    }

    public function addMakeup($makeup){
        if(!is_numeric($makeup->getMakeupId())){
            return 'MakeupId must be a number.';
        }
        if(!$this->mysqli->connect_errno){
        
            $query = 'INSERT INTO makeups VALUES (?,?,?,?)';
        
            $stmt = $this->mysqli->prepare($query);
        
            $stmt->bind_param('iss', 
                    $employee->getProductId(), 
                    $employee->getProductName(), 
                    $employee->getProductPrice()
                    $employee->getInStock());
      // there's an error here
            $stmt->execute();
            
            if($stmt->error){
                return $stmt->error;
            } else {
                return $employee->getProductName() . ' ' . $employee->ProductPrice() . ' added successfully, not bad!';
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
    
    public function editMakeup($productId, $productName, $productPrice, $inStock){
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
