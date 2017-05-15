PHP + MYSQL + NGINX
===
查一下版本資訊，使用 ``` cat /etc/os-release```
```
[root@localhost tmp]# cat /etc/os-release 
NAME="CentOS Linux"
VERSION="7 (Core)"
ID="centos"
ID_LIKE="rhel fedora"
VERSION_ID="7"
PRETTY_NAME="CentOS Linux 7 (Core)"
ANSI_COLOR="0;31"
CPE_NAME="cpe:/o:centos:centos:7"
HOME_URL="https://www.centos.org/"
BUG_REPORT_URL="https://bugs.centos.org/"

CENTOS_MANTISBT_PROJECT="CentOS-7"
CENTOS_MANTISBT_PROJECT_VERSION="7"
REDHAT_SUPPORT_PRODUCT="centos"
REDHAT_SUPPORT_PRODUCT_VERSION="7"
```

先安裝NGINX

```
[root@localhost tmp]# sudo yum install nginx
Loaded plugins: fastestmirror
base                                                                 | 3.6 kB  00:00:00     
extras                                                               | 3.4 kB  00:00:00     
updates                                                              | 3.4 kB  00:00:00     
Loading mirror speeds from cached hostfile
 * base: ftp.cuhk.edu.hk
 * extras: ftp.cuhk.edu.hk
 * updates: ftp.cuhk.edu.hk
No package nginx available.
Error: Nothing to do

```
[Sol.](http://stackoverflow.com/questions/27244511/no-package-nginx-available-error-centos-6-5)

要先安裝 EPEL repo 才抓的到

```
yum install epel-release
```

```
yum install epel-release
```
成功了!

```
yum install traceroute
```

```
[root@localhost tmp]# sudo systemctl enable nginx
````
開機時自動啟動

安裝PHP
```
[root@localhost nginx]# yum -y install php

```
成功!
```
[root@localhost nginx]# php -v
PHP 5.4.16 (cli) (built: Nov  6 2016 00:29:02) 
Copyright (c) 1997-2013 The PHP Group
Zend Engine v2.4.0, Copyright (c) 1998-2013 Zend Technologies
[root@localhost nginx]# nginx -v
nginx version: nginx/1.10.2
```
```
yum update
```
```
 sudo rpm -Uvh mysql57-community-release-el6-n.noarch.rpm
```
找不到?
```
yum install wget 
```
```
wget http://dev.mysql.com/get/mysql57-community-release-el7-7.noarch.rpm
```
找到了!抓下來...

安裝
```
yum localinstall mysql57-community-release-el7-7.noarch.rpm
```

確定已經裝好了
```
yum repolist enabled | grep "mysql.*-community.*"
```

安裝發行版...

```
yum install mysql-community-server
```

啟動
```
[root@localhost nginx]# service mysqld start

```

確認狀態
```
[root@localhost nginx]# service mysqld status
Redirecting to /bin/systemctl status  mysqld.service
● mysqld.service - MySQL Server
   Loaded: loaded (/usr/lib/systemd/system/mysqld.service; enabled; vendor preset: disabled)
   Active: active (running) since 三 2017-05-03 13:55:19 CST; 1min 32s ago
     Docs: man:mysqld(8)
           http://dev.mysql.com/doc/refman/en/using-systemd.html
  Process: 55481 ExecStart=/usr/sbin/mysqld --daemonize --pid-file=/var/run/mysqld/mysqld.pid $MYSQLD_OPTS (code=exited, status=0/SUCCESS)
  Process: 55407 ExecStartPre=/usr/bin/mysqld_pre_systemd (code=exited, status=0/SUCCESS)
 Main PID: 55484 (mysqld)
   CGroup: /system.slice/mysqld.service
           └─55484 /usr/sbin/mysqld --daemonize --pid-file=/var/run/mysqld/mysqld.pid

 5月 03 13:55:13 localhost.localdomain systemd[1]: Starting MySQL Server...
 5月 03 13:55:19 localhost.localdomain systemd[1]: Started MySQL Server.
```


PHP + MYSQL + NGINX 版本資訊
```
[root@localhost nginx]# php -v; mysql -V; nginx -v
PHP 5.4.16 (cli) (built: Nov  6 2016 00:29:02) 
Copyright (c) 1997-2013 The PHP Group
Zend Engine v2.4.0, Copyright (c) 1998-2013 Zend Technologies
mysql  Ver 14.14 Distrib 5.7.18, for Linux (x86_64) using  EditLine wrapper
nginx version: nginx/1.10.2

```
[MYSQL版本更新](http://ithelp.ithome.com.tw/questions/10086439)

https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-12-04


```
yum install php-fpm php-mysql
```
查看 php-fpm 的啟動設定
```
[root@localhost nginx]# systemctl list-unit-files | grep php-fpm
php-fpm.service                               disabled

```
改成開機啟動
```
[root@localhost nginx]# systemctl enable php-fpm
Created symlink from /etc/systemd/system/multi-user.target.wants/php-fpm.service to /usr/lib/systemd/system/php-fpm.service.

```

啟動然後檢查
```
[root@localhost nginx]# systemctl start php-fpm
[root@localhost nginx]# systemctl status php-fpm
● php-fpm.service - The PHP FastCGI Process Manager
   Loaded: loaded (/usr/lib/systemd/system/php-fpm.service; enabled; vendor preset: disabled)
   Active: active (running) since 三 2017-05-03 14:18:30 CST; 9s ago
 Main PID: 55678 (php-fpm)
   Status: "Ready to handle connections"
   CGroup: /system.slice/php-fpm.service
           ├─55678 php-fpm: master process (/etc/php-fpm.conf)
           ├─55679 php-fpm: pool www
           ├─55680 php-fpm: pool www
           ├─55681 php-fpm: pool www
           ├─55682 php-fpm: pool www
           └─55683 php-fpm: pool www

 5月 03 14:18:30 localhost.localdomain systemd[1]: Starting The PHP FastCGI Process Man....
 5月 03 14:18:30 localhost.localdomain systemd[1]: Started The PHP FastCGI Process Manager.
Hint: Some lines were ellipsized, use -l to show in full.
```


編輯
```
vim /etc/php5/fpm/php.ini
```
找到這一行改成 0
```
cgi.fix_pathinfo=0
```


[how-to-install-linux-nginx-mysql-php-lemp-stack](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-12-04)


```
vim /usr/share/nginx/html/info.php
```

```
<?php
phpinfo();
?>
```

```
sudo service nginx restart
```

```
wget http://127.0.0.1/info.php
```
```
[root@localhost html]# wget http://127.0.0.1/info.php
--2017-05-03 18:08:16--  http://127.0.0.1/info.php
正在連接 127.0.0.1:80... 連上了。
已送出 HTTP 要求，正在等候回應... 200 OK
長度: 21 [application/octet-stream]
Saving to: ‘info.php.1’

100%[==================================================>] 21          --.-K/s   in 0s      

2017-05-03 18:08:16 (1.26 MB/s) - ‘info.php.1’ saved [21/21]
```

install ogrok in centOS

http://www.racksam.com/2016/12/18/centos7-install-ngrok/

wget --page-requisites https://blog.longwin.com.tw/




# 純文字瀏覽器
###  Installation of Lynx and Links
https://www.tecmint.com/command-line-web-browsers/

```
lynx http:/127.0.0.1
```

```
[root@localhost local]# ls /etc/php*
/etc/php-fpm.conf  /etc/php.ini

/etc/php.d:
curl.ini      json.ini    mysql.ini  pdo_mysql.ini   phar.ini     zip.ini
fileinfo.ini  mysqli.ini  pdo.ini    pdo_sqlite.ini  sqlite3.ini

/etc/php-fpm.

```

進到 C:\Windows\System32\drivers\etc\ 
編輯 host 加上對應的 IP


# /etc/nginx/conf.d/default.conf
```
server {
    server_name example.toright.com;
    root /usr/share/nginx/html;
    index index.html index.php index.htmi index.php;

    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;

    # set expiration of assets to MAX for caching
    location ~* \.(ico|css|js|gif|jpe?g|png|ogg|ogv|svg|svgz|eot|otf|woff)(\?.+)?$ {
        expires max;
        log_not_found off;
    }

    server_tokens off;

    # framework rewrite
    location / {
        try_files $uri $uri/ /index.php;
    }

    location ~* \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_split_path_info ^(.+\.php)(.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

example.toright.com



var/run/php-fpm/

http://stackoverflow.com/questions/35367676/php-fpm-doesnt-create-sock-file

# php-fpm doesn't create .sock file

更改 etc/nginx/conf.d 

將原本的 var/run/php-fpm/php-fpm.sock;
改成 fastcgi_pass 127.0.0.1:9000;

```
Edit: The real solution here is that the listen in www.conf and fastcgi_pass in nginx configuration have to match. Whether you use sockets or tcp is up to you.

The answer was to not use a .sock file at all. in /etc/php-fpm.d/www.conf it has listen = 127.0.0.1:9000 so in my nginx config I put fastcgi_pass 127.0.0.1:9000; instead of using something like fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
```

Stop PHP FPM command: service php-fpm stop

Start PHP FPM command: service nginx start

Restart PHP FPM command: service php-fpm restart

Reload PHP FPM command: service php-fpm reload

---

# Nginx 相關檔案位置：

所有設定檔：/etc/nginx/
主要設定檔：/etc/nginx/nginx.conf
預設設定檔：/etc/nginx/conf.d/default.conf
程序設定檔：/usr/sbin/nginx
# log 檔：/var/log/nginx/
# html /usr/share/nginx/html
---

Windows 如何清除暫存的 DNS Cache
發表於 2010 年 12 月 16 日 由 Tsung
只要是查詢過的 DNS, 都會暫存一段時間, 於 Windows 要清掉 DNS Cache, 要如何清除?


於 Windows 要清掉 DNS Cache
方法1
執行 cmd
ipconfig /flushdns
看到此行字即完成: successfully flushed the dns resolver cache

方法2
控制台 -> 管理工具 -> 服務
重新啟動 DNS Client 和 DHCP Client 服務即可.
https://blog.longwin.com.tw/2010/12/windows-clear-dns-cache-2010/
---

# usr/share/nginx/html/

---


# XSHELL 

tools -> opitions -> keyboard and mouse

Right-btn :  paste the clipborard contents.
selection : \ :;~`!@#$%^&*()-=+|[]{}'",.<>/?
copy selected text to the clipboard automatically

---

# MYSQL SETTING

```
[root@localhost conf.d]# sudo service mysqld start
Redirecting to /bin/systemctl start  mysqld.service
[root@localhost conf.d]# sudo grep 'temporary password' /var/log/mysqld.log
2017-05-03T05:55:14.109793Z 1 [Note] A temporary password is generated for root@localhost: TaiOnb;3!B3k
[root@localhost conf.d]# 
```
```
[root@localhost conf.d]# mysql -uroot -p
Enter password: 
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 21
Server version: 5.7.18

Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'Eric_tu168';
```

```
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'Eric_tu';
ERROR 1819 (HY000): Your password does not satisfy the current policy requirements
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'Eric_tu168';
Query OK, 0 rows affected (0.01 sec)

mysql> SHOW databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
4 rows in set (0.05 sec)

mysql> 

```

If something goes wrong during installation, you might find debug information in the error log file /var/log/mysqld.log.


```
mysql> CREATE DATABASE msgbaord;
Query OK, 1 row affected (0.00 sec)

mysql> USE msgboard
ERROR 1049 (42000): Unknown database 'msgboard'

mysql> DROP DATABASE msgbaord;
Query OK, 0 rows affected (0.06 sec)

mysql> CREATE DATABASE msgboard;
Query OK, 1 row affected (0.01 sec)

mysql> USE msgboard;
Database changed

```

---

```
mysql> CREATE TABLE msglist ( user VARCHAR(25) NOT NULL , text VARCHAR(128) NOT NULL ) ENGINE = InnoDB;
Query OK, 0 rows affected (0.08 sec)
```



```
2017/05/04 04:01:55 [error] 58831#0: 

*56 FastCGI sent in stderr: 

"PHP message: PHP Warning:  

mysql_connect(): 
Headers and client library minor version mismatch.

Headers:
50550 

Library:
50631 in /usr/share/nginx/html/msg_board/dbconfig.php on line 6" while reading response header from upstream,

client: 192.168.171.1, 

server: test123, 

request: "POST /msg_board/add_data.php HTTP/1.1", 

upstream: "fastcgi://127.0.0.1:9000", host: "test123",

referrer: "http://test123/msg_board/add_data.php"

```

版本不符合
http://stackoverflow.com/questions/10759334/headers-and-client-library-minor-version-mismatch

先將PHP的資訊列出來

php -i > log.txt

vim log.txt

/API
可以發現
Client API library version => 5.6.31

Client API header version => 5.5.50-MariaDB


[root@localhost nginx]# mysql -V
mysql  Ver 14.14 Distrib 5.7.18, for Linux (x86_64) using  EditLine wrapper

[root@localhost nginx]# php -v
PHP 5.4.16 (cli) (built: Nov  6 2016 00:29:02) 

---

yum list|grep -i mysql

php-mysqlnd.x86_64     5.4.16-42.el7         base


修改 edit_data query update users  新增ID


407台中市西屯區市政北二路238號   33F - B區



https://www.digitalocean.com/community/questions/help-me-to-fix-err_connection_refused

解決 err_connection_refused
1.關閉防火牆
2.建立相對應的日誌
```
mkdir -p /var/log/nginx/mysitename/
touch /var/log/nginx/mysitename/access.log

```

```
[root@localhost ~]# mysql
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: NO)
```

http://mustgeorge.blogspot.tw/2011/11/mysql-error-1045-28000-using-password.html
https://dev.mysql.com/doc/refman/5.7/en/adding-users.html

# creat user

先使用root登入
```
[root@localhost ~]# mysql -u root -p
Enter password: 
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 11
Server version: 5.7.18 MySQL Community Server (GPL)

Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> CREATE USER 'eric_tu'@'localhost' IDENTIFIED BY 'Eric_tu168';
Query OK, 0 rows affected (0.02 sec)

```

```
mysql> GRANT ALL PRIVILEGES ON *.* TO 'eric_tu'@'localhost';
Query OK, 0 rows affected (0.01 sec)

```

切回 eric_tu@

```
[eric_tu@localhost DoctrineToutorial]$ mysql -u eric_tu -p
Enter password: 
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 14
Server version: 5.7.18 MySQL Community Server (GPL)

Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> 
```




更新PHP 5.4 到 5.6 後各種設定跑掉

確定一下php-fpm 各種設定 

nginx 應該不用動 不過要重啟

權限要設定好  

更改 conf.d/default  中的 user 從apache 到 nginx


```
systemctl disable firewalld

systemctl stop firewalld

systemctl status firewalld
```



# https://kknews.cc/other/qye96lb.html 詳細


# How to Fix PHP Error: Call to undefined function posix_getpwuid()


```
yum install php-posix

```


解決無法用ssh連入的問題

```
Connecting to 172.17.11.147:22...
Could not connect to '172.17.11.147' (port 22): Connection failed.

Type `help' to learn how to use Xshell prompt.
Xshell:\>
```

先關掉防火牆重啟看看
```
出现这种情况的原因：
1.服务器端防火墙关闭了22端口，没有开启ssh服务；
2.没有安装ssh；
解决原因1：使用netstat,查看是否启动shh服务；
开启ssh服务：service sshd start
关闭ssh服务：service sshd stop
重启ssh服务：servcie sshd restart
SSH服务开机自动启动：chkconfig sshd on
取消开机自启动:chkconfig sshd off
开启服务后，检查服务状态：service sshd status
解决原因2：安装ssh：
yum install openssh-server
```

沒用 

service ssh status

```
sshd.service - OpenSSH server daemon
   Loaded: loaded (/usr/lib/systemd/system/sshd.service; enabled)
   Active: activating (auto-restart) (Result: exit-code) since Thu 2016-05-05 03:30:48 UTC; 2s ago
  Process: 10938 ExecReload=/bin/kill -HUP $MAINPID (code=exited, status=0/SUCCESS)
  Process: 10944 ExecStart=/usr/sbin/sshd -D $OPTIONS (code=exited, status=255)
 Main PID: 10944 (code=exited, status=255)

May 05 03:30:48 ixnetwork-uk1 systemd[1]: sshd.service: main process exited, code=exited, status=255/n/a
May 05 03:30:48 ixnetwork-uk1 systemd[1]: Unit sshd.service entered failed state.
```

# SELinux
https://blog.ixnet.work/2016/05/05/change-centos-ssh-port/

https://serverfault.com/questions/538037/sshd-service-fails-to-start

http://asherwang.blog.51cto.com/11255017/1894122

 yum provides /usr/sbin/semanage

 yum -y install policycoreutils-python


 semanage port -l | grep ssh

 只允許port 22

 http://sharadchhetri.com/2014/10/15/centos-7-rhel-7-change-openssh-port-number-selinux-enabled/

 去修改ssd_config port 然後新增規則





# 永久性的關掉 selinux 

$ sudo vi /etc/sysconfig/selinux     

找到
SELINUX=enforcing
然後修改為
SELINUX=disabled
要重新開機 reboot / restart 後才會套用

http://blog.xuite.net/tolarku/blog/195633562-CentOS+%E9%97%9C%E9%96%89+selinux

終於成功了QQ



