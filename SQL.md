mysql> CREATE TABLE msboard.users(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY)ENGINE = InnoDB;
ERROR 1049 (42000): Unknown database 'msboard'
mysql> CREATE TABLE msgboard.users(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY)ENGINE = InnoDB;
Query OK, 0 rows affected (0.02 sec)

mysql> ALTER TABLE msboard.users ADD user_name VARCHAR(25) NOT NULL;
ERROR 1146 (42S02): Table 'msboard.users' doesn't exist
mysql> ALTER TABLE msgboard.users ADD user_name VARCHAR(25) NOT NULL;
Query OK, 0 rows affected (0.05 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> ALTER TABLE msgboard.users ADD user_msg VARCHAR(128) NOT NULL;
Query OK, 0 rows affected (0.03 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> USE msgboard;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
mysql> 






```
   1 # For advice on how to change settings please see
   2 # http://dev.mysql.com/doc/refman/5.7/en/server-configuration-defaults.html
   3 
   4 [mysqld]
   5 sql_mode = "STRICT_TRANS_TABLES"
   6                                                                                                                                
   7 #
   8 # Remove leading # and set to the amount of RAM for the most important data
   9 # cache in MySQL. Start at 70% of total RAM for dedicated server, else 10%.
  10 # innodb_buffer_pool_size = 128M
  11 #
  12 # Remove leading # to turn on a very important data integrity option: logging
  13 # changes to the binary log between backups.
  14 # log_bin
  15 #
  16 # Remove leading # to set options mainly useful for reporting servers.
  17 # The server defaults are faster for transactions and fast SELECTs.
  18 # Adjust sizes as needed, experiment to find the optimal values.
  19 # join_buffer_size = 128M
  20 # sort_buffer_size = 2M
  21 # read_rnd_buffer_size = 2M
  22 datadir=/var/lib/mysql
  23 socket=/var/lib/mysql/mysql.sock
  24 
  25 # Disabling symbolic-links is recommended to prevent assorted security risks
  26 symbolic-links=0
  27 
  28 log-error=/var/log/mysqld.log
  29 pid-file=/var/run/mysqld/mysqld.pid
 ~                                                                                                                           
 ```
 my dtrict mode

http://stackoverflow.com/questions/2317650/setting-global-sql-mode-in-mysql

http://www.sfexception.com/talk/active_questions_tagged_symfony_stack_overflow/doctrine_mysql_sql_mode_traditional_and_timestamp_fields

http://www.codedata.com.tw/database/mysql-tutorial-18-errors-warnings/

