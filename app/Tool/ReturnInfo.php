<?php
namespace App\Tool;
define('SUCCESS_RET', 0); //执行成功
define('FAIL_RET', 1);//全部执行失败
define('PART_SUCCESS_RET', 2);//部分执行成功，部分执行失败
define('INNER_ERROR_RET', 3);//系统认证失败或者系统内部错误。

class ReturnInfo
{
	public $err;
	public $data;

	function __construct($err = 0, $data = '')
	{
		$this->err = $err;
		$this->data = $data;
	}

	function __toString()
	{
		return json_encode(array('err' => $this->err, 'data' => $this->data));
	}
}

?>