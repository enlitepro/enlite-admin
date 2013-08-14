<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdminTest\Service;

use EnliteAdmin\Entities\Container;
use EnliteAdmin\Entities\Entity;
use EnliteAdmin\Entities\EntityOptions;
use EnliteAdmin\Service\EntityService;
use EnliteAdminTest\Mock\EntityMock;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

class EntityServiceTest extends \PHPUnit_Framework_TestCase
{

    public function testGetEntities()
    {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceManager', ['get']);
        $serviceLocator->expects($this->once())->method('get')->with('EnliteAdminEntities');

        $service = new EntityService($serviceLocator);
        $service->getEntities();
    }

    public function testGetEntity()
    {
        $container = new Container();
        $entity = new Entity('a', new EntityOptions());
        $container->addEntity($entity);

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceManager', ['get']);
        $serviceLocator->expects($this->once())->method('get')->with('EnliteAdminEntities')->will(
            $this->returnValue($container)
        );

        $service = new EntityService($serviceLocator);
        $this->assertSame($entity, $service->getEntity('a'));
    }

    public function testCreateTable()
    {
        $entity = new Entity('a', new EntityOptions(['fields' => ['id']]));

        $entities = new Paginator(
            new ArrayAdapter(
                array(
                     new EntityMock(),
                     new EntityMock(),
                )
            )
        );
        $service = new EntityService($this->getMock('Zend\ServiceManager\ServiceManager'));
        $table = $service->createTable($entity, $entities);
        $this->assertInstanceOf('EnliteAdmin\Table\Table', $table);
        $this->assertCount(2, $table);
    }

}
