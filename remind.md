https://dinbendon.net/do/

https://docs.google.com/spreadsheets/d/1AMzDk4888yVdNYsyJc4mLS3Q19Q0_6o107zDiksqb3I/edit#gid=0

https://docs.google.com/spreadsheets/d/1AMzDk4888yVdNYsyJc4mLS3Q19Q0_6o107zDiksqb3I/edit#gid=967924246

http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/getting-started.html

https://media.readthedocs.org/pdf/doctrine-orm/latest/doctrine-orm.pdf

http://doctrine-user.narkive.com/

http://www.doctrine-project.org/api/orm/2.5/class-Doctrine.ORM.EntityManager.html

407台中市西屯區市政北二路238號   33F - B區

Redis 
Doctrine
Docker
symphony

禮拜五訂便當

https://www.packtpub.com/web-development/mastering-symfony

symfony 不錯的網站


http://e7kan.com/


NGINX 設定 長犯且不該犯的錯誤
https://www.nginx.com/resources/wiki/start/topics/tutorials/config_pitfalls/


[25-May-2017 03:25:04 Europe/London] PHP Parse error:  syntax error, unexpected '/', expecting ',' or ';' in /home/eric_tu/eric_tu/src/AppBundle/Entity/Message.php on line 9

引入 use 的時候要用反斜線



Querying for Objects Using Doctrine's Query Builder¶
Instead of writing a DQL string, you can use a helpful object called the QueryBuilder to build that string for you. This is useful when the actual query depends on dynamic conditions, as your code soon becomes hard to read with DQL as you start to concatenate strings:

```
$repository = $this->getDoctrine()
    ->getRepository('AppBundle:Product');

// createQueryBuilder() automatically selects FROM AppBundle:Product
// and aliases it to "p"
$query = $repository->createQueryBuilder('p')
    ->where('p.price > :price')
    ->setParameter('price', '19.99')
    ->orderBy('p.price', 'ASC')
    ->getQuery();

$products = $query->getResult();
// to get just one result:
// $product = $query->setMaxResults(1)->getOneOrNullResult();
```

The QueryBuilder object contains every method necessary to build your query. By calling the getQuery() method, the query builder returns a normal Query object, which can be used to get the result of the query.

For more information on Doctrine's Query Builder, consult Doctrine's Query Builder documentation.



[2017-05-25 10:12:25] cache.WARNING: Failed to save key "%5BSymfony%5CBundle%5CTwigBundle%5CController%5CExceptionController%23showAction%5D%5B1%5D" (array) {"key":"%5BSymfony%5CBundle%5CTwigBundle%5CController%5CExceptionController%23showAction%5D%5B1%5D","type":"array","exception":"[object] (ErrorException(code: 0): file_put_contents(/home/eric_tu/eric_tu/var/cache/prod/pools/w+GhYT5qWO/59269ff93e10a5.18397140): failed to open stream: Permission denied at /home/eric_tu/eric_tu/var/cache/prod/classes.php:1229)"}

https://stackoverflow.com/questions/13211829/symfony2-failed-to-write-cache-directory
解決方法 修改 /home/eric_tu/eric_tu/var/cache/prod/ 權限


http://www.jb51.net/article/30489.htm
json_encode json_decode


清空暫存檔 

 php bin/console cache:clear --env=prod

 php bin/console cache:clear -e prod

 php bin/console list --no-debug