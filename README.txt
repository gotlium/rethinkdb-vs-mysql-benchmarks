Simple benchmarks MySQL vs RethinkDB. Rules: Insert/Select/Group/Sum
Based on discussion https://github.com/rethinkdb/rethinkdb/issues/3245
At first run ./installation.sh on Ubuntu/Linux
And after run benchmarks ./run-benchmarks.sh

OS X results (MySQL is faster x10+):

    Insert(x10):
    Running MySQL insert...
    Duration: 33.840152025223 s, CPU: 40-50%

    Running RethinkDB insert...
    Duration: 357.02387881279 s, CPU: 400-500%

    Select(x12):
    Running MySQL select...
    Duration: 6.2724659442902 s, CPU: 17-35%

    Running RethinkDB select...
    Duration: 79.589710950851 s, CPU: 115-125%

    SelectGroup (x15):
    Running MySQL select group...
    Duration: 1.4813089370728 s, CPU: 18-39%

    Running RethinkDB select group...
    Duration: 23.465862989426 s, CPU: 400-500%

    Group (x55):
    Running MySQL group...
    Duration: 2.6519629955292 s, CPU: 18-39%

    Running RethinkDB group...
    Duration: 147.08728003502 s, CPU: 750-800%


With RethinkDb my laptop heated up to 98-101 °C

------------------------------------------------
OS X 10.9.5
2,3 GHz Intel Core i7
16 GB 1600 MHz DDR3
SSD, 676.7MB/s writes, 728.6MB/s read
rethinkdb 1.15.1 (CLANG 6.0 (clang-600.0.51))
mysqld Ver 5.6.21 for osx10.9 on x86_64 (Homebrew)
PHP 5.4.30
Python 2.7.8


Linux results (MySQL is faster x10+):

    Insert(x14):
    Running MySQL insert...
    Duration: 65.95942401886 s, CPU: 5-10%

    Running RethinkDB insert...
    Duration: 967.75272321701 s, CPU: 40-50%

    Select(x12):
    Running MySQL select...
    Duration: 4.5347340106964 s, CPU: 17-35%

    Running RethinkDB select...
    Duration: 57.78192782402 s, CPU: 150-200%

    SelectGroup (x2):
    Running MySQL select group...
    Duration: 3.1378440856934 s, CPU: 25-35%

    Running RethinkDB select group...
    Duration: 8.6794331073761 s, CPU: 300-400%

    Group (x18):
    Running MySQL group...
    Duration: 1.9017090797424 s, CPU: 18-39%

    Running RethinkDB group...
    Duration: 34.437789916992 s, CPU: 700-800%


Linux SQL_NO_CACHE results (MySQL is faster x2+):

    Select(x12):
    Running MySQL select...
    Duration: 4.7808909416199 s

    SelectGroup (x2):
    Running MySQL select group...
    Duration: 4.6870198249817 s

    Group (x2):
    Running MySQL group...
    Duration: 18.299555063248 s

------------------------------------------------
Ubuntu 14.04.1
Intel® Core™ i7-4770 Quad-Core Haswell
32 GB DDR3 RAM
2 x 2 TB SATA 6 Gb/s Enterprise HDD; 7200 rpm (Software-RAID 1)
rethinkdb 1.15.1~0trusty (GCC 4.8.2)
mysqld  Ver 5.6.21-1+deb.sury.org~trusty+1 for debian-linux-gnu on x86_64 ((Ubuntu))
PHP 5.5.9-1ubuntu4.4 (cli) (built: Sep  4 2014 06:56:34)
Python 2.7.6


Benchmarks Example:
apt-get install git-core
git clone https://github.com/gotlium/rethinkdb-vs-mysql-benchmarks.git
cd rethinkdb-vs-mysql-benchmarks/
ln -sf /bin/bash /bin/sh
./installation.sh
# check mysql and rethink access: pgrep mysqld; pgrep rethinkdb
./run-benchmarks.sh


Original sources author: danielmewes. Original sources url: http://dmewes.com/~daniel/rdb-mysql-bench.zip

On our company we run benchmarks on Golang, and result is very different.
Because Golang is low-level language.
Result: MySQL x50 faster RethinkDB and MongoDB 10x faster RethinkDB (on aggregation between date on 2 million records).

