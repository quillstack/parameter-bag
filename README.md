# Quillstack Parameter Bag

Simple key-value storage.

### Unit tests

Run tests using a command:

```
phpdbg -qrr vendor/bin/phpunit
```

Check the tests coverage:

```
phpdbg -qrr vendor/bin/phpunit --coverage-html coverage tests
```

## Docker

```shell
$ docker-compose up -d
$ docker exec -w /var/www/html -it quillstack_parameter-bag sh
```
