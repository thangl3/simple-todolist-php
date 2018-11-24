<?php


use Phinx\Migration\AbstractMigration;

class WorkTable extends AbstractMigration
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
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table(
            'work',
            [
                'id' => 'work_id',
                'primary_key' => ['work_id']
            ]
        );
        $table
            ->addColumn('work_id', 'integer', ['limit' => 9])
            ->addColumn('work_name', 'string', ['limit' => 1000])
            ->addColumn('start_date', 'datetime')
            ->addColumn('end_date', 'datetime')
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('deleted_at', 'datetime')
            ->create();
    }
}
