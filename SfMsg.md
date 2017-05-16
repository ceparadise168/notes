217 2017/05/13 05:27:45 [error] 20957#0: *26 FastCGI sent in stderr: "PHP message: PHP Fatal error:  Uncaught exception 'RuntimeException' with message 'Unable to create the cache directory (/usr/share/nginx/html/SfMsg/var/cache/prod)  


 218 ' in /usr/share/nginx/html/SfMsg/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php:570
 219 Stack trace:
 220 #0 /usr/share/nginx/html/SfMsg/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php(486): Symfony\Component\HttpK     ernel\Kernel->buildContainer()
 221 #1 /usr/share/nginx/html/SfMsg/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php(116): Symfony\Component\HttpK     ernel\Kernel->initializeContainer()
 222 #2 /usr/share/nginx/html/SfMsg/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php(165): Symfony\Component\HttpK     ernel\Kernel->boot()
 223 #3 /usr/share/nginx/html/SfMsg/web/app.php(17): Symfony\Component\HttpKernel\Kernel->handle(Object(Symfony\Component\HttpFounda     tion\Request))
 224 #4 {main}
 225   thrown in /usr/share/nginx/html/SfMsg/vendor/symfony/symfony/src/Symfony/Component/HttpKernel/Kernel.php on line 570" while r     eading response header from upstream, client: 192.168.171.1, server: test123, request: "GET /app.php HTTP/1.1", upstream: "fast     cgi://127.0.0.1:9000", host: "test123"
                                                   

chmod -R 777  var/

主要是最後一個全線要開給nginx 使用                                                       



https://symfony.com/legacy/doc/reference/1_4/en/10-Routing

```
   1 app:
-  2     resource: '@AppBundle/Controller/'
|  3     type: annotation
   4 
   5 # app/config/routing.yml
   6 
   7 #                                                                                                                              
   8 Msg_list:    
-  9     path:    /msgboard
| 10     defaults: { _controller: AppBundle:Msg:list }
  11 
  12 Msg_show:    
- 13     path:    /msgboard/{slug}
| 14     defaults: { _controller: AppBundle:Msg:show }
 ~                                                                                        ```
Thanks to these two routes:

If the user goes to /blog, the first route is matched and listAction() is executed;
If the user goes to /blog/*, the second route is matched and showAction() is executed. Because the route path is /blog/{slug}, a $slug variable is passed to showAction() matching that value. For example, if the user goes to /blog/yay-routing, then $slug will equal yay-routing.

---

*** Routing in Other Formats
The @Route above each method is called an annotation. If you'd rather configure your routes in YAML, XML or PHP, that's no problem!

In these formats, the _controller "defaults" value is a special key that tells Symfony which controller should be executed when a URL matches this route. The _controller string is called the logical name. It follows a pattern that points to a specific PHP class and method, in this case the AppBundle\Controller\BlogController::listAction and AppBundle\Controller\BlogController::showAction methods. ***

---

# Adding {wildcard} Requirements

```
   1 app:
-  2     resource: '@AppBundle/Controller/'
|  3     type: annotation
   4 
   5 # app/config/routing.yml
   6 
   7 # 
   8 Msg_list:
-  9     path:    /msgboard/{id}
| 10     defaults: { _controller: AppBundle:Msg:list }
| 11     requirements:
- 12         id: '\d+'
  13 
  14 Msg_show:
- 15     path:    /msgboard/{slug}
| 16     defaults: { _controller: AppBundle:Msg:show }                                                                                                       
```

The \d+ is a regular expression that matches a digit of any length. Now:

URL	                Route	             Parameters
/blog/2	            blog_list	         $page = 2
/blog/yay-routing   blog_show	         $slug = yay-routing

# Giving {placeholders} a Default Value

```
   1 app:
-  2     resource: '@AppBundle/Controller/'                                                                                         
|  3     type: annotation
   4 
   5 # app/config/routing.yml
   6 
   7 # 
   8 Msg_list:
-  9     path:    /msgboard/{id}
| 10     defaults: { _controller: AppBundle:Msg:list, id: 1 }
| 11     requirements:
- 12         id: '\d+'
  13 
  14 Msg_show:
- 15     path:    /msgboard/{slug}
| 16     defaults: { _controller: AppBundle:Msg:show }
 ~                                                         
 ```

 app/config/config.yml

 dbmame
 user
 password

 ---

 
 
 // src/AppBundle/Entity/Product.php


php bin/console docrtine:schema:update --force
                                       --dump-sql

dactrine:database:drop
dactrine:database:create


# validate

 php bin/console doctrine:schema:validate

```
[eric_tu@localhost SfMsg]$  php bin/console doctrine:schema:validate
[Mapping]  OK - The mapping files are correct.
[Database] OK - The database schema is in sync with the mapping files.
```

# Generating Getters and Setters¶
Even though Doctrine now knows how to persist a Product object to the database, the class itself isn't really useful yet. Since Product is just a regular PHP class with private properties, you need to create public getter and setter methods (e.g. getName(), setName($name)) in order to access its properties in the rest of your application's code. Fortunately, the following command can generate these boilerplate methods automatically:



```
[eric_tu@localhost SfMsg]$  php bin/console doctrine:generate:entities AppBundle/Entity/Message 
Generating entity "AppBundle\Entity\Message"
  > backing up Message.php to Message.php~
  > generating AppBundle\Entity\Message

```