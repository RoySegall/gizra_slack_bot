<?php

namespace tests;

use Nuntius\Nuntius;

/**
 * Testing entity.
 */
class NamespacesTest extends TestsAbstract {

  /**
   * Testing entities crud operation.
   */
  public function testNamespaces() {
    $group_control = new \DiscoveryOne\GroundControl();
    $hal = new \Figures\Hal9000();

    $this->assertEquals($group_control->eagleLand(), 'The eagal has landed');
    $this->assertEquals($hal->getName(), 'Hal9000');
    $this->assertEquals($container->get('ground_control')->liftOff(), 'We hae lift off!');
  }

}
