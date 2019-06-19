<?php


use Phinx\Seed\AbstractSeed;

class SeedingWorking extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [	
                'work_name' => 'purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac',
                'start_day' => '22',
                'start_week' => '34',
                'start_month' => '06',
                'start_year' => '2018',
                'start_time' => '11:55',
                'end_day' => '06',
                'end_week' => 36,
                'end_month' => '07',
                'end_year' => '2019',
                'end_time' => '12:35',
                'status' => 2
            ], 
            [	
                'work_name' => 'donec dapibus duis at velit eu est congue elementum in hac habitasse platea',
                'start_day' => '12',
                'start_week' => '36',
                'start_month' => '07',
                'start_year' => '2019',
                'start_time' => '11:55',
                'end_day' => '06',
                'end_week' => 36,
                'end_month' => '07',
                'end_year' => '2020',
                'end_time' => '12:35',
                'status' => 3
            ],
            [	
                'work_name' => 'fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis',
                'start_day' => '12',
                'start_week' => '36',
                'start_month' => '07',
                'start_year' => '2019',
                'start_time' => '11:55',
                'end_day' => '06',
                'end_week' => 36,
                'end_month' => '07',
                'end_year' => '2020',
                'end_time' => '12:35',
                'status' => 1
            ], 
            [	
                'work_name' => 'aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi',
                'start_day' => '12',
                'start_week' => '36',
                'start_month' => '07',
                'start_year' => '2016',
                'start_time' => null,
                'end_day' => '06',
                'end_week' => 36,
                'end_month' => '07',
                'end_year' => '2020',
                'end_time' => null,
                'status' => 1
            ]
        ];

        $posts = $this->table('work');
        $posts->insert($data)->save();
    }
}
