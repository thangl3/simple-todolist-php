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
                'start_date' => '2018-07-22 13:30:30',
                'end_date' => '2019-06-06 15:46:32',
                'status' => 2
            ], 
            [	
                'work_name' => 'donec dapibus duis at velit eu est congue elementum in hac habitasse platea',
                'start_date' => '2018-11-06 18:30:05',
                'end_date' => '2019-10-09 17:56:34',
                'status' => 3
            ],
            [	
                'work_name' => 'fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis',
                'start_date' => '2018-08-04 17:02:41',
                'end_date' => '2019-08-21 04:48:48',
                'status' => 3
            ], 
            [	
                'work_name' => 'aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi',
                'start_date' => '2018-06-04 15:13:47',
                'end_date' => '2019-11-06 06:44:09',
                'status' => 1
            ],
            [	
                'work_name' => 'odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique',
                'start_date' => '2018-07-09 18:08:44',
                'end_date' => '2019-08-15 06:36:23',
                'status' => 3
            ],
            [	
                'work_name' => 'nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci',
                'start_date' => '2018-10-04 02:08:24',
                'end_date' => '2019-07-27 22:10:13',
                'status' => 1
            ],
            [	
                'work_name' => 'pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque',
                'start_date' => '2018-06-07 01:42:56',
                'end_date' => '2019-11-16 16:48:54',
                'status' => 2
            ],
            [	
                'work_name' => 'sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla',
                'start_date' => '2018-08-11 12:07:04',
                'end_date' => '2019-10-23 11:39:11',
                'status' => 2
            ],
            [	
                'work_name' => 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo',
                'start_date' => '2018-08-24 11:37:20',
                'end_date' => '2019-08-11 20:54:06',
                'status' => 3
            ],
            [	
                'work_name' => 'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat',
                'start_date' => '2018-09-12 19:32:39',
                'end_date' => '2019-07-27 09:06:33',
                'status' => 1
            ],
            [	
                'work_name' => 'consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae',
                'start_date' => '2018-09-12 19:32:39',
                'end_date' => '2019-07-27 09:06:33',
                'status' => 1
            ],
            [	
                'work_name' => 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis',
                'start_date' => '2018-06-07 01:42:56',
                'end_date' => '2019-11-16 16:48:54',
                'status' => 1
            ],
            [	
                'work_name' => 'eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor',
                'start_date' => '2018-08-24 11:37:20',
                'end_date' => '2019-08-11 20:54:06',
                'status' => 2
            ]
        ];

        $posts = $this->table('work');
        $posts->insert($data)->save();
    }
}
