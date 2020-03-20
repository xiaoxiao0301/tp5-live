<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateTeamUserTable extends Migrator
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
        $table = $this->table('team_user');
        $table->setComment('球员表');
        $table->addColumn('name', 'string', ['default' => '', 'null' => true, 'limit' => 20, 'comment' => '球员名称'])
            ->addColumn('image', 'string', ['limit' => 255, 'null' => true, 'comment' => '头像'])
            ->addColumn('age', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true])
            ->addColumn('position', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'comment' => '位置'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'comment' => '状态'])
            ->addColumn('created_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '修改时间'])
            ->create();

    }

    public function down()
    {
        $this->dropTable('team_user');
    }
}
