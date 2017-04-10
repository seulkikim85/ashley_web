DROP DATABASE `Ashley`
CREATE DATABASE `Ashley` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE `Orders` (
  `order_id` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `product_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `is_delivered` varchar(1) COLLATE utf8_bin NOT NULL,
  `create_dt` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `update_dt` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`order_id`,`email`,`product_id`)
);

INSERT INTO `ashley`.`orders` (`order_id`, `email`, `product_id`, `qty`, `is_delivered`, `create_dt`, `update_dt`) VALUES ('0001', 'abc@bcd.com', '00010001', '40', 'N', '20170320183900', '20170320183900');
INSERT INTO `ashley`.`orders` (`order_id`, `email`, `product_id`, `qty`, `is_delivered`, `create_dt`, `update_dt`) VALUES ('0002', 'bcd@cde.com', '00010002', '2', 'Y', '20170320185000', '20170320185000');
INSERT INTO `ashley`.`orders` (`order_id`, `email`, `product_id`, `qty`, `is_delivered`, `create_dt`, `update_dt`) VALUES ('0003', 'cca@abc.com', '00010001', '4', 'N', '20170320195000', '20170320195000');
INSERT INTO `ashley`.`orders` (`order_id`, `email`, `product_id`, `qty`, `is_delivered`, `create_dt`, `update_dt`) VALUES ('0003', 'cca@abc.com', '00010002', '1', 'N', '20170320205000', '20170320205000');
INSERT INTO `ashley`.`orders` (`order_id`, `email`, `product_id`, `qty`, `is_delivered`, `create_dt`, `update_dt`) VALUES ('0003', 'cca@abc.com', '00010003', '1', 'N', '20170320305000', '20170320305000');


CREATE TABLE `Products` (
  `product_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `brand_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `product_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `category` varchar(3) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NULL,
  `img_url` varchar(1000) COLLATE utf8_bin NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `create_dt` varchar(14) COLLATE utf8_bin NOT NULL,
  `update_dt` varchar(14) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`product_id`)
);

INSERT INTO `ashley`.`products` (`product_id`, `brand_name`, `product_name`, `category`, `description`, `img_url`, `qty`, `price`, `create_dt`, `update_dt`) VALUES ('00010001', 'Apple', 'iphon6', '001', 'iphone6', './image/lipstick.jpg', '50', '1000', '20170320183400', '20170320183400');
INSERT INTO `ashley`.`products` (`product_id`, `brand_name`, `product_name`, `category`, `description`, `img_url`, `qty`, `price`, `create_dt`, `update_dt`) VALUES ('00010002', 'Apple', 'iphon7', '002', 'iphone7', './image/lipstick.jpg', '4', '1200', '20170320183400', '20170320183400');
INSERT INTO `ashley`.`products` (`product_id`, `brand_name`, `product_name`, `category`, `description`, `img_url`, `qty`, `price`, `create_dt`, `update_dt`) VALUES ('00010003', 'Apple', 'iphon8', '003', 'iphone8', './image/lipstick.jpg', '3', '2000', '20170320183400', '20170320183400');
INSERT INTO `ashley`.`products` (`product_id`, `brand_name`, `product_name`, `category`, `description`, `img_url`, `qty`, `price`, `create_dt`, `update_dt`) VALUES ('00010004', 'Dell', 'Dell inspire', '001', 'Dell inspire', './image/lipstick.jpg', '6', '2500', '20170320183400', '20170320183400');

CREATE  TABLE `ashley`.`MyBasket` (
  `basket_id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `product_id` VARCHAR(10) NOT NULL ,
  `qty` INT NOT NULL ,
  `is_ordered` VARCHAR(1) NOT NULL ,
  `create_dt` VARCHAR(14) NOT NULL ,
  `update_dt` VARCHAR(14) NULL ,
  PRIMARY KEY (`basket_id`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

INSERT INTO `ashley`.`MyBasket` (`email`, `product_id`, `qty`, `is_ordered`, `create_dt`, `update_dt`) VALUES ('abc@gmail.com', '00010001', '2', 'N', '20170403132000', '20170403132000');
INSERT INTO `ashley`.`MyBasket` (`email`, `product_id`, `qty`, `is_ordered`, `create_dt`, `update_dt`) VALUES ('abc@gmail.com', '00010003', '1', 'N', '20170403132000', '20170403132000');
INSERT INTO `ashley`.`MyBasket` (`email`, `product_id`, `qty`, `is_ordered`, `create_dt`, `update_dt`) VALUES ('abc@gmail.com', '00010002', '1', 'Y', '20170403132000', '20170403132000');

CREATE  TABLE `ashley`.`users` (
  `email` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `first_name` VARCHAR(50) NOT NULL ,
  `last_name` VARCHAR(50) NOT NULL ,
  `postal` VARCHAR(7) NULL ,
  `city` VARCHAR(50) NULL ,
  `province` VARCHAR(50) NULL ,
  `tel` VARCHAR(15) NOT NULL ,
  `create_dt` VARCHAR(14) NOT NULL ,
  `update_dt` VARCHAR(14) NOT NULL ,
  PRIMARY KEY (`email`) );

INSERT INTO `ashley`.`users` (`email`, `password`, `first_name`, `last_name`, `postal`, `city`, `province`, `tel`, `create_dt`, `update_dt`) VALUES ('abc@gmail.com', '12345678', 'Daniel', 'Seo', 'M2N G8Q', 'Toronto', 'Ontrario', '647-123-4567', '20160410154300', '20160410154300');
INSERT INTO `ashley`.`users` (`email`, `password`, `first_name`, `last_name`, `postal`, `city`, `province`, `tel`, `create_dt`, `update_dt`) VALUES ('def@gmail.com', '12345678', 'Seulki', 'Kim', 'M2N 1T9', 'Toronto', 'Ontrario', '647-456-7890', '20160410154500', '20160410154500');
  




SELECT P.product_id
                                     , P.brand_name
                                     , P.product_name
                                     , P.category
                                     , P.description
                                     , P.img_url
                                     , P.qty - O.qty as qty
                                     , CASE P.qty - O.qty WHEN 0 THEN 'Y'
                                       ELSE 'N'
                                       END  as is_soldout
                                     , P.update_dt
                                    FROM Products P
                                    LEFT JOIN 
                                    (SELECT product_id
                                          , sum(qty) as qty
                                       FROM Orders
                                      GROUP BY product_id) O
                                      ON P.product_id = O.product_id
                                   WHERE category = 'lip'
                                   ORDER BY P.update_dt DESC