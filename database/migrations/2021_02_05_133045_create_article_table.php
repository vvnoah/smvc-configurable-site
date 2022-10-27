<?php

/**
 * Description of CreateArticleTable
 *
 */
class CreateArticleTable {
    public function up()
    {
        $sql = "CREATE TABLE `article` 
            (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8_bin',PRIMARY KEY (`id`)
            )
            COLLATE='utf8_bin'
            ENGINE=InnoDB
            ;";
        return $sql;

    }
    public function down() {
        $sql = "DROP TABLE article;";
        return $sql;
    }
}