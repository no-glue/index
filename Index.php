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

	public function run($argv,$callback,$namespace='\\fiddles\\'){
		$argv=array_slice($argv,1);

		$object=array_shift($argv);

		$object=$namespace.$object;

		$function=array_shift($argv);

		print_r($argv);

		$callback(
			call_user_func_array(
				array(new $object,$function),
				$argv
			)
		);

		return $this;
	}
}

(new \index\Index())
	->run(
		$argv,
		function($returned){
			print $returned."\n";
		}
	);
