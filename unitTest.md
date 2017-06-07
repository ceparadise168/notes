```
[eric_tu@localhost eric_tu]$ composer require --dev phpunit/phpunit ^5.7
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 23 installs, 0 updates, 0 removals
  - Installing sebastian/version (2.0.1): Downloading (100%)         
  - Installing sebastian/resource-operations (1.0.0): Downloading (100%)         
  - Installing sebastian/recursion-context (2.0.0): Downloading (100%)         
  - Installing sebastian/object-enumerator (2.0.1): Downloading (100%)         
  - Installing sebastian/global-state (1.1.1): Loading from cache
  - Installing sebastian/exporter (2.0.0): Downloading (100%)         
  - Installing sebastian/environment (2.0.0): Downloading (100%)         
  - Installing sebastian/diff (1.4.3): Downloading (100%)         
  - Installing sebastian/comparator (1.2.4): Loading from cache
  - Installing phpunit/php-text-template (1.2.1): Loading from cache
  - Installing phpunit/phpunit-mock-objects (3.4.3): Downloading (100%)         
  - Installing phpunit/php-timer (1.0.9): Loading from cache
  - Installing phpunit/php-file-iterator (1.4.2): Loading from cache
  - Installing sebastian/code-unit-reverse-lookup (1.0.1): Downloading (100%)         
  - Installing phpunit/php-token-stream (1.4.11): Loading from cache
  - Installing phpunit/php-code-coverage (4.0.8): Downloading (100%)         
  - Installing webmozart/assert (1.2.0): Loading from cache
  - Installing phpdocumentor/reflection-common (1.0): Loading from cache
  - Installing phpdocumentor/type-resolver (0.2.1): Loading from cache
  - Installing phpdocumentor/reflection-docblock (3.1.1): Loading from cache
  - Installing phpspec/prophecy (v1.7.0): Loading from cache
  - Installing myclabs/deep-copy (1.6.1): Downloading (100%)         
  - Installing phpunit/phpunit (5.7.20): Downloading (100%)         
sebastian/global-state suggests installing ext-uopz (*)
phpunit/php-code-coverage suggests installing ext-xdebug (^2.5.1)
phpunit/phpunit suggests installing phpunit/php-invoker (~1.1)
phpunit/phpunit suggests installing ext-xdebug (*)
Writing lock file
Generating autoload files
> Incenteev\ParameterHandler\ScriptHandler::buildParameters
Updating the "app/config/parameters.yml" file
> Sensio\Bundle\DistributionBundle\Composer\ScriptHandler::buildBootstrap
> Sensio\Bundle\DistributionBundle\Composer\ScriptHandler::clearCache

 // Clearing the cache for the dev environment with debug                       
 // true                                                                        

                                                                                
 [OK] Cache for the "dev" environment (debug=true) was successfully cleared.    
                                                                                

> Sensio\Bundle\DistributionBundle\Composer\ScriptHandler::installAssets

 Trying to install assets as relative symbolic links.

 -- -------- ---------------- 
     Bundle   Method / Error  
 -- -------- ---------------- 

                                                                                
 [OK] All assets were successfully installed.                                   
                                                                                

```

```
vendor/bin/phpunit learnPHPUnit/person
```

composer require --dev phpunit/php-invoker

composer require --dev phpunit/dbunit


[eric_tu@localhost eric_tu]$ vendor/bin/phpunit learnPHPUnit/personTest.php 
PHP Warning:  Uncaught require_once(PHPUnit/Framework/TestCase.php): failed to open stream: No such file or directory

/home/eric_tu/eric_tu/vendor/symfony/phpunit-bridge/DeprecationErrorHandler.php:73
/home/eric_tu/eric_tu/learnPHPUnit/personTest.php:3
/home/eric_tu/eric_tu/learnPHPUnit/personTest.php:3


```
   1 <?php~                                                                                                    
   2 ~
   3 namespace Tests\AppBundle\Controller;~
   4 ~
   5 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;~
   6 ~
   7 class DefaultControllerTest extends WebTestCase~
   8 {~
-  9     public function testIndex()~
| 10     {~
- 11         $client = static::createClient();~
2 12 ~
2 13         $crawler = $client->request('GET', '/');~
2 14 ~
2 15         $this->assertEquals(200, $client->getResponse()->getStatusCode());~
2 16         $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());~
| 17     }~
  18 }~


```



phpunit in symfony
vendor/phpunit/phpunit/tests/Framework


[eric_tu@localhost Framework]$ ll
總計 240
-rw-rw-r--. 1 eric_tu eric_tu 101539  5月 31 08:31 AssertTest.php
-rw-rw-r--. 1 eric_tu eric_tu    719  5月 31 08:31 BaseTestListenerTest.php
drwxrwxr-x. 3 eric_tu eric_tu   4096  5月 31 08:31 Constraint
-rw-rw-r--. 1 eric_tu eric_tu  85400  5月 31 08:31 ConstraintTest.php
-rw-rw-r--. 1 eric_tu eric_tu   9377  5月 31 08:31 SuiteTest.php
-rw-rw-r--. 1 eric_tu eric_tu  21160  5月 31 08:31 TestCaseTest.php
-rw-rw-r--. 1 eric_tu eric_tu    610  5月 31 08:31 TestFailureTest.php
-rw-rw-r--. 1 eric_tu eric_tu    651  5月 31 08:31 TestImplementorTest.php
-rw-rw-r--. 1 eric_tu eric_tu   2809  5月 31 08:31 TestListenerTest.php
[eric_tu@localhost Framework]$ pwd
/home/eric_tu/eric_tu/vendor/phpunit/phpunit/tests/Framework



---


https://symfony.com/doc/current/testing.html

# Unit Tests

通常拿來測試entity

A unit test is a test against a single PHP class, also called a unit. If you want to test the overall behavior of your application, see the section about Functional Tests.

Writing Symfony unit tests is no different from writing standard PHPUnit unit tests. Suppose, for example, that you have an incredibly simple class called Calculator in the Util/ directory of the app bundle:


```php
<?php
// src/AppBundle/Util/Calculator.php
namespace AppBundle\Util;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
```

```php
<?php
// tests/AppBundle/Util/CalculatorTest.php
namespace Tests\AppBundle\Util;

use AppBundle\Util\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}
```

By convention, the tests/AppBundle directory should replicate the directory of your bundle for unit tests. So, if you're testing a class in the src/AppBundle/Util/ directory, put the test in the tests/AppBundle/Util/ directory.

```bash=
[eric_tu@localhost eric_tu]$ vendor/bin/phpunit src/AppBundle/Util/CalculatorTest.php 
PHPUnit 5.7.20 by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: 35 ms, Memory: 3.25MB

OK (1 test, 1 assertion)
```


# Functional Tests

通常拿來測試API

Functional tests check the integration of the different layers of an application (from the routing to the views). They are no different from unit tests as far as PHPUnit is concerned, but they have a very specific workflow:

Make a request;
Test the response;
Click on a link or submit a form;
Test the response;
Rinse and repeat.
```php
// tests/AppBundle/Controller/PostControllerTest.php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/hello-world');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );
    }
}
```
### symfony API
http://api.symfony.com/3.3/Symfony/Component/DomCrawler/Crawler.html#method_html

https://phpunit.de/manual/current/en/appendixes.assertions.html

assertGreaterThan()
assertGreaterThan(mixed $expected, mixed $actual[, string $message = ''])

Reports an error identified by $message if the value of $actual is not greater than the value of $expected.

assertAttributeGreaterThan() is a convenience wrapper that uses a public, protected, or private attribute of a class or object as the actual value.

Example A.26: Usage of assertGreaterThan()

```php
<?php
use PHPUnit\Framework\TestCase;

class GreaterThanTest extends TestCase
{
    public function testFailure()
    {
        $this->assertGreaterThan(2, 1);
    }
}
?>
```
```
phpunit GreaterThanTest
PHPUnit 6.1.0 by Sebastian Bergmann and contributors.

F

Time: 0 seconds, Memory: 5.00Mb

There was 1 failure:

1) GreaterThanTest::testFailure
Failed asserting that 1 is greater than 2.

/home/sb/GreaterThanTest.php:6

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
```






---

---

http://symfony.com/doc/current/best_practices/configuration.html

<p>
    Displaying the {{ constant('NUM_ITEMS', post) }} most recent results.
</p>

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Post;

class PostRepository extends EntityRepository
{
    public function findLatest($limit = Post::NUM_ITEMS)
    {
        // ...
    }
}




http://symfony.com/doc/current/components/dom_crawler.html

```
use Goutte\Client;

// make a real request to an external site
$client = new Client();
$crawler = $client->request('GET', 'https://github.com/login');

// select the form and fill in some values
$form = $crawler->selectButton('Sign in')->form();
$form['login'] = 'symfonyfan';
$form['password'] = 'anypass';

// submit that form
```