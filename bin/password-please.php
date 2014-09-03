<?php

/**
 * This file is part of florianeckerstorfer/password-please.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';

use Fe\PasswordPlease\PasswordPlease;

$factory = new RandomLib\Factory;
$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));

$pp = new PasswordPlease($generator);
echo $pp->generatePassword(30, PasswordPlease::COMPLEXITY_HIGH)."\n";
