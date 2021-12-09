
DROP database if exists catalog;
create database catalog;
use catalog;

DROP TABLE IF EXISTS Catalog_products;
DROP TABLE IF EXISTS Catalog_categories;

Create TABLE Catalog_categories( 
 id integer auto_increment, 
 category_name VARCHAR(45) NOT NULL, 
 Constraint category_PK Primary key (id)
);

Create TABLE Catalog_products(
 product_code VARCHAR(45) NOT NULL, 
 product_name VARCHAR(45) NOT NULL, 
 product_price Double, 
 category_id integer,
 Constraint product_PK Primary key (product_code),
 Constraint category_FK Foreign key (category_id) References Catalog_categories(id)
);

insert into Catalog_categories(category_name) values('Lips');
insert into Catalog_categories(category_name) values('Eyes');
insert into Catalog_categories(category_name) values('Face');
insert into Catalog_products(product_code,product_name,product_price, category_id) values('1','lip1',000.00,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('2','face1',000.00,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('3','eye1',000.00,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('4','lip2',000.00,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('5','eye2',000.00,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('6','face2',000.00,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('7','lip3',000.00,1);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('8','eye3',000.00,2);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('9','fac3',000.00,3);
insert into Catalog_products(product_code,product_name,product_price, category_id) values('10','lip4',000.00,1);