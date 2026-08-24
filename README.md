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

## Why this exists

A request arrives carrying five bags of values — the server parameters, the query string, the
cookies, the uploaded files, the parsed body — and every one of them is a place where reading a
key that is not there should give you what you asked for rather than a notice and a `null`.

That is all this is: a read-only bag with a default. It is separate from the request because the
request is not the only thing that has one, and because a class that holds values should not
need a PSR-7 message around it to be tested.

## Requirements

- PHP 8.1 or newer

## Installation

```shell
composer require quillstack/parameter-bag
```

## Usage

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

## Technical documentation

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

## Benchmark

Measured with [quillstack/benchmark](https://github.com/quillstack/benchmark) on a thousand bags
of five values, each built and read twice — once for a key that is there and once for a key that
is not. Runs are interleaved and unconcurrent, each figure is the median of five, and PHP is
8.5.7.

| | Version |
| --- | --- |
| quillstack/parameter-bag | 0.6.0 |
| symfony/http-foundation | v7.4.17 |

| | Per bag | Relative |
| --- | --- | --- |
| **quillstack/parameter-bag** | **0.19 µs** | — |
| symfony/http-foundation | 0.26 µs | 1.4× |

**Seventy nanoseconds is not a result.** Both are an array with a `get()` in front of it, and a
request builds five of them — a third of a microsecond, once. This table exists because the
standard for these READMEs asks for one, and the honest thing it has to say is that there is
nothing here to choose on.

Symfony's bag does more: it filters values, counts, iterates, and has typed getters that throw
on the wrong shape. It also arrives inside `symfony/http-foundation`, which is 768 kB. This is
one class.

## Tests

```shell
composer test
composer test:coverage
composer stan
```

## The rest of Quillstack

This is one component of [Quillstack](https://github.com/quillstack), a PHP framework which is
as simple to use as it is strict about what it does.

- [quillstack/server-request](https://github.com/quillstack/server-request) — which carries five of these
- [quillstack/header-bag](https://github.com/quillstack/header-bag) — the same idea, matched without case
- [quillstack/config](https://github.com/quillstack/config) — settings read the same way

## License

MIT. See [LICENSE](LICENSE).
