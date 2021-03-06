<?php

/*
 * This file is part of the Fuel Composer package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Fuel;

/**
 * Composer Fuel Loader class
 *
 * Makes it possible to autoload a class and call a static function as well
 *
 * @link https://github.com/composer/composer/issues/1493#issuecomment-12492276
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Loader
{
	private $loader;

	public function __construct($loader)
	{
		$this->loader = $loader;
	}

	public function loadClass($class)
	{
		$result = $this->loader->loadClass($class);

		if ($result and class_exists($class, false) and method_exists($class, '_init'))
		{
			call_user_func(array($class, '_init'));
		}

		return $result;
	}
}
