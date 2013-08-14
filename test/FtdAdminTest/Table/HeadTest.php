<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace FtdAdminTest\Table;


use FtdAdmin\Table\Head;

class HeadTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $head = new Head(['id', 'display_name']);
        $this->assertEquals(['id' => 'Id', 'display_name' => 'Display name'], iterator_to_array($head));
    }

}
