<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\HotelNameType;

class DingTableSeeder extends Seeder
{

	protected $images = ['audi' => ['http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444841946_42.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444841946_43.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444841946_61.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444841947_62.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444841946_63.jpg',
	],

	                     'bmw'  => ['http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842239_3_1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842239_3_2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842239_3_3.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842239_5_1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842239_5_2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842242_5_3.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842242_7_1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842242_7_2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842242_7_3.jpg',
	                     ],

	                     'benz' => ['http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842113_c1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842113_c2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842113_c3.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842113_e1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842113_e2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842117_e3.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842117_s1.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842117_s2.jpg',
	                                'http://yeah-fans.oss-cn-hangzhou.aliyuncs.com/1444842117_s3.jpg',
	                     ],
	];


	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$sortList = ['商圈', '城市'];
		$hotelList = ['酒店', '宾馆'];

		foreach (range(1, 100) as $index)
		{
			HotelNameType::create(array('name' => $faker->city() . $hotelList[rand(0,1)],
			                            'sort' => $sortList[rand(0, 1)],
			));
		}
	}

}
