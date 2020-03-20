<?php

use think\migration\Migrator;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateTeamTable extends Migrator
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
     * biginteger
        binary
        boolean
        date
        datetime
        decimal
        float
        double
        integer
        smallinteger
        string
        text
        time
        timestamp
        uuid
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table('team');
        $table->setComment('球队表');
        $table->addColumn('name', 'string', ['limit' => 20, 'null' => true, 'comment' => '球队名称'])
            ->addColumn('image', 'string', ['limit' => 255, 'null' => true, 'comment' => '球队LOGO'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => true, 'comment' => '所属地域, 0 东部 1 西部'])
            ->addColumn('created_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_time', 'integer', ['limit' => 11, 'null' => true, 'comment' => '修改时间'])
            ->create();

    }

    public function down()
    {
        $this->dropTable('team');
    }
}
