<?php
	class Product{
		private $productId;
		private $productName;
		private $productPrice;
        private $inStock; 
		
		function __construct($productId, $productName, $productPrice, $inStock){
			$this->setProductId($productId);
			$this->setProductName($productName);
			$this->setProductPrice($productPrice);
           	        $this->setInStock($inStock); 
		}
		
		public function getProductId(){
			return $this->productId;
		}
		
		public function setProductId($productId){
			$this->productId = $productId;
		}
		
		public function getProductName(){
			return $this->productName;
		}
		
		public function setProductName($productName){
			$this->productName = $productName;
		}
		
		public function getProductPrice(){
			return $this->productPrice;
		}
		
		public function setProductPrice($productPrice){
			$this->productPrice = $productPrice;
		}

       		public function getInStock(){
			return $this->inStock;
		}
		
		public function setInStock($inStock){
			$this->inStock = $inStock;
		}
		
	}
?>