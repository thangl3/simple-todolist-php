<?php


use Phinx\Migration\AbstractMigration;

class AddColumnWeekWorkTable extends AbstractMigration
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
        // $exists = $this->hasTable('work');

        // if ($exists) {
        //     $hasStartWeek = $table->hasColumn('startWeek');
        //     $hasEndWeek = $table->hasColumn('endWeek');
        //     $hasStartTime = $table->hasColumn('startTime');
        //     $hasEndTime = $table->hasColumn('endTime');

        //     if (!$hasStartWeek && !$hasEndWeek && !$hasStartTime && !$hasEndTime) {
        //         $table = $this->table('work')
        //                 ->addColumn('start_week', 'integer', ['limit' => 2, 'after' => 'start_day'])
        //                 ->addColumn('start_time', 'time', ['after' => 'start_year'])
        //                 ->addColumn('end_week', 'integer', ['limit' => 2, 'after' => 'end_day'])
        //                 ->addColumn('end_time', 'time', ['after' => 'end_year'])
        //                 ->update();
        //     }
        // }

        $table = $this->table('work')
                    ->addColumn('start_week', 'integer', ['limit' => 2, 'after' => 'start_day'])
                    ->addColumn('start_time', 'time', ['after' => 'start_year', 'null' => true])
                    ->addColumn('end_week', 'integer', ['limit' => 2, 'after' => 'end_day'])
                    ->addColumn('end_time', 'time', ['after' => 'end_year', 'null' => true])
                    ->update();
    }
}
