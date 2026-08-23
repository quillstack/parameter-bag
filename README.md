# Quillstack Parameter Bag

[![Tests](https://github.com/quillstack/parameter-bag/actions/workflows/tests.yml/badge.svg)](https://github.com/quillstack/parameter-bag/actions/workflows/tests.yml)
[![Latest Version](https://img.shields.io/packagist/v/quillstack/parameter-bag.svg)](https://packagist.org/packages/quillstack/parameter-bag)
[![Downloads](https://img.shields.io/packagist/dt/quillstack/parameter-bag.svg)](https://packagist.org/packages/quillstack/parameter-bag)
[![PHP Version](https://img.shields.io/packagist/php-v/quillstack/parameter-bag)](https://packagist.org/packages/quillstack/parameter-bag)
[![StyleCI](https://github.styleci.io/repos/301009689/shield?branch=main)](https://github.styleci.io/repos/301009689?branch=main)
[![CodeFactor](https://www.codefactor.io/repository/github/quillstack/parameter-bag/badge)](https://www.codefactor.io/repository/github/quillstack/parameter-bag)
[![Quality Gate](https://sonarcloud.io/api/project_badges/measure?project=quillstack_parameter-bag&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=quillstack_parameter-bag)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=quillstack_parameter-bag&metric=coverage)](https://sonarcloud.io/summary/new_code?id=quillstack_parameter-bag)
[![Maintainability](https://sonarcloud.io/api/project_badges/measure?project=quillstack_parameter-bag&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_parameter-bag)
[![Reliability](https://sonarcloud.io/api/project_badges/measure?project=quillstack_parameter-bag&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_parameter-bag)
[![Security](https://sonarcloud.io/api/project_badges/measure?project=quillstack_parameter-bag&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_parameter-bag)
[![Maintainability](https://api.codeclimate.com/v1/badges/1f996fd6d656be7285c3/maintainability)](https://codeclimate.com/github/quillstack/parameter-bag/maintainability)
[![License](https://img.shields.io/packagist/l/quillstack/parameter-bag)](https://github.com/quillstack/parameter-bag/blob/main/LICENSE)

Simple key-value storage. Full documentation: https://quillstack.org/parameter-bag

The bag the rest of the stack keeps things in: query parameters, cookies, server variables, a
parsed body. A missing key answers with the default rather than a warning, which is what
reading from a request needs.

### Requirements

- PHP 8.1 or newer

### Installation

```shell
composer require quillstack/parameter-bag
```

### Usage

```php
use Quillstack\ParameterBag\ParameterBag;

$bag = new ParameterBag(['page' => '2', 'sort' => 'email']);

$bag->get('page');            // '2'
$bag->get('perPage', '20');   // '20' — nothing under that name, so the default
$bag->has('sort');            // true
$bag->all();                  // ['page' => '2', 'sort' => 'email']

$bag->set('page', '3');
$bag->remove('sort');         // true, and false where there was nothing to remove
```

`set()` hands the bag back, so several can be written in one go:

```php
$bag->set('host', 'localhost')->set('port', 5432);
```

### Where it is used

[quillstack/server-request](https://github.com/quillstack/server-request) keeps every part of
a request in one: `$_SERVER`, `$_COOKIE`, `$_GET`, `$_FILES` and the parsed body are each a
bag, so reading a key that was not sent is an answer rather than a notice.

### Technical documentation

| Method | Does |
| --- | --- |
| `__construct(array $parameters = [])` | starts with what it is given |
| `get(string $name, mixed $default = null): mixed` | the value, or the default |
| `set(string $name, mixed $value): self` | writes one, and hands the bag back |
| `has(string $name): bool` | whether there is one under that name |
| `remove(string $name): bool` | takes one out; `false` where there was none |
| `all(): array` | everything in it |

This is a mutable bag on purpose: a request is built up before it is handled, and copying it
for every parameter would cost more than it is worth. The PSR-7 objects around it are the ones
which are immutable.

### Unit tests

```shell
composer test
composer test:coverage
composer stan
```

### Docker

```shell
docker-compose up -d
docker exec -w /var/www/html -it quillstack_parameter-bag sh
```

### License

MIT. See [LICENSE](LICENSE).
