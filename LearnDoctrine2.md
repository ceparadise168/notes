# Getting Started with Doctrine

This guide covers getting started with the Doctrine ORM. After working through the guide you should know:

How to install and configure Doctrine by connecting it to a database
Mapping PHP objects to database tables
Generating a database schema from PHP objects
Using the EntityManager to insert, update, delete and find objects in the datab

# Guide Assumptions

This guide is designed for beginners that haven’t worked with Doctrine ORM before. There are some prerequesites for the tutorial that have to be installed:

PHP (latest stable version)
Composer Package Manager (Install Composer)
The code of this tutorial is available on Github.

# What is Doctrine?

Doctrine 2 is an object-relational mapper (ORM) for PHP 5.4+ that provides transparent persistence for PHP objects. It uses the Data Mapper pattern at the heart, aiming for a complete separation of your domain/business logic from the persistence in a relational database management system.

The benefit of Doctrine for the programmer is the ability to focus on the object-oriented business logic and worry about persistence only as a secondary problem. This doesn’t mean persistence is downplayed by Doctrine 2, however it is our belief that there are considerable benefits for object-oriented programming if persistence and entities are kept separated.

# What are Entities?

Entities are PHP Objects that can be identified over many requests by a unique identifier or primary key. These classes don’t need to extend any abstract base class or interface. An entity class must not be final or contain final methods. Additionally it must not implement clone nor wakeup, unless it does so safely.

An entity contains persistable properties. A persistable property is an instance variable of the entity that is saved into and retrieved from the database by Doctrine’s data mapping capabilities.

# Project Setup
```
mkdir LearnDoctrine
cd LearnDoctrine
vim composer.json
```


```
{
    "require": {
        "doctrine/orm": "2.4.*",
        "symfony/yaml": "2.*"
    },
    "autoload": {
        "psr-0": {"": "src/"}
    }
}
```


```
composer install
```


Add the following directories:
```
doctrine2-tutorial
|-- config
|   |-- xml
|   `-- yaml
`-- src
```

```
{
    "require": {
        "doctrine/orm": "2.4.*",
        "symfony/yaml": "2.*"
    },
    "autoload": {
        "psr-0": {"": "src/"}
    }
}
```

# Obtaining the EntityManager

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

The first require statement sets up the autoloading capabilities of Doctrine using the Composer autoload.

The second block consists of the instantiation of the ORM Configuration object using the Setup helper. It assumes a bunch of defaults that you don’t have to bother about for now. You can read up on the configuration details in the reference chapter on configuration.

The third block shows the configuration options required to connect to a database, in my case a file-based sqlite database. All the configuration options for all the shipped drivers are given in the DBAL Configuration section of the manual.

The last block shows how the EntityManager is obtained from a factory method.

# Generating the Database Schema

Now that we have defined the Metadata mappings and bootstrapped the EntityManager we want to generate the relational database schema from it. Doctrine has a Command-Line Interface that allows you to access the SchemaTool, a component that generates the required tables to work with the metadata.

For the command-line tool to work a cli-config.php file has to be present in the project root directory, where you will execute the doctrine command. Its a fairly simple file:

```
<?php
// cli-config.php
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
```
You can then change into your project directory and call the Doctrine command-line tool:
```
$ cd project/
$ vendor/bin/doctrine orm:schema-tool:create
```
At this point no entity metadata exists in src so you will see a message like “No Metadata Classes to process.” Don’t worry, we’ll create a Product entity and corresponding metadata in the next section.

You can easily recreate the database:

```
$ vendor/bin/doctrine orm:schema-tool:drop --force
$ vendor/bin/doctrine orm:schema-tool:create
```

Or use the update functionality:

```
$ vendor/bin/doctrine orm:schema-tool:update --force
```
The updating of databases uses a Diff Algorithm for a given Database Schema, a cornerstone of the Doctrine\DBAL package, which can even be used without the Doctrine ORM package.

# Starting with the Product

We start with the simplest entity, the Product. Create a src/Product.php file to contain the Product entity definition:

```
<?php
// src/Product.php
class Product
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
```

Note that all fields are set to protected (not public) with a mutator (getter and setter) defined for every field except $id. The use of mutators allows Doctrine to hook into calls which manipulate the entities in ways that it could not if you just directly set the values with entity#field = foo;

The id field has no setter since, generally speaking, your code should not set this value since it represents a database id value. (Note that Doctrine itself can still set the value using the Reflection API instead of a defined setter function)

The next step for persistence with Doctrine is to describe the structure of the Product entity to Doctrine using a metadata language. The metadata language describes how entities, their properties and references should be persisted and what constraints should be applied to them.

Metadata for entities are configured using a XML, YAML or Docblock Annotations. This Getting Started Guide will show the mappings for all Mapping Drivers. References in the text will be made to the XML mapping.

```
<?php
// src/Product.php
/**
 * @Entity @Table(name="products")
 **/
class Product
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;

    // .. (other code)
}
```
PHP
<?php
// src/Product.php
/**
 * @Entity @Table(name="products")
 **/
class Product
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;

    // .. (other code)
}
XML YAML
The top-level entity definition tag specifies information about the class and table-name. The primitive type Product#name is defined as a field attribute. The id property is defined with the id tag, this has a generator tag nested inside which defines that the primary key generation mechanism automatically uses the database platforms native id generation strategy (for example AUTO INCREMENT in the case of MySql or Sequences in the case of PostgreSql and Oracle).

Now that we have defined our first entity, let’s update the database:

```
$ vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
```

Specifying both flags --force and --dump-sql prints and executes the DDL statements.

Now create a new script that will insert products into the database:

```
<?php
// create_product.php
require_once "bootstrap.php";

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";
```
Call this script from the command-line to see how new products are created:
```
$ php create_product.php ORM
$ php create_product.php DBAL
```
What is happening here? Using the Product is pretty standard OOP. The interesting bits are the use of the EntityManager service. To notify the EntityManager that a new entity should be inserted into the database you have to call persist(). To initiate a transaction to actually perform the insertion, You have to explicitly call flush() on the EntityManager.

This distinction between persist and flush is allows to aggregate all writes (INSERT, UPDATE, DELETE) into one single transaction, which is executed when flush is called. Using this approach the write-performance is significantly better than in a scenario where updates are done for each entity in isolation.

Doctrine follows the UnitOfWork pattern which additionally detects all entities that were fetched and have changed during the request. You don’t have to keep track of entities yourself, when Doctrine already knows about them.
---

```
[eric_tu@localhost LearnDoctrine]$ vim src/Product.php 
[eric_tu@localhost LearnDoctrine]$ vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
CREATE TABLE products (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id));

Updating database schema...
Database schema updated successfully! "1" queries were executed
[eric_tu@localhost LearnDoctrine]$  ls
bootstrap.php  cli-config.php  composer.json  composer.lock  config  db.sqlite  src  vendor
[eric_tu@localhost LearnDoctrine]$ vim creat_product.php
[eric_tu@localhost LearnDoctrine]$ php creat_product.php ORM
PHP Fatal error:  Call to undefined method Product::Id() in /usr/share/nginx/html/LearnDoctrine/creat_product.php on line 15
[eric_tu@localhost LearnDoctrine]$ vim creat_product.php 
[eric_tu@localhost LearnDoctrine]$ vim creat_product.php 
[eric_tu@localhost LearnDoctrine]$ php creat_product.php ORM
Created Product wiht ID 2
[eric_tu@localhost LearnDoctrine]$ php creat_product.php DBAL
Created Product wiht ID 3
```
---

As a next step we want to fetch a list of all the Products. Let’s create a new script for this:
```
<?php
// list_products.php
require_once "bootstrap.php";

$productRepository = $entityManager->getRepository('Product');
$products = $productRepository->findAll();

foreach ($products as $product) {
    echo sprintf("-%s\n", $product->getName());
}
```

The EntityManager#getRepository() method can create a finder object (called a repository) for every entity. It is provided by Doctrine and contains some finder methods such as findAll().

Let’s continue with displaying the name of a product based on its ID:

```
<?php
// show_product.php <id>
require_once "bootstrap.php";

$id = $argv[1];
$product = $entityManager->find('Product', $id);

if ($product === null) {
    echo "No product found.\n";
    exit(1);
}

echo sprintf("-%s\n", $product->getName());
```

Updating a product name demonstrates the functionality UnitOfWork of pattern discussed before. We only need to find a product entity and all changes to its properties are written to the database:

```
<?php
// update_product.php <id> <new-name>
require_once "bootstrap.php";

$id = $argv[1];
$newName = $argv[2];

$product = $entityManager->find('Product', $id);

if ($product === null) {
    echo "Product $id does not exist.\n";
    exit(1);
}

$product->setName($newName);

$entityManager->flush();
```
After calling this script on one of the existing products, you can verify the product name changed by calling the show_product.php script.

```
[eric_tu@localhost LearnDoctrine]$ php show_product.php 

PHP Notice:  Undefined offset: 1 in /usr/share/nginx/html/LearnDoctrine/show_product.php on line 7

PHP Fatal error:  Uncaught exception 'Doctrine\ORM\ORMException' with message 'The identifier id is missing for a query of Product' in /usr/share/nginx/html/LearnDoctrine/vendor/doctrine/orm/lib/Doctrine/ORM/ORMException.php:259
Stack trace:
#0 /usr/share/nginx/html/LearnDoctrine/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php(378): Doctrine\ORM\ORMException::missingIdentifierField('Product', 'id')
#1 /usr/share/nginx/html/LearnDoctrine/show_product.php(8): Doctrine\ORM\EntityManager->find('Product', NULL)
#2 {main}
  thrown in /usr/share/nginx/html/LearnDoctrine/vendor/doctrine/orm/lib/Doctrine/ORM/ORMException.php on line 259
```

# Adding Bug and User Entities

We continue with the bug tracker domain, by creating the missing classes Bug and User and putting them into src/Bug.php and src/User.php respectively.

```
<?php
// src/Bug.php
/**
 * @Entity(repositoryClass="BugRepository") @Table(name="bugs")
 */
class Bug
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $description;
    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $created;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $status;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
```

```
<?php
// src/User.php
/**
 * @Entity @Table(name="users")
 */
class User
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
```

#  ?

All of the properties discussed so far are simple string and integer values, for example the id fields of the entities, their names, description, status and change dates. Next we will model the dynamic relationships between the entities by defining the references between entities.

References between objects are foreign keys in the database. You never have to (and never should) work with the foreign keys directly, only with the objects that represent the foreign key through their own identity.

For every foreign key you either have a Doctrine ManyToOne or OneToOne association. On the inverse sides of these foreign keys you can have OneToMany associations. Obviously you can have ManyToMany associations that connect two tables with each other through a join table with two foreign keys.

---

Now that you know the basics about references in Doctrine, we can extend the domain model to match the requirements:

```
<?php
// src/Bug.php
use Doctrine\Common\Collections\ArrayCollection;

class Bug
{
    // ... (previous code)

    protected $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}
```

```
<?php
// src/User.php
use Doctrine\Common\Collections\ArrayCollection;
class User
{
    // ... (previous code)

    protected $reportedBugs;
    protected $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }
}
```

You use Doctrine’s ArrayCollections in your Doctrine models, rather than plain PHP arrays, so that Doctrine can watch what happens with them and act appropriately. Note that if you dump your entities, you’ll see a “PersistentCollection” in place of your ArrayCollection, which is just an internal Doctrine class with the same interface.

```
[eric_tu@localhost LearnDoctrine]$ vendor/bin/doctrine orm:schema-tool:update --force

                                                                                                                                   
  [Doctrine\Common\Annotations\AnnotationException]                                                                                
  [Syntax Error] Expected Doctrine\Common\Annotations\DocLexer::T_IDENTIFIER or Doctrine\Common\Annotations\DocLexer::T_TRUE or D  
  octrine\Common\Annotations\DocLexer::T_FALSE or Doctrine\Common\Annotations\DocLexer::T_NULL, got '@' at position 52 in propert  
  y Bug::$id.                                                                             
  ```
id 前面的innoation 一個一個參數砍掉檢查
發現砍掉最後一個var int 之後就可以了，
把他加回去之後在試一次，又可以了!? 真神奇...

```[eric_tu@localhost LearnDoctrine]$ vendor/bin/doctrine orm:schema-tool:update --force
Updating database schema...
Database schema updated successfully! "2" queries were executed
[eric_tu@localhost LearnDoctrine]$ vim  s
show_product.php  src/              
[eric_tu@localhost LearnDoctrine]$ vim  src/Bug.php 
[eric_tu@localhost LearnDoctrine]$ vendor/bin/doctrine orm:schema-tool:update --force
Nothing to update - your database is already in sync with the current entity metadata.
[eric_tu@localhost LearnDoctrine]$ vim  src/Bug.php 
```

***Lazy load proxies always contain an instance of Doctrine’s EntityManager and all its dependencies. Therefore a var_dump() will possibly dump a very large recursive structure which is impossible to render and read. You have to use Doctrine\Common\Util\Debug::dump() to restrict the dumping to a human readable level. Additionally you should be aware that dumping the EntityManager to a Browser may take several minutes, and the Debug::dump() method just ignores any occurrences of it in Proxy instances.***

# est practices in handling database relations and Object-Relational Mapping
Because we only work with collections for the references we must be careful to implement a bidirectional reference in the domain model. The concept of owning or inverse side of a relation is central to this notion and should always be kept in mind. The following assumptions are made about relations and have to be followed to be able to work with Doctrine 2. These assumptions are not unique to Doctrine 2 but are best practices in handling database relations and Object-Relational Mapping.

- Changes to Collections are saved or updated, when the entity on the owning side of the collection is saved or updated.

- Saving an Entity at the inverse side of a relation never triggers a persist operation to changes to the collection.

- In a one-to-one relation the entity holding the foreign key of the related entity on its own database table is always the owning side of the relation.

- In a many-to-many relation, both sides can be the owning side of the relation. However in a bi-directional many-to-many relation only one is allowed to be.

- In a many-to-one relation the Many-side is the owning side by default, because it holds the foreign key.

- The OneToMany side of a relation is inverse by default, since the foreign key is saved on the Many side. A OneToMany relation can only be the owning side, if its implemented using a ManyToMany relation with join table and restricting the one side to allow only UNIQUE values per database constraint.

***Consistency of bi-directional references on the inverse side of a relation have to be managed in userland application code. Doctrine cannot magically update your collections to be consistent.***

