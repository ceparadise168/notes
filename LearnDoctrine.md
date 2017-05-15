Learn Doctrine
===
# GUIDE
http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/getting-started.html

This guide covers getting started with the Doctrine ORM. After working through the guide you should know:

How to install and configure Doctrine by connecting it to a database
Mapping PHP objects to database tables
Generating a database schema from PHP objects
Using the EntityManager to insert, update, delete and find objects in the database.

# install PHP Composer 

http://idroot.net/tutorials/how-to-install-php-composer-on-centos-7/

http://www.jianshu.com/p/4f1df61179e6

```
[eric_tu@localhost ~]$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
[eric_tu@localhost ~]$ php composer-setup.php --install-dir=/usr/bin --filename=composer
All settings correct for using Composer
The installation directory "/usr/bin" is not writable
[eric_tu@localhost ~]$ sudo php composer-setup.php --install-dir=/usr/bin --filename=composer
[sudo] password for eric_tu: 
All settings correct for using Composer
Downloading...

Composer (version 1.4.1) successfully installed to: /usr/bin/composer
Use it: php /usr/bin/composer

[eric_tu@localhost ~]$ php -r "unlink('composer-setup.php');"
[eric_tu@localhost ~]$ composer -v
...

```

# [Doctrine & Symfony](http://www.newlifeclan.com/symfony/archives/491)

https://symfony.com/pdf/Symfony_book_2.8.pdf

http://symfony.com/blog/introducing-the-symfony-doctrine-book


Project Setup

```
[eric_tu@localhost ~]$ mkdir DoctrineToutorial
[eric_tu@localhost ~]$ cd DoctrineToutorial/
```


```
[eric_tu@localhost DoctrineToutorial]$ vim composer.json

   1 {
-  2     "require": {                                                                                          
-  3         "doctrine/orm": "2.4.*",
-  4             "symfony//yaml": "2.*"
|  5     },
-  6         "autoload": {
-  7             "psr-0": {"": "src/"}
2  8         }
   9 }
```                           


```
[eric_tu@localhost DoctrineToutorial]$ composer install
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 13 installs, 0 updates, 0 removals
  - Installing symfony/polyfill-mbstring (v1.3.0): Downloading (100%)         
  - Installing psr/log (1.0.2): Downloading (100%)         
  - Installing symfony/debug (v2.8.20): Downloading (100%)         
  - Installing symfony/console (v2.8.20): Downloading (100%)         
  - Installing doctrine/lexer (v1.0.1): Downloading (100%)         
  - Installing doctrine/inflector (v1.1.0): Downloading (100%)         
  - Installing doctrine/collections (v1.3.0): Downloading (100%)         
  - Installing doctrine/cache (v1.5.4): Downloading (100%)         
  - Installing doctrine/annotations (v1.2.7): Downloading (100%)         
  - Installing doctrine/common (v2.5.3): Downloading (100%)         
  - Installing doctrine/dbal (v2.5.12): Downloading (100%)         
  - Installing doctrine/orm (v2.4.8): Downloading (100%)         
  - Installing symfony/yaml (v2.8.20): Downloading (100%)         
symfony/polyfill-mbstring suggests installing ext-mbstring (For best performance)
symfony/console suggests installing symfony/event-dispatcher ()
symfony/console suggests installing symfony/process ()
Writing lock file
Generating autoload files
[eric_tu@localhost DoctrineToutorial]$ 

```


Add the following directories:

```
[eric_tu@localhost DoctrineToutorial]$ mkdir config;mkdir src;  cd config; mkdir xml; mkdir yaml
```

# Obtaining the EntityManager¶

Doctrine’s public interface is the EntityManager, it provides the access point to the complete lifecycle management of your entities and transforms entities from and back to persistence. You have to configure and create it to use your entities with Doctrine 2. I will show the configuration steps and then discuss them step by step:

```
<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
```



啟動doctrine時失敗
```
[eric_tu@localhost DoctrineToutorial]$ php vendor/bin/doctrine
PHP Fatal error:  Call to undefined function GetEntityManager() in /home/eric_tu/DoctrineToutorial/config/cli-config.php on line 9
```

解決辦法

```
   1 <?php
   2 
   3 // config/cli-config.php                                                                                                         
   4 //use Doctrine\ORM\Tools\Console\ConsoleRunner;
   5 
   6 // replace with file to your own project bootstrap
   7 require_once 'bootstrap.php';
   8 
   9 // replace with mechanism to retrieve EntityManager in your app
  10 //$entityManager = GetEntityManager();
  11 
  12 
  13 //return ConsoleRunner::createHelperSet($entityManager);
  14 return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
  15 
```


# File mapping drivers must have a valid directory path, however the given path [/path] seems to be incorrect!
```
[eric_tu@localhost DoctrineToutorial]$ vendor/bin/doctrine orm:schema-tool:create

                                                                                                                
  [Doctrine\Common\Persistence\Mapping\MappingException]                                                        
  File mapping drivers must have a valid directory path, however the given path [/path] seems to be incorrect!  
                                                                                                                

orm:schema-tool:create [--dump-sql]

```
解決方法
http://stackoverflow.com/questions/18771107/how-to-configure-doctrine-file-mapping-driver-in-zf2
新增一個空的資料夾給他存放實體資料

```

6
down vote
I had exactly the same problem. I solved it by creating an empty Entity directory in the location where doctrine expect me to store my entities. All you have to do is create in following location an empty Entity directory:  __DIR__ . '/../src/Realez/Entity'.
```



You can easily recreate the database:
```
$ vendor/bin/doctrine orm:schema-tool:drop --force
$ vendor/bin/doctrine orm:schema-tool:create
```
Or use the update functionality:
```
$ vendor/bin/doctrine orm:schema-tool:update --force
```


http://stackoverflow.com/questions/17473225/doctrine2-no-metadata-classes-to-process
```
[eric_tu@localhost DoctrineToutorial]$ vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
No Metadata Classes to process.
```


# Generating the Database Schema




---

# 使用symfony 學習doctrine

http://symfony.com/doc/current/doctrine.html


設定 app/config/parameters.yml

設定  app/config/config.php

run ```php bin/console doctrine:database:create```

```
[eric_tu@localhost MyProject]$  php bin/console doctrine:database:create
Created database `test_project` for connection named default
```


可以透過 generate 做設定
```
[eric_tu@localhost MyProject]$  php bin/console doctrine:generate:entity

                                             
  Welcome to the Doctrine2 entity generator  
                                             


This command helps you generate Doctrine2 entities.

First, you need to give the entity name you want to generate.
You must use the shortcut notation like AcmeBlogBundle:Post.

The Entity shortcut name: 

```

也可以手動產生  使用metadata的格式 

要注意的是一個bundle裡面只能吃一個metadate 

不能同時放YAML XML annotations

如果省略tabel name 的話 就會自動使用Class Name 代替

You'll provide this mapping information in the form of "metadata", a collection of rules that tells Doctrine exactly how the Product class and its properties should be mapped to a specific database table. This metadata can be specified in a number of different formats, including YAML, XML or directly inside the Product class via DocBlock annotations:


```
// src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;
}
```

```
[eric_tu@localhost MyProject]$  php bin/console doctrine:schema:validate
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5BAppBundle%5CEntity%5CProduct%24id%40%5BAnnot%5D%5D%5B1%5D" (array) {"key":"%5BAppBundle%5CEntity%5CProduct%24id%40%5BAnnot%5D%5D%5B1%5D","type":"array","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/E/6/U4H0BHL2EQ88g3YmK+ph): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5B%5BC%5DAppBundle%5CEntity%5CProduct%24id%40%5BAnnot%5D%5D%5B1%5D" (integer) {"key":"%5B%5BC%5DAppBundle%5CEntity%5CProduct%24id%40%5BAnnot%5D%5D%5B1%5D","type":"integer","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/L/H/az+nTSFt3kwu3RNMZ1Hi): Permission denied at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5BAppBundle%5CEntity%5CProduct%24name%40%5BAnnot%5D%5D%5B1%5D" (array) {"key":"%5BAppBundle%5CEntity%5CProduct%24name%40%5BAnnot%5D%5D%5B1%5D","type":"array","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/U/9/egp-EjlPnVg5UDIFWK43): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5B%5BC%5DAppBundle%5CEntity%5CProduct%24name%40%5BAnnot%5D%5D%5B1%5D" (integer) {"key":"%5B%5BC%5DAppBundle%5CEntity%5CProduct%24name%40%5BAnnot%5D%5D%5B1%5D","type":"integer","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/6/1/BU3ZLPGkSwQFthLVVdjY): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5BAppBundle%5CEntity%5CProduct%24price%40%5BAnnot%5D%5D%5B1%5D" (array) {"key":"%5BAppBundle%5CEntity%5CProduct%24price%40%5BAnnot%5D%5D%5B1%5D","type":"array","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/Q/I/OQPYJjmpYaXeDnUw5S6v): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5B%5BC%5DAppBundle%5CEntity%5CProduct%24price%40%5BAnnot%5D%5D%5B1%5D" (integer) {"key":"%5B%5BC%5DAppBundle%5CEntity%5CProduct%24price%40%5BAnnot%5D%5D%5B1%5D","type":"integer","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/6/7/AvQvZmgc3JFW8DVeG2Uk): Permission denied at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5BAppBundle%5CEntity%5CProduct%24description%40%5BAnnot%5D%5D%5B1%5D" (array) {"key":"%5BAppBundle%5CEntity%5CProduct%24description%40%5BAnnot%5D%5D%5B1%5D","type":"array","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/B/Q/TwPVg2PfAZ2FkFHvduqi): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[2017-05-11 09:11:34] cache.WARNING: Failed to save key "%5B%5BC%5DAppBundle%5CEntity%5CProduct%24description%40%5BAnnot%5D%5D%5B1%5D" (integer) {"key":"%5B%5BC%5DAppBundle%5CEntity%5CProduct%24description%40%5BAnnot%5D%5D%5B1%5D","type":"integer","exception":"[object] (ErrorException(code: 0): rename(/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/59141cb6b03849.50113194,/home/eric_tu/MyProject/var/cache/dev/pools/Xegxnk3wGb/W/G/tNsnVcaUbc7V5CWxgMJG): No such file or directory at /home/eric_tu/MyProject/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapterTrait.php:93)"} 
[Mapping]  OK - The mapping files are correct.
[Database] FAIL - The database schema is not in sync with the current mapping file.
[eric_tu@localhost MyProject]$ 
```


# [Database] FAIL - The database schema is not in sync with the current mapping file.

解法:
https://www.orocrm.com/forums/topic/doctrineschemavalidate-always-return-database-is-not-in-sync
https://github.com/doctrine/doctrine2/issues/3810

This happens because MySQL does not have a native type for DateTimeTz, therefore the mapping always falls back to the native DATETIME type.

```
[eric_tu@localhost MyProject]$  php bin/console doctrine:schema:update --force

...

Updating database schema...
Database schema updated successfully! "1" query was executed


```

```
[eric_tu@localhost MyProject]$  php bin/console doctrine:schema:validate

...

[Mapping]  OK - The mapping files are correct.
[Database] OK - The database schema is in sync with the mapping files.


```

成功把資料映射

之後我們還區樣建立CURD的方法例如 getName(), setName($name) 等等，
不過幸運的是docrtine可以幫助我們快速建立。

```
[eric_tu@localhost MyProject]$  php bin/console doctrine:generate:entities AppBundle/Entity/Product


 ...


  > backing up Product.php to Product.php~
  > generating AppBundle\Entity\Product

```


更新

```
php bin/console doctrine:schema:update --force
```



# Persisting Objects to the Database


再來要把我們產生的資料表作為實體儲存到資料庫中
新增一些function到Controller中


Persisting Objects to the Database¶
Now that you have mapped the Product entity to its corresponding product table, you're ready to persist Product objects to the database. From inside a controller, this is pretty easy. Add the following method to the DefaultController of the bundle:


```
// src/AppBundle/Controller/DefaultController.php

// ...
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

// ...
public function createAction()
{
    $product = new Product();
    $product->setName('Keyboard');
    $product->setPrice(19.99);
    $product->setDescription('Ergonomic and stylish!');

    $em = $this->getDoctrine()->getManager();

    // tells Doctrine you want to (eventually) save the Product (no queries yet)
    $em->persist($product);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new product with id '.$product->getId());
```

用完大概長這樣

```

   1 <?php                                                                                                                         
   2 
   3 namespace AppBundle\Controller;
   4 
   5 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
   6 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
   7 use Symfony\Component\HttpFoundation\Request;
   8 
   9 use AppBundle\Entity\Product;
  10 use Symfony\Component\HttpFoundation\Response
  11 
  12 class DefaultController extends Controller
  13 {
- 14     /**
| 15      * @Route("/", name="homepage")
| 16      */
| 17     public function indexAction(Request $request)
| 18     {
- 19         // replace this example code with whatever you need
2 20         return $this->render('default/index.html.twig', [
- 21                 'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
4 22                 ]);
| 23     }
  24 }
  25 
  26 public function createAction()
  27 {
- 28     $product = new Product();
| 29     $product->setName('Keyboard');
| 30     $product->setPrice(19.99);
| 31     $product->setDescription('Ergonomic and stylish!');
| 32 
| 33     $em = $this->getDoctrine()->getManager();
| 34 
| 35     // tells Doctrine you want to (eventually) save the Product (no queries yet)
| 36     $em->persist($product);
| 37 
| 38     // actually executes the queries (i.e. the INSERT query)
| 39     $em->flush();
| 40 
| 41     return new Response('Saved new product with id '.$product->getId());
  42 }
```


# Fetching Objects from the Database