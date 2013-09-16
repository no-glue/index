<?php

namespace index;

class Index{
	public function __construct(
		$classLoader='SplClassLoader.php',
		$folder=__DIR__
	){
		$loader=require_once($classLoader);

		$loader->setIncludePath(dirname($folder));
	}

	public function run($instream,$callback,$namespace='\\index\\'){
		$object=fgets($instream);

		$object=$namespace.$object;

		$function=fgets($instream);

		return $callback(
			call_user_func_array(
				array(new $object,$function),
				$instream
			)
		);
	}
}

fclose(
	(new \index\Index())
	->run(
		fopen('php://stdin','r'),
		function($returned){
			print $returned."\n";

			return $returned;
		}
	)
);
