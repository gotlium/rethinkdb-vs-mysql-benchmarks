Simple benchmarks MySQL vs RethinkDB. Based on discussion https://github.com/rethinkdb/rethinkdb/issues/3245
At first run ./installation.sh on Ubuntu/Linux
And after run benchmarks ./run-benchmarks.sh

Current results (MySQL is faster x10+):

    Insert(x10):
    Running MySQL insert...
    Duration: 33.840152025223 s, CPU: 40-50%

    Running RethinkDB insert...
    Duration: 357.02387881279 s CPU: 400-500%

    Select(x12):
    Running MySQL select...
    Duration: 6.2724659442902 s CPU: 17-35%

    Running RethinkDB select...
    Duration: 79.589710950851 s CPU: 115-125%

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

Example:
apt-get install git-core
git clone https://github.com/gotlium/rethinkdb-vs-mysql-benchmarks.git
cd rethinkdb-vs-mysql-benchmarks/
ln -sf /bin/bash /bin/sh
./installation.sh
./run-benchmarks.sh

Hardware
--------
OS X 10.9.5
2,3 GHz Intel Core i7
16 GB 1600 MHz DDR3
SSD, 676.7MB/s writes, 728.6MB/s read
rethinkdb 1.15.1 (CLANG 6.0 (clang-600.0.51))
mysqld Ver 5.6.21 for osx10.9 on x86_64 (Homebrew)
PHP 5.4.30
Python 2.7.8


Original sources author: danielmewes. Original sources url: http://dmewes.com/~daniel/rdb-mysql-bench.zip
