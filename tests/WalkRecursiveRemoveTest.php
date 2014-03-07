<?php
class WalkRecursiveRemoveTest extends PHPUnit_Framework_TestCase {
    public function testNotAffected () {
        $input = [
            'foo' => 'bar',
            'baz' => [1, 2, 3]
        ];

        $output = \Gajus\Marray\walk_recursive_remove($input, function () {
            return false;
        });

        $this->assertSame($input, $output);
    }

    public function testRemoveNonRecursive () {
        $input = ['foo' => 1, 'bar' => 1, 'baz' => 2];

        $output = \Gajus\Marray\walk_recursive_remove($input, function ($v, $k) {
            return $v === 1;
        });

        $this->assertSame(['baz' => 2], $output);
    }

    public function testRemoveRecursive () {
        $input = ['foo' => 1, 'bar' => 1, 'baz' => ['qux' => 2]];

        $output = \Gajus\Marray\walk_recursive_remove($input, function ($v, $k) {
            return $v === 1;
        });

        $this->assertSame(['baz' => ['qux' => 2]], $output);
    }
}