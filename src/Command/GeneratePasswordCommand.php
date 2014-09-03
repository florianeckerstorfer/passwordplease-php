<?php

/**
 * This file is part of florianeckerstorfer/password-please.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fe\PasswordPlease\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fe\PasswordPlease\PasswordPlease;

/**
 * GeneratePasswordCommand
 *
 * @package   Fe\PasswordPlease
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2014 Florian Eckerstorfer <florian@eckerstorfer.co>
 * @license   http://opensource.org/licenses/MIT The MIT License
 *
 * @codeCoverageIgnore
 */
class GeneratePasswordCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('generate')
            ->setDescription('Generates a password of the given length and complexity')
            ->addOption('length', 'l', InputOption::VALUE_REQUIRED, 'Password length', PasswordPlease::DEFAULT_LENGTH)
            ->addOption(
                'complexity',
                'c',
                InputOption::VALUE_REQUIRED,
                'Password complexity',
                PasswordPlease::DEFAULT_COMPLEXITY
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = new \RandomLib\Factory;
        $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));

        $pp = new PasswordPlease($generator);
        $password = $pp->generatePassword($input->getOption('length'), $input->getOption('complexity'));

        $output->writeln($password);
    }
}
