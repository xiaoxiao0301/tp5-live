<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateGameTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table('game');
        $table->setComment('直播表');
        $table->addColumn('team_a', 'integer', ['default' => 0, 'null' => true, 'comment' => '球队a'])
            ->addColumn('team_b', 'integer', ['default' => 0, 'null' => true, 'comment' => '球队b'])
            ->addColumn('team_a_score', 'integer', ['default' => 0, 'null' => true, 'comment' => '球队a成绩'])
            ->addColumn('team_b_score', 'integer', ['default' => 0, 'null' => true, 'comment' => '球队b成绩'])
            ->addColumn('narrtor', 'string', ['default' => '', 'null' => true, 'limit' => 20, 'comment' => '解说员'])
            ->addColumn('image', 'string', ['limit' => 255, 'null' => true, 'comment' => '图片'])
            ->addColumn('start_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '开始时间'])
            ->addColumn('created_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '修改时间'])
            ->create();

    }

    public function down()
    {
        $this->dropTable('game');
    }
}
