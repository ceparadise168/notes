#Symfony
 http://symfony.com/doc/current/setup.html

```
[eric_tu@localhost ~]$ symfony new MyProject


                                                                        
  [RuntimeException]                                                    
  The selected version (3.2.8) cannot be installed because it requires  
  PHP 5.5.9 or higher and your system has PHP 5.4.16 installed.         

```

http://www.techoism.com/how-to-upgrade-php-version-5-4-to-5-6-on-centosrhel/
更新到5.6



把Nginx root 改到 專案下的web\


解決權限不足的問題:

ACL umask(0000) 777   umask(0002) 755

### http://symfony.com/doc/current/setup/file_permissions.html

http://linux.vbird.org/linux_basic/0410accountmanager.php#acl_talk_what

http://symfony.com/doc/current/setup/file_permissions.html

沒有解決.........QQ

重開機PHPFPM NGINX 修改群組跟全縣 755 ROOT:ERIC_TU 之後可以了


---


# 一些問題

 php bin/symfony_requirements
```
[eric_tu@localhost MyProject]$  php bin/symfony_requirements

Symfony Requirements Checker
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

> PHP is using the following php.ini file:
  /etc/php.ini

> Checking Symfony requirements:
  .............................W...W........

                                              
 [OK]                                         
 Your system is ready to run Symfony projects 
                                              

Optional recommendations to improve your setup
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

 * posix_isatty() should be available
   > Install and enable the php_posix extension (used to colorize the
   > CLI output).

 * intl ICU version installed on your system is outdated (50.1.2) and
   does not match the ICU data bundled with Symfony (58.2)
   > To get the latest internationalization data upgrade the ICU
   > system package and the intl PHP extension.


Note  The command console could use a different php.ini file
~~~~  than the one used with your web server. To be on the
      safe side, please check the requirements from your web
      server using the web/config.php script.
```


# ????????????????????
```
Uncaught PHP Exception Symfony\Component\Debug\Exception\FatalErrorException: "Parse Erro     r: syntax error, unexpected 'class' (T_CLASS), expecting ',' or ';'"
```




[root@localhost MyProject]# php bin/console server:start --force



http://symfony.com/doc/current/setup/file_permissions.html



wann 權限不足 
http://stackoverflow.com/questions/27367388/symfony-permission-denied

Similar symfony permissions issue this worked for me:
```
sudo chown <yourcliusername> /var/lib/php5
```
Source: http://stackoverflow.com/a/33991320/1438029



# /nginx-403-forbidden-for-all-files

http://stackoverflow.com/questions/6795350/nginx-403-forbidden-for-all-files

```

30
down vote
I solved this problem by adding user settings.

in nginx.conf

worker_processes 4;
user username
change the 'username' with linux user name.

shareimprove this answer
```



---

LuckyController 

權限問題 修改cashe下面的權限
還是不行
直接用sodo開 可以了可是位置會跑掉 跑到nginx下面 問號

LuckyNumber 檔名似乎一定要用Controller結尾 不然抓不到



--- 

新增LuckyController 後
用root啟動
可以看見成功跑出數字

再來要改使用render的方式將數字傳出

---
# 前端部分先跳過


```
 1 <?php
   2 
   3 namespace AppBundle\Controller;
   4 
   5 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
   6 
   7 use Symfony\Component\HttpFoundation\Response;
   8 
   9 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  10 
  11 
  12 class LuckyController                                                                                                          
  13 {
  14 
- 15   /**
| 16    * @Route("/lucky/number/{max}")
| 17    */
  18 
- 19   public function numberAction($max)
| 20   { 
| 21     $number = mt_rand(0, $max);
| 22 
| 23     return new Response(
| 24       '<html><body>Lucky number: '.$number.'</body></html>'
| 25     );
| 26   } 
| 27 }
  28 
 ~                  
 ```

 