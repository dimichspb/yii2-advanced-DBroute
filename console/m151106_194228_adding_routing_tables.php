<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_194228_adding_routing_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_bin ENGINE=InnoDB';
        }

        $this->createTable('{{%routes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'route' => $this->string(255)->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%route_urls}}', [
            'id' => $this->primaryKey(),
            'route_id' => $this->integer()->notNull(),
            'url' => $this->string(255)->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_routes_user_id', '{{%routes}}', 'user_id');
        $this->createIndex('idx_route_urls_route_id', '{{%route_urls}}', 'route_id');

        $this->addForeignKey('fkey_routes_users_user_id', '{{%routes}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fkey_routes_route_urls_route_id', '{{%route_urls}}', 'route_id', '{{%routes}}', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        $this->dropTable('{{%route_urls%}}');
        $this->dropTable('{{%routes%}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
