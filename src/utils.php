<?php
include_once('./configs.php');
include_once("rdb/rdb.php");


function select($selectFun)
{
    for ($run = 0; $run < 10000; ++$run) {
        $slugI = rand(0, 10000);
        $slug = md5((string)$slugI);
        $selectFun($slug);
    }
}


final class MySQL
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
        if ($this->conn->connect_errno) {
            printf("Connect failed: %s\n", $this->conn->connect_error);
            exit(-1);
        }
    }

    public function query($query)
    {
        $query_result = $this->conn->query($query);
        if (!$query_result) {
            printf("Errormessage: %s\n", $this->conn->error);
            exit(-1);
        }
        return $query_result;
    }

    public function createTable()
    {
        $this->query("DROP TABLE IF EXISTS t1;");
        $this->query("
          CREATE TABLE t1 (
              name varchar(100) NOT NULL DEFAULT '',
              date date NOT NULL,
              f1 int(6) unsigned NOT NULL DEFAULT '0',
              f2 int(6) unsigned NOT NULL DEFAULT '0',
              f3 int(4) unsigned NOT NULL DEFAULT '0',
              slug varchar(32) NOT NULL,
              KEY (slug)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }
}


final class RethinkDB
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = r\connect(RETHINK_HOST, 28015, RETHINK_DB);
    }

    public function createTable()
    {
        r\tableDrop("t1")->run($this->conn);
        r\tableCreate("t1")->run($this->conn);
        r\table("t1")->indexCreate("slug")->run($this->conn);
        r\table("t1")->indexWait("slug")->run($this->conn);
    }

    public function insert($data) {
        r\table("t1")->insert($data)->run(
            $this->conn, array("durability" => "soft", "noreply" => true)
        );
    }
}