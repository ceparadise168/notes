# Symfony 
```
[eric_tu@localhost SfMsg]$ tree -L 3
.
├── app  # config         
│   ├── AppCache.php
│   ├── AppKernel.php
│   ├── autoload.php
│   ├── config
│   │   ├── config_dev.yml
│   │   ├── config_prod.yml
│   │   ├── config_test.yml
│   │   ├── config.yml
│   │   ├── parameters.yml
│   │   ├── parameters.yml.dist
│   │   ├── routing_dev.yml
│   │   ├── routing.yml
│   │   ├── security.yml
│   │   └── services.yml
│   └── Resources # aslo contains bundle-level resources here
│       └── views
├── bin  # some thirty-party binary could be put into this folder
│   ├── console  # executes symfony CLI cmds.
│   └── symfony_requirements #check the env
├── composer.json # it's for composer to manage dependencies.
├── composer.lock # generated by composer to lock current state.
├── phpunit.xml.dist # phpunit testing
├── README.md
├── src # user source codes will be put into this folder
│   └── AppBundle
│       ├── AppBundle.php
│       └── Controller  # defined router rules here
├── tests
│   └── AppBundle
│       └── Controller
├── tree.txt
├── var  # contains cache,logs...
│   ├── bootstrap.php.cache #  for symfony application bootstrap.
│   ├── cache
│   │   ├── dev
│   │   └── prod
│   ├── logs
│   ├── sessions
│   │   └── prod
│   └── SymfonyRequirements.php
├── vendor # 3rd-party php libraies and bundles located in this directory.
│   ├── autoload.php
│   ├── bin
│   │   ├── doctrine -> ../doctrine/orm/bin/doctrine
│   │   ├── doctrine-dbal -> ../doctrine/dbal/bin/doctrine-dbal
│   │   ├── doctrine.php -> ../doctrine/orm/bin/doctrine.php
│   │   ├── security-checker -> ../sensiolabs/security-checker/security-checker
│   │   └── simple-phpunit -> ../symfony/phpunit-bridge/bin/simple-phpunit
│   ├── composer
│   │   ├── autoload_classmap.php
│   │   ├── autoload_files.php
│   │   ├── autoload_namespaces.php
│   │   ├── autoload_psr4.php
│   │   ├── autoload_real.php
│   │   ├── autoload_static.php
│   │   ├── ca-bundle
│   │   ├── ClassLoader.php
│   │   ├── installed.json
│   │   └── LICENSE
│   ├── doctrine
│   │   ├── annotations
│   │   ├── cache
│   │   ├── collections
│   │   ├── common
│   │   ├── dbal
│   │   ├── doctrine-bundle
│   │   ├── doctrine-cache-bundle
│   │   ├── inflector
│   │   ├── instantiator
│   │   ├── lexer
│   │   └── orm
│   ├── incenteev
│   │   └── composer-parameter-handler
│   ├── jdorn
│   │   └── sql-formatter
│   ├── monolog
│   │   └── monolog
│   ├── paragonie
│   │   └── random_compat
│   ├── psr
│   │   ├── cache
│   │   └── log
│   ├── sensio
│   │   ├── distribution-bundle
│   │   ├── framework-extra-bundle
│   │   └── generator-bundle
│   ├── sensiolabs
│   │   └── security-checker
│   ├── swiftmailer
│   │   └── swiftmailer
│   ├── symfony
│   │   ├── monolog-bundle
│   │   ├── phpunit-bridge
│   │   ├── polyfill-apcu
│   │   ├── polyfill-intl-icu
│   │   ├── polyfill-mbstring
│   │   ├── polyfill-php56
│   │   ├── polyfill-php70
│   │   ├── polyfill-util
│   │   ├── swiftmailer-bundle
│   │   └── symfony
│   └── twig
│       └── twig
└── web # public folder for web site contains assetics and entry php scripts.
    ├── app_dev.php
    ├── apple-touch-icon.png
    ├── app.php
    ├── bundles
    ├── config.php
    ├── favicon.ico
    └── robots.txt

68 directories, 44 files
```



