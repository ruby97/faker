<?php
/**
 * Created by PhpStorm.
 * User: ruby97
 * Date: 15/9/10
 * Time: 下午5:10
 */

namespace App\Tool;

use App\Tool\File as File;
use Illuminate\Support\Facades\Log as Log;
use Illuminate\Foundation\Application;
use App\Tool\File as FileTool;

class Pinyin
{
	protected static $inst = null;

	protected $file = null;

	protected $map = array();

	public static function instance()
	{
		if (null == self::$inst)
		{
			self::$inst = new Pinyin();
		}

		return self::$inst;
	}

	function __construct()
	{
		$filePath = Application::getInstance()->storagePath() . '/files/pinyin.db';
		if (file_exists($filePath))
		{
			$records = file($filePath);
			foreach ($records as $record)
			{
				$record = trim($record);
				$this->map[substr($record, 0, 3)] = substr($record, 4, strlen($record) - 3);
			}
		}
	}

	public function make($str, $isHead = 0)
	{
		$str = trim($str);
		$newStr = "";
		$len = strlen($str);

		if ($len < 2)
		{
			return $str;
		}

		for ($i = 0; $i < $len; $i++)
		{
			if (ord($str[$i]) > 0x80)
			{
				$c = substr($str, $i, 3);
				$i = $i + 2;
				if (isset($this->map[$c]))
				{
					if ($isHead == 0)
					{
						$newStr .= $this->map[$c];
					}
					else
					{
						$newStr .= $this->map[$c][0];
					}
				}
				else
				{
					$newStr .= "_";
				}
			}
			else if (preg_match('/^[a-zA-Z0-9]$/', $str[$i]))
			{
				$newStr .= strtolower($str[$i]);
			}
			else
			{
				$newStr .= "_";
			}
		}

		return $newStr;
	}
}