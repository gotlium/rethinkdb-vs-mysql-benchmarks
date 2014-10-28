<?php
include_once('./utils.php');


function selectRdb() {
    $rethink = new RethinkDB();
	$selectFun = function ($slug) use ($rethink) {
		$res = r\table("t1")->getAll($slug, array("index" => "slug"))->group("name")->sum("f1")->run($rethink->conn);
	};
	$t = microtime(true);
	select($selectFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

function selectMysql() {
    $mysql = new MySQL();
	$selectFun = function ($slug) use ($mysql) {
        $res = $mysql->query("SELECT name, SUM(f1) FROM t1 WHERE slug = '$slug' GROUP BY name;");
        $res->fetch_all();
	};
	$t = microtime(true);
	select($selectFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

echo "Running MySQL select group...\n";
selectMysql();

echo "Running RethinkDB select group...\n";
selectRdb();
