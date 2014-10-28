<?php
include_once('./utils.php');

function selectRdb() {
    $rethink = new RethinkDB();
	$selectFun = function ($slug) use ($rethink) {
		$res = r\table("t1")->getAll($slug, array("index" => "slug"))->run($rethink->conn);
		// Fetch all results:
		$res->toArray();
	};
	$t = microtime(true);
	select($selectFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

function selectMysql() {
    $mysql = new MySQL();
	$selectFun = function ($slug) use ($mysql) {
		$res = $mysql->query("SELECT  * FROM t1 WHERE slug = '$slug';");
		$res->fetch_all();
	};
	$t = microtime(true);
	select($selectFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

echo "Running MySQL select...\n";
selectMysql();

echo "Running RethinkDB select...\n";
selectRdb();
