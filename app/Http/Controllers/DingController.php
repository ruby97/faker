<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tool\DataDigger;
use App\HotelNameType;
use App\Tool\ReturnInfo;
use Illuminate\Support\Facades\Input;

class DingController extends Controller
{
	public function index($model)
	{
		$data = [];
		if($model == 'hotelnametype')
		{
			$data = DataDigger::query('HotelNameType', Input::all(), 20);
		}
		return new ReturnInfo(SUCCESS_RET, $data);
	}

}
