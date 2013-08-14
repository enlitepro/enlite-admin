<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdminTest;

use EnliteAdmin\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

    public function testSetEntities()
    {
        $configuration = new Configuration(
            array(
                 'entities' => array(
                     'user' => array(),
                     'test' => array()
                 )
            )
        );
        $entities = $configuration->getEntities();
        $this->assertCount(2, $entities);
        $this->assertInstanceOf('EnliteAdmin\Entities\EntityOptions', $entities['user']);
        $this->assertInstanceOf('EnliteAdmin\Entities\EntityOptions', $entities['test']);
    }

    /**
     * @expectedException \EnliteAdmin\Exception\RuntimeException
     */
    public function testSetEntitiesWrongConfiguration()
    {
        new Configuration(array('entities' => 123));
    }

}
