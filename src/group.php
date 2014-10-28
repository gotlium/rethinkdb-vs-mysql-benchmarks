<?php
include_once('./utils.php');

function group($groupFun) {
	for ($run = 0; $run < 10; ++$run) {
		$groupFun();
	}
}

function groupRdb() {
    $rethink = new RethinkDB();

	$groupFun = function () use ($rethink) {
		$res = r\table("t1")->group("name")->sum("f1")->run($rethink->conn);
	};
	$t = microtime(true);
	group($groupFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

function groupMysql() {
    $mysql = new MySQL();
	$groupFun = function () use ($mysql) {
		$res = $mysql->query("SELECT  name, SUM(f1) FROM t1 GROUP BY name;");
		$res->fetch_all();
	};
	$t = microtime(true);
	group($groupFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

echo "Running MySQL group...\n";
groupMysql();

echo "Running RethinkDB group...\n";
groupRdb();
