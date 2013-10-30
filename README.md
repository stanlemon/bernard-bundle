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

By default no configuration is required and the bundle will assume the doctrine driver.

Before using run the following command to set schema for Doctrine driver:

```
php app/console bernard:dbal-schema --force
CREATE TABLE bernard_queues (name VARCHAR(255) NOT NULL, ...
CREATE TABLE bernard_messages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ...
```

To begin produce a message
```
php app/console bernard:produce MessageType "{\"message\": \"Message here...\"}"
```

Then consume the messages
```
php app/console bernard:consume
```

To see the bundle in action with a sample message take a look at: https://github.com/stanlemon/bernard-bundle-app

##License

All code is licensed MIT. See LICENSE file on root directory.
