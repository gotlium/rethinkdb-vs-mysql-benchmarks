#!/bin/bash

apt-get update && apt-get upgrade -y
apt-get install -y python-software-properties software-properties-common

echo | add-apt-repository ppa:ondrej/mysql-5.6
apt-get update && apt-get install -y mysql-server-5.6

source /etc/lsb-release && echo "deb http://download.rethinkdb.com/apt $DISTRIB_CODENAME main" | tee /etc/apt/sources.list.d/rethinkdb.list
wget -qO- http://download.rethinkdb.com/apt/pubkey.gpg | apt-key add -
apt-get update && apt-get install -y rethinkdb

apt-get install -y php5-cli php5-mysql

cp configs/sysctl.conf /etc/sysctl.conf
sysctl -p

cp configs/mysql.ini /etc/mysql/my.cnf
/etc/init.d/mysql restart

cp configs/rethinkdb.conf /etc/rethinkdb/instances.d/default.conf
/etc/init.d/rethinkdb restart

echo "Reset MySQL password to empty. Enter installation password, if it set."
mysqladmin -u root -p password ''
mysql -uroot -e 'create database tests;'

rethinkdb admin create database tests
rethinkdb admin create table t1 --database tests
