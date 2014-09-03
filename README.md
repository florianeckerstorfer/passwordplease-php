Password, Please!
=================

> **Password, Please!** generates secure passwords in PHP. You can use it as a command line application or as a library in your code.


Command Line Application
------------------------

Downloading the PHAR archive from the [releases page](https://github.com/florianeckerstorfer/passwordplease-php/releases) page is the easiest way to get the command line application.
The other way is to clone this repository and execute the `bin/password-please.php` file.

```shell
$ git clone
$ cd password-please-php
$ php bin/password-please.php gen
```

### Usage

If you call the binary without any arguments you will get a password of length 20 with lower and upper case letters,
numbers and special characters. You can change both the length and the complexity.

```shell
$ php password-please.phar gen --length=30 --complexity=3
```

The length must be greather than `0` and complexity must be a value between `1` (low complexity) and `4`
(very high complexity). If you're a hasty person, you can use the shorter aliases for the options:

```shell
$ php password-please.phar gen -l 30 -c 3
```


Library
-------

If you want to use **Password, Please!** in your code you can add the library to your dependencies using
[Composer](http://getcomposer.org).

```shell
$ composer require florianeckerstorfer/password-please:@stable
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


Author
------

Developed by [Florian Eckerstorfer](https://florian.ec) in Vienna, Europe.


License
-------

The MIT license applies to `florianeckerstorfer/passwordplease-php`. For the full copyright and license information, please view the `LICENSE` file distributed with this source code.
