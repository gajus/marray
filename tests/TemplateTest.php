<?php
class TemplateTest extends PHPUnit_Framework_TestCase {
    /**
     * @expectedException Gajus\Marray\Exception\InvalidArgumentException
     * @expectedExceptionMessage Template does not cover input.
     */
    public function testNoIntersection () {
        $this->assertCount(0, \Gajus\Marray\template(['foo' => 'Foo', 'bar' => 'Bar'], ['baz', 'qux']));
    }

    public function testIntersection () {
        $intersection = \Gajus\Marray\template(['foo' => 'Foo', 'bar' => 'Bar', 'baz' => 'Baz'], ['foo', 'baz']);

        $this->assertCount(2, $intersection);
        $this->assertArrayHasKey('foo', $intersection);
        $this->assertArrayHasKey('baz', $intersection);
    }

    /**
     * @expectedException Gajus\Marray\Exception\InvalidArgumentException
     * @expectedExceptionMessage Input is not an associative array.
     */
    public function testInvalidSource () {
        \Gajus\Marray\template(['foo', 'bar', 'baz'], ['foo', 'baz']);
    }

    /**
     * @expectedException Gajus\Marray\Exception\InvalidArgumentException
     * @expectedExceptionMessage Template is not a list.
     */
    public function testInvalidWhitelist () {
        \Gajus\Marray\template(['foo' => 'Foo', 'bar' => 'Bar', 'baz' => 'Baz'], ['foo' => 'Foo', 'baz' => 'Baz']);
    }
}