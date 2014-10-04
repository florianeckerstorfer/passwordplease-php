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
    const COMPLEXITY_LOW       = 4;
    const COMPLEXITY_MEDIUM    = 3;
    const COMPLEXITY_HIGH      = 2;
    const COMPLEXITY_VERY_HIGH = 1;

    const DEFAULT_LENGTH     = 20;
    const DEFAULT_COMPLEXITY = self::COMPLEXITY_VERY_HIGH;

    /** @var Generator */
    private $generator;

    /** @var string[] */
    private $characters = [
        1 => ',;.:-_+*#!()=?%&@$"\'',
        2 => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        3 => '0123456789',
        4 => 'abcdefghijklmnopqrstuvwxyz'
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
    public function generatePassword($length = self::DEFAULT_LENGTH, $complexity = self::DEFAULT_COMPLEXITY)
    {
        $complexity = $this->getComplexityByName($complexity);

        if (!isset($this->characters[$complexity])) {
            throw new \InvalidArgumentException(sprintf(
                'The given complexity "%s" does not exist. The following complexities are currently supported: %s',
                $complexity,
                implode(', ', array_keys($this->characters))
            ));
        }
        if ($length < 1) {
            throw new \InvalidArgumentException('Would you be so kind to provide a password length greater than 0.');
        }

        $characters = '';
        for ($i = $complexity; $i <= self::COMPLEXITY_LOW; $i++) {
            $characters .= $this->characters[$i];
        }

        return $this->generator->generateString($length, $characters);
    }

    /**
     * @param string $complexity High-level name of complexity
     *
     * @return int Internal complexity ID.
     */
    protected function getComplexityByName($complexity)
    {
        switch ($complexity) {
            case 'veryhigh':
            case 'harder':
                return self::COMPLEXITY_VERY_HIGH;
            case 'high':
            case 'hard':
                return self::COMPLEXITY_HIGH;
            case 'medium':
            case 'normal':
                return self::COMPLEXITY_MEDIUM;
            case 'low':
            case 'easy':
                return self::COMPLEXITY_LOW;
        }

        return $complexity;
    }
}
