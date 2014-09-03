#!/usr/bin/env php
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

use Symfony\Component\Console\Application;

$console = new Application();
$console->add(new \Fe\PasswordPlease\Command\GeneratePasswordCommand());

$console->run();
