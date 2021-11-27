CREATE DATABASE assignment3;
GRANT USAGE ON *.* TO assignment3@localhost IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON assignment3.* TO assignment3@localhost;
FLUSH PRIVILEGES;

USE assignment3;

CREATE TABLE Face_products (
ProductID int NOT NULL,
ProductName varchar(50) NOT NULL,
ProductPrice float(6) NOT NULL,
InStock boolean,
constraint product_id_pk Primary key (ProductID)
);

Create table Eye_products (
ProductID int NOT NULL,
ProductName varchar(50) NOT NULL,
ProductPrice float(6) NOT NULL,
InStock boolean,
constraint product_id_pk2 Primary key (ProductID)
);

Create table Lip_products (
ProductID int NOT NULL,
ProductName varchar(50) NOT NULL,
ProductPrice float(6) NOT NULL,
InStock boolean,
constraint product_id_pk3 Primary key (ProductID)
);
