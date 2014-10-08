<img src="https://florian.ec/img/password-please/logo.png" alt="Password Please">
=================

> **Password, Please!** generates secure passwords in PHP. You can use it as a command line application or as a library in your code.

[![Build Status](https://travis-ci.org/florianeckerstorfer/passwordplease-php.svg?branch=master)](https://travis-ci.org/florianeckerstorfer/passwordplease-php)


Command Line Application
------------------------

Downloading the PHAR archive from the [releases page](https://github.com/florianeckerstorfer/passwordplease-php/releases) page is the easiest way to get the command line application.
The other way is to clone this repository and execute the `bin/password-please.php` file.

```shell
$ git clone https://github.com/florianeckerstorfer/passwordplease-php
$ cd password-please-php
$ php bin/password-please.php gen
```

### Usage

If you call the binary without any arguments you will get a password of length 20 with lower and upper case letters,
numbers and special characters. You can change both the length and the complexity.

```shell
$ php password-please.phar gen --length=30 --complexity=3
```

The length must be greather than `0` and complexity must be a value between `1` (very high complexity) and `4`
(low complexity). If you're a hasty person, you can use the shorter aliases for the options:

```shell
$ php password-please.phar gen -l 30 -c 3
```

Instead of using the numeric identifier for the complexity, you can also use a high-level string description of the complexity. The following table details the available complexities, the characters used in it and the high-level names:

<table>
    <thead>
        <tr>
            <th>Complexity</th>
            <th>Level</th>
            <th>Alias</th>
            <th>Characters</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>VERY_HIGH</code></td>
            <td><code>1</code></td>
            <td><code>veryhigh</code>, <code>harder</code></td>
            <td><code>a-zA-Z0-9,;.:-_+*#!()=?%&@$"'</code></td>
        </tr>
        <tr>
            <td><code>HIGH</code></td>
            <td><code>2</code></td>
            <td><code>high</code>, <code>hard</code></td>
            <td><code>a-zA-Z0-9</code></td>
        </tr>
        <tr>
            <td><code>MEDIUM</code></td>
            <td><code>3</code></td>
            <td><code>medium</code>, <code>normal</code></td>
            <td><code>a-zA-Z</code></td>
        </tr>
        <tr>
            <td><code>LOW</code></td>
            <td><code>4</code></td>
            <td><code>low</code>, <code>easy</code></td>
            <td><code>a-z</code></td>
        </tr>
    </tbody>
</table>


Library
-------

If you want to use **Password, Please!** in your code you can add the library to your dependencies using
[Composer](http://getcomposer.org).

```shell
$ composer require florianeckerstorfer/passwordplease-php:@stable
```

*Tip: You should replace `@stable` with a specific version from the [releases](https://github.com/florianeckerstorfer/passwordplease-php/releases) page.*

### Usage

**Password, Please!** depends on [ircmaxell/random-lib](https://github.com/ircmaxell/RandomLib) to generate passwords
and you need to pass an instance of `\RandomLib\Generator` to the constructor.

```php
use Fe\PasswordPlease\PasswordPlease;

$factory = new \RandomLib\Factory;
$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));

$pp = new PasswordPlease($generator);
$password = $pp->generatePassword(30, PasswordPlease::COMPLEXITY_HIGH);
```


Change Log
----------

### Version 0.2 (4 October 2014)

- Add string alias for complexities
- Change order of complexities, `1` is now very high and `4` is low

### Version 0.1 (3 September 2014)

- Initial release


Author
------

Developed by [Florian Eckerstorfer](https://florian.ec) in Vienna, Europe.


License
-------

The MIT license applies to `florianeckerstorfer/passwordplease-php`. For the full copyright and license information, please view the `LICENSE` file distributed with this source code.
