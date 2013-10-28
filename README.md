CordovalBernardBundle
=====================

bernardphp.com Symfony Bundle

This bundle borrows some initial code from Stan Lemon's code:

https://github.com/stanlemon/bernard-app

Add to your config:

cordoval_bernard:
    driver: dbal
    serializer: simple
    dbal: default
#    redis:
#        host:
#        port:
    ironmq:
        token:
        project:
#    sqs:
#        key:
#        secret:
#        region: