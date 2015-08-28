##
# Shu™z-R-Us

##### _A Shu™ store._

#### Mike Chastain

## Description

_A Shu™ Store app_

## Setup



```
$ composer install
```

Mysql for building the database.

* Create a Database called shoes.
* In phpmyadmin go to sql tab
* copy and paste the code below

```
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'stores'
-- 
-- ---

DROP TABLE IF EXISTS `stores`;
		
CREATE TABLE `stores` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'brands'
-- 
-- ---

DROP TABLE IF EXISTS `brands`;
		
CREATE TABLE `brands` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'stores_brands'
-- 
-- ---

DROP TABLE IF EXISTS `stores_brands`;
		
CREATE TABLE `stores_brands` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `store_id` INTEGER NULL DEFAULT NULL,
  `brand_id` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `stores_brands` ADD FOREIGN KEY (store_id) REFERENCES `stores` (`id`);
ALTER TABLE `stores_brands` ADD FOREIGN KEY (brand_id) REFERENCES `brands` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `stores` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `brands` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `stores_brands` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `stores` (`id`,`name`) VALUES
-- ('','');
-- INSERT INTO `brands` (`id`,`name`) VALUES
-- ('','');
-- INSERT INTO `stores_brands` (`id`,`store_id`,`brand_id`) VALUES
-- ('','','');

```
_

__

_then start up a local PHP server from within the "web" directory within the project's folder and point your browser to whatever local host server you have created._  

## Technologies Used

_This project makes use of PHP, the testing framework [PHPUnit](https://phpunit.de/), the micro-framework [Silex](http://silex.sensiolabs.org/), and uses [Twig](http://twig.sensiolabs.org/) templates._

## To Do



### Legal



Copyright (c) 2015 Mike Chastain

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
