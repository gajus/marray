<?php
class IntersectInverseTest extends PHPUnit_Framework_TestCase {
    public function testNoIntersection () {
        $this->assertCount(0, \Gajus\Marray\intersect_inverse(['foo' => 'Foo', 'bar' => 'Bar'], ['baz', 'qux']));
    }

    public function testIntersection () {
        $intersection = \Gajus\Marray\intersect_inverse(['foo' => 'Foo', 'bar' => 'Bar', 'baz' => 'Baz'], ['foo', 'baz']);

        $this->assertCount(2, $intersection);
        $this->assertArrayHasKey('foo', $intersection);
        $this->assertArrayHasKey('baz', $intersection);
    }

    /**
     * @expectedException Gajus\Marray\Exception\InvalidArgumentException
     * @expectedExceptionMessage Input is not an associative array.
     */
    public function testIntersectionInvalidSource () {
        \Gajus\Marray\intersect_inverse(['foo', 'bar', 'baz'], ['foo', 'baz']);
    }
}