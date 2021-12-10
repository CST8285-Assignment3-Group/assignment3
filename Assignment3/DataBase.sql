-- insert drop database statement
DROP database if exists catalog;
-- create database statement
create database catalog;
use catalog;

-- insert drop table statements 
DROP TABLE IF EXISTS Catalog_products;
DROP TABLE IF EXISTS Catalog_categories;

-- create table for the categories 
Create TABLE Catalog_categories( 
 id integer auto_increment, 
 category_name VARCHAR(45) NOT NULL, 
 Constraint category_PK Primary key (id)
);

-- create table for the products 
Create TABLE Catalog_products(
 product_code VARCHAR(45) NOT NULL, 
 product_name VARCHAR(45) NOT NULL, 
 product_price Double, 
 category_id integer,
 Constraint product_PK Primary key (product_code),
 Constraint category_FK Foreign key (category_id) References Catalog_categories(id)
);

-- insert statements for each category 
insert into Catalog_categories(category_name) values('Lips');
insert into Catalog_categories(category_name) values('Eyes');
insert into Catalog_categories(category_name) values('Face');

-- insert specific products with applicable values 
insert into Catalog_products(product_code,product_name,product_price, category_id) values('L1100','Lipstick',20.00,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('F1100','Foundation',60.00,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('E1100','Mascara',20.00,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('F1200','BB Cream',49.99,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('L1200','Lip Gloss',19.99,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('E1200','Eyeliner',29.99,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('F1300','Tinted Moisturizer',39.99,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('L1300','Lip Balm',15.99,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('E1300','Eyeshadow',69.99,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('F1400','Concealer',59.99,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('E1300','False Eyelashes',9.99,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('L1400','Lip Stain',19.99,1);
