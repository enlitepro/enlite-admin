<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace FtdAdminTest\Entities;

use FtdAdmin\Entities\Container;
use FtdAdmin\Entities\Entity;
use FtdAdmin\Entities\EntityOptions;

class ContainerTest extends \PHPUnit_Framework_TestCase
{

    public function testAddEntity()
    {
        $container = new Container();
        $container->addEntity(new Entity('a', new EntityOptions()));
        $container->addEntity(new Entity('b', new EntityOptions()));
        $container->addEntity(new Entity('a', new EntityOptions()));

        $this->assertCount(2, $container->getEntities());
    }
    public function testGetEntity()
    {
        $container = new Container();
        $entityA = new Entity('a', new EntityOptions());
        $container->addEntity($entityA);
        $entityB = new Entity('b', new EntityOptions());
        $container->addEntity($entityB);

        $this->assertSame($entityA, $container->getEntity('a'));
        $this->assertSame($entityB, $container->getEntity('b'));
    }

    /**
     * @expectedException \FtdAdmin\Exception\RuntimeException
     */
    public function testGetEntityNotFound()
    {
        $container = new Container();
        $container->getEntity('a');
    }

}
