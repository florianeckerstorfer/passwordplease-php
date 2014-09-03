<?php

/**
 * This file is part of florianeckerstorfer/password-please.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fe\PasswordPlease;

use RandomLib\Generator;

/**
 * PasswordPlease
 *
 * @package   Fe\PasswordPlease
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2014 Florian Eckerstorfer <florian@eckerstorfer.co>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class PasswordPlease
{
    const COMPLEXITY_LOW       = 1;
    const COMPLEXITY_MEDIUM    = 2;
    const COMPLEXITY_HIGH      = 3;
    const COMPLEXITY_VERY_HIGH = 4;

    /** @var Generator */
    private $generator;

    /** @var string[] */
    private $characters = [
        1 => 'abcdefghijklmnopqrstuvwxyz',
        2 => '0123456789',
        3 => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        4 => '<>,;.:-_#+*!"§$%&/()=?`'
    ];

    /**
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return Generator
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * Generates a password of the given length and complexity.
     *
     * The length should be an integer (and for secure password at least of length 20)
     *
     * @param integer $length     Number of characters in the password. Defaults to 20.
     * @param integer $complexity Complexity of the resulting password. Defaults to
     *                            `PasswordPlease::COMPLEXITY_VERY_HIGH`.
     *
     * @return string              Password of the given length and complexity.
     */
    public function generatePassword($length = 20, $complexity = self::COMPLEXITY_VERY_HIGH)
    {
        $characters = '';
        for ($i = 1; $i <= $complexity; $i++) {
            $characters .= $this->characters[$i];
        }

        return $this->generator->generateString($length, $characters);
    }
}
