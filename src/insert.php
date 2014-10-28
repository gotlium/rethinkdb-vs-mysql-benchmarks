<?php
require_once('./utils.php');


function generateBatch($size, $slug, $name) {
    $batch = array();
    for ($i = 0; $i < $size; ++$i) {
        $batch[] = array("name" => $name, "date" => date("c"), "f1" => rand(0, 10), "f2" => rand(0, 10), "f3" => rand(0, 10), "slug" => $slug);
    }
    return $batch;
}


function insert($insertFun) {
	$sameSlug = DB_STEP;
	$batchSize = $sameSlug * 4;
	$inserted = 0;
	$slugI = 0;
	while ($inserted < DB_ROWS) {
		$batch = array();
		for ($i = 0; $i < $batchSize / $sameSlug; ++$i) {
			$batch = array_merge($batch, generateBatch($sameSlug, md5((string)$slugI), uniqid()));
			++$slugI;
		}
		$insertFun($batch);
		$inserted += $batchSize;
	}
}

function insertRdb() {
	$rethink = new RethinkDB();
    $rethink->createTable();

	$insertFun = function ($data) use ($rethink) {
        $rethink->insert($data);
	};
	$t = microtime(true);
	insert($insertFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

function insertMysql() {
	// For comparability with RethinkDB durability=soft, make sure that innodb_flush_log_at_trx_commit is set to 0.
    $mysql = new MySQL();
    $mysql->createTable();
	$insertFun = function ($batch) use ($mysql) {
		$sqlDocs = "";
		$firstD = true;
		foreach ($batch as $doc) {
			if (!$firstD) $sqlDocs .= ", ";
			$firstD = false;
			$sqlDocs .= "(";
			$firstF = true;
			foreach ($doc as $field => $val) {
				if (!$firstF) $sqlDocs .= ", ";
				$firstF = false;
				$sqlDocs .= "'$val'";
			}
			$sqlDocs .= ")";
		}
        $mysql->query("INSERT INTO t1 VALUES $sqlDocs");
	};
	$t = microtime(true);
	insert($insertFun);
	$t = microtime(true) - $t;
	echo "Duration: $t s\n\n";
}

echo "Running MySQL insert...\n";
insertMysql();

echo "Running RethinkDB insert...\n";
insertRdb();
