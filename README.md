# Valid Variants of Validating Validation

A talk originally given at [Laracon Online](https://laracon.net) on September 14, 2022.

The talk covers three valid ways of testing validation and controller logic in Laravel applications:

1. Snapshots
2. Shared arrays
3. Request factories

It discusses the pros and cons of each approach, as well as considering the best way to utilise
each approach to be as efficient, readable and maintainable as possible.

## Setup

> **Prerequisites**
> These setup instructions assume you're on a Mac and have PHP 8.1 or greater installed.

Perform the following steps to set up the project used to demo these approaches locally.

1. `git clone https://github.com/lukeraymonddowning/valid-variants-of-validating-validation.git`
2. `cd valid-variants-of-validating-validation`
3. `composer install`
4. `php artisan key:generate`
5. `touch database/database.sqlite`
6. `npm install && npm run build`
7. `php artisan setup`
