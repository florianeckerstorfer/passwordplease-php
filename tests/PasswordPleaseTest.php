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

use \Mockery as m;

/**
 * PasswordPleaseTest
 *
 * @package   Fe\PasswordPlease
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2014 Florian Eckerstorfer <florian@eckerstorfer.co>
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @group     unit
 */
class PasswordPleaseTest extends \PHPUnit_Framework_TestCase
{
    /** @var RandomLib\Generator */
    private $generator;

    /** @var Fe\PasswordPlease\PasswordPlease */
    private $pp;

    public function setUp()
    {
        $factory = new \RandomLib\Factory();
        $this->generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));

        $this->pp = new PasswordPlease($this->generator);
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithDefaultParameters()
    {
        $password = $this->pp->generatePassword();

        $this->assertEquals(20, strlen($password));
        $this->assertRegExp('/[a-zA-Z0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityVeryHighAsString()
    {
        foreach (['veryhigh', 'harder'] as $complexity) {
            $password = $this->pp->generatePassword(20, $complexity);
            $this->assertRegExp('/[a-zA-Z0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
        }
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityHigh()
    {
        $password = $this->pp->generatePassword(15, PasswordPlease::COMPLEXITY_HIGH);

        $this->assertEquals(15, strlen($password));
        $this->assertRegExp('/[a-zA-Z0-9]/', $password);
        $this->assertRegExp('/[^<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityHighAsString()
    {
        foreach (['high', 'hard'] as $complexity) {
            $password = $this->pp->generatePassword(20, $complexity);
            $this->assertRegExp('/[a-zA-Z0-9]/', $password);
            $this->assertRegExp('/[^<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
        }
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityMedium()
    {
        $password = $this->pp->generatePassword(15, PasswordPlease::COMPLEXITY_MEDIUM);

        $this->assertEquals(15, strlen($password));
        $this->assertRegExp('/[a-zA-Z]/', $password);
        $this->assertRegExp('/[^0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityMediumAsString()
    {
        foreach (['medium', 'normal'] as $complexity) {
            $password = $this->pp->generatePassword(20, $complexity);
            $this->assertRegExp('/[a-zA-Z]/', $password);
            $this->assertRegExp('/[^0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
        }
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityLow()
    {
        $password = $this->pp->generatePassword(15, PasswordPlease::COMPLEXITY_LOW);

        $this->assertEquals(15, strlen($password));
        $this->assertRegExp('/[a-z]/', $password);
        $this->assertRegExp('/[^A-Z0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     * @covers Fe\PasswordPlease\PasswordPlease::getComplexityByName()
     */
    public function generatePasswordReturnsPasswordWithComplexityLowAsString()
    {
        foreach (['low', 'easy'] as $complexity) {
            $password = $this->pp->generatePassword(20, $complexity);
            $this->assertRegExp('/[a-z]/', $password);
            $this->assertRegExp('/[^A-Z0-9<>,;.:-_#+*!"§$%&\/\(\)=?`]/', $password);
        }
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     */
    public function generatePasswordShouldThrowAnExceptionIfThePasswordLengthIsSmallerThanOne()
    {
        try {
            $this->pp->generatePassword(0);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @test
     * @covers Fe\PasswordPlease\PasswordPlease::generatePassword()
     */
    public function generatePasswordShouldThrowAnExceptionIfTheComplexityIsUnkown()
    {
        try {
            $this->pp->generatePassword(20, 'invalid');
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }
}
