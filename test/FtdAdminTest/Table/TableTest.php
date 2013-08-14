<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace FtdAdminTest\Table;


use FtdAdmin\Table\Row;
use FtdAdmin\Table\Table;

class TableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \FtdAdmin\Exception\RuntimeException
     */
    public function testCreateRowException()
    {
        $table = new Table();
        $table->createRow();
    }

    public function testCreateRow()
    {
        $table = new Table();
        $table->setHead(new Row(['id', 'username']));
        $row = $table->createRow();

        $this->assertInstanceOf('FtdAdmin\Table\Row', $row);
        $this->assertEquals(['id', 'username'], $row->getFields());
    }

    public function testIterator()
    {
        $table = new Table();
        $table->setHead(new Row(['id', 'username']));
        $table->createRow();
        $table->createRow();

        $this->assertCount(2, iterator_to_array($table));
    }

    public function testCount()
    {
        $table = new Table();
        $table->setHead(new Row(['id', 'username']));
        $table->createRow();
        $table->createRow();

        $this->assertCount(2, $table);
    }

    public function testCreateHead()
    {
        $table = new Table();
        $head = $table->createHead(['id', 'username']);

        $this->assertInstanceOf('FtdAdmin\Table\Head', $head);
        $this->assertEquals(['id', 'username'], $head->getFields());
    }

    public function testEmptyTable()
    {
        $table = new Table();
        $table->setHead(new Row(['id']));
        $this->assertCount(0, iterator_to_array($table));
    }
}
