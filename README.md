BernardBundle
=============

bernardphp.com Symfony Bundle

Add to your kernel:

```php
new Bernard\BernardBundle\BernardBundle(),
```

Add to your config:

```yml
bernard:
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

##License

All code is licensed MIT. See LICENSE file on root directory.
