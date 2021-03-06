<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class CreateLiveChatsTable extends Migrator
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
        $table = $this->table('live_chats');
        $table->setComment('赛事赛况表');
        $table->addColumn('game_id', 'integer', ['null' => true, 'comment' => '直播ID'])
            ->addColumn('user_id', 'integer', ['null' => true, 'comment' => '用户ID'])
            ->addColumn('content', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'comment' => '状态'])
            ->addColumn('created_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '修改时间'])
            ->create();

    }

    public function down()
    {
        $this->dropTable('live_chats');
    }
}
