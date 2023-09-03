<?php
class blocks
{ //called funcs for $main content

	static function test($p)
	{
		[$a, $b] = vals($p, ['a', 'b']);
		$ret = sql::read('name', 'users', 'v', ['id' => 1]);
		return $ret;
	}

	static function call($p)
	{
		[$a, $b] = vals($p, ['a', 'b']);
		if (method_exists('blocks', $a))
			return self::$a($p);
	}
}
