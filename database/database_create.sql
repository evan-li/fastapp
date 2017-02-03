CREATE DATABASE `fastapp`;

USE fastapp;

CREATE TABLE `app` (
	`app_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '应用的app_id',
	`app_key` VARCHAR(512) NOT NULL COMMENT '应用的app_key',
	`app_name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '用户的app名称',
	`app_desc` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '用户的app描述',
	`create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最后更新时间',
	PRIMARY KEY (`app_id`)
)
COMMENT='app应用表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
