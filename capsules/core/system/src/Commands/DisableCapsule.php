<?php

namespace Nuntius\System\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisableCapsule extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('system:capsule_disable')
      ->setDescription('Disable enable')
      ->setHelp('Disabling a capsule')
      ->addArgument('capsule_name', InputArgument::REQUIRED);
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    // Check the capsule is not disabled.

    // Check if the capsule has any depandend capsules which enabled.

    // Disable the capsule.
  }

}