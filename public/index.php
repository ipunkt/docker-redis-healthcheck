<?php

function env($environmentVariable, $default = null) {
	$value = getenv($environmentVariable);

	if( empty($value) || $value === false )
		return $default;

	return $value;
}

$config = [
	'host' => env('HOST', '127.0.0.1'),
	'port' => env('PORT', '6379'),
];

$redis = new Redis();

$connected = $redis->connect($config['host'], $config['port']);
$connectionFailed = !$connected;
if( $connectionFailed ) {
	http_response_code(500);
	die("Connection failed");
}

$live = $redis->ping();
$dead = !$live;
if( $dead ) {
	http_response_code(500);
	die("Ping failed");
}


echo "Live";
http_response_code(200);
