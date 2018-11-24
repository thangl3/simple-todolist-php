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
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 2
            ], 
            [	
                'work_name' => 'donec dapibus duis at velit eu est congue elementum in hac habitasse platea',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 3
            ],
            [	
                'work_name' => 'fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 3
            ], 
            [	
                'work_name' => 'aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 1
            ],
            [	
                'work_name' => 'odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 3
            ],
            [	
                'work_name' => 'nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 1
            ],
            [	
                'work_name' => 'pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 2
            ],
            [	
                'work_name' => 'sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 2
            ],
            [	
                'work_name' => 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 3
            ],
            [	
                'work_name' => 'pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 1
            ],
            [	
                'work_name' => 'consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 1
            ],
            [	
                'work_name' => 'dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 1
            ],
            [	
                'work_name' => 'eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor',
                'start_day' => '22',
                'start_month' => '06',
                'start_year' => '2018',
                'end_day' => '06',
                'end_month' => '07',
                'end_year' => '2019',
                'status' => 2
            ]
        ];

        $posts = $this->table('work');
        $posts->insert($data)->save();
    }
}
