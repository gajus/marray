<?php
class IntersectRecursiveTest extends PHPUnit_Framework_TestCase {
    public function testNoIntersection () {
        $this->assertCount(0, \Gajus\Marray\intersect_recursive(['foo' => 'Foo', 'bar' => ['Bar']], ['foo', 'bar' => 'Bar']));
    }

    public function testSomeIntersection () {
        $intersection = \Gajus\Marray\intersect_recursive(['foo' => 'Foo', 'bar' => 'Bar', 'baz' => ['baz' => 'Baz']], ['foo' => 'Foo', 'baz' => ['baz' => 'Baz']]);

        $this->assertCount(2, $intersection);
        $this->assertArrayHasKey('foo', $intersection);
        $this->assertArrayHasKey('baz', $intersection);
    }

    public function testAllIntersection () {
        $source = ['foo' => 'Foo', 'bar' => 'Bar', 'baz' => ['baz' => 'Baz']];

        $intersection = \Gajus\Marray\intersect_recursive($source, $source);

        $this->assertSame($source, $intersection);
    }

    public function testSomeIntersectMultipleSource () {
        $input = ['foo' => 'Foo', 'baz' => ['baz' => 'Baz']];

        $intersection = \Gajus\Marray\intersect_recursive($input, ['foo' => 'Foo', 'bar' => -1, 'baz' => ['baz' => 'Baz']], ['foo' => 'Foo', 'bar' => 1, 'baz' => ['baz' => 'Baz']]);

        $this->assertSame($input, $intersection);
    }
}