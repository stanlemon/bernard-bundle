CordovalBernardBundle
=====================

bernardphp.com Symfony Bundle

This bundle borrows some initial code from Stan Lemon's code:

https://github.com/stanlemon/bernard-app

Add to your kernel:

```php
new Cordoval\BernardBundle\CordovalBernardBundle(),
```

Add to your config:

```yml
cordoval_bernard:
    driver: dbal
    serializer: simple
    dbal: default
#    redis:
#        host:
#        port:
#    ironmq:
#        token:
#        project:
#    sqs:
#        key:
#        secret:
#        region:
```

Before using run the following command to set schema for Doctrine driver:

```
php app/console bernard:dbal-schema --force
CREATE TABLE bernard_queues (name VARCHAR(255) NOT NULL, ...
CREATE TABLE bernard_messages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ...
```
