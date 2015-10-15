<?php

namespace App\Tool;

use App\Tool\ReturnInfo as ReturnInfo;
use DB;
use App\Tool\CacheOperator as CacheOperator;
use Illuminate\Support\Facades\Log as Log;
use App\Tool\Pinyin as Pinyin;

class DataDigger
{
	public static function query($model, $conditions, $take = 10)
	{
		$skip = 0;
		if (isset($conditions['ps']) && (int)($conditions['ps']))
		{
			$take = $conditions['ps'];
			if (isset($conditions['pn']) && (int)($conditions['pn']))
			{
				$skip = $take*$conditions['pn'];
			}
		}
		unset($conditions['pn']);
		unset($conditions['ps']);
		unset($conditions['_token']);

		if (isset($conditions['order_by']) && count($conditions['order_by']) == 2)
		{
			$orderBy = $conditions['order_by'];
			unset($conditions['order_by']);
		}

		$res = app('App\\' . $model);

		if (isset($conditions['deleted_at']) && $conditions['deleted_at'] > 0)
		{
			$res = $res::onlyTrashed();
		}
		unset($conditions['deleted_at']);

		foreach ($conditions as $key => $value)
		{
			if (is_array($value))
			{
				$op = $value[0];
				switch ($op)
				{
					case 'like':
						$value[1] = '%' . $value[1] . '%';
						$res = $res->where($key, $op, $value[1]);
						break;
					case 'in':
						$res = $res->whereIn($key, $value[1]);
						break;
					case '>=':
					case '<=':
					case '<>':
					case '>':
					case '<':
						$res = $res->where($key, $op, $value[1]);
						break;
					default:
						$res = $res->where($key, $op, $value[1]);
						break;
				}
			}
			else if ($value !== '')
			{
				$res = $res->where($key, '=', $value);
			}
		}
		$total = $res->count();
		$count = $total > $take ? $take : $total;

		$records = $res->skip($skip)->take($take);
		if (isset($orderBy))
		{
			$records = $records->orderBy($orderBy[0], $orderBy[1]);
		}
		else
		{
			$records = $records->orderBy('id', 'desc');
		}
		$records = $records->get();
		return array('count' => $count,
		             'list'  => $records,
		);
	}
}