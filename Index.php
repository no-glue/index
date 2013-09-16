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

	public function run($instream,$namespace='\\index\\'){
		$object=fgets($instream);

		$object=$namespace.$object;

		$function=fgets($instream);

		$result = call_user_func_array(
			array(new $object,$function),
			$instream
		);

		$instream=array_shift($result);

		if(isset($result['callback'])){
			$callback=array_shift($result);

			$callback($result);
		}

		$result=$instream;

		return $result;
	}
}

fclose(
	(new \index\Index())
	->run(
		fopen('php://stdin','r')
	)
);
