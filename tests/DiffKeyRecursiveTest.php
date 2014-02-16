<?php
class DiffKeyRecursiveTest extends PHPUnit_Framework_TestCase {
    public function testNoDiff () {
        $source = ['foo' => 'Foo', 'bar' => ['bar' => 'Bar']];

        $this->assertCount(0, \Gajus\Marray\diff_key_recursive($source, $source));
    }

    public function testSomeDiff () {
        $diff = \Gajus\Marray\diff_key_recursive(['foo' => 'Foo', 'bar' => ['bar' => 'test']], ['bar' => ['bar' => null]]);

        $this->assertCount(1, $diff);
        $this->assertArrayHasKey('foo', $diff);
    }

    public function testAllDiff () {
        $source = ['foo' => 'Foo', 'bar' => ['bar' => 'test']];

        $diff = \Gajus\Marray\diff_key_recursive($source, ['bat' => ['bar' => null]]);

        $this->assertCount(2, $diff);
        $this->assertSame($source, $diff);
    }
}