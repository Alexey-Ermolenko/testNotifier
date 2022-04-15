--Задачи на SQL
/*
create database db;
use db;
*/

CREATE TABLE `order_tbl` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`external_id` VARCHAR(16) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status_id` SMALLINT(5) UNSIGNED NOT NULL,
	`status_updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `sys_order_status` (
	`id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` TEXT NOT NULL COLLATE 'utf8_general_ci',
	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `order_status_log_uniq` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`order_id` INT(10) UNSIGNED NOT NULL,
	`status_id` SMALLINT(5) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `uniq` (`order_id`, `status_id`) USING BTREE,
	INDEX `order_id` (`order_id`) USING BTREE,
	INDEX `index__created_at` (`created_at`) USING BTREE,
	CONSTRAINT `order_status_log_uniq_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `db`.`order_tbl` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `order_status_log_uniq_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `db`.`sys_order_status` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
);
/*
Таблица order – заказы, status_id – текущий статус на заказе. 
Таблица sys_order_status - статусы заказов
В таблице order_status_log_uniq записывается история статусов на заказе, текущий статус так же записывается в историю сразу.
Задача 1:
Вывести ID заказа, название статуса на заказе, название предпоследнего статуса выставленного на заказе и его время
ID;Current title status;Prelast title status;Prelast date status
112;Status 1;Status 2;2022-01-01 00:00:00
*/

Запрос 1:
SELECT t.ID, 
	   sos.title AS 'Current title status',
       (SELECT sos.title 
          FROM order_status_log_uniq oslu1 
          JOIN sys_order_status sos ON oslu1.order_id = 1 AND oslu1.status_id = sos.id 
         WHERE oslu.created_at >= oslu1.created_at 
         ORDER BY oslu1.id ASC
         LIMIT 1
       ) AS 'Prelast title status',
	   t.created_at AS 'Prelast date status'
  FROM order_tbl t
       JOIN sys_order_status sos ON sos.ID = t.status_id
       JOIN order_status_log_uniq oslu ON oslu.order_id = t.ID AND oslu.status_id = sos.id
       WHERE t.ID = 1; -- t.ID = ID заказа
	   
/*
Задача 2:
Вывести с группировкой по дням, сколько заказов прошли через статус 1, сколько из этих заказов прошли статус 2, сколько из этих заказов имеют статус 3
Date of status 1; Total status 1; Total status 2; Total status 3;
2022-01-01;20;10;12	   
*/
SELECT
       oslu.created_at AS 'Date of status 1',
       oslu.status_id AS 'Total status 1',
       (SELECT COUNT(*) FROM order_status_log_uniq oslu1 WHERE oslu1.status_id = 2 and oslu1.order_id = oslu.order_id) AS 'Total status 2',
       (SELECT COUNT(*) FROM order_status_log_uniq oslu1 WHERE oslu1.status_id = 3 and oslu1.order_id = oslu.order_id) AS 'Total status 3'
  FROM order_status_log_uniq oslu
 GROUP BY oslu.created_at, oslu.status_id, oslu.order_id
HAVING oslu.status_id = 1;















