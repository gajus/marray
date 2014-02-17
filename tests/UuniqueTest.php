<?php
class Uunique extends PHPUnit_Framework_TestCase {
    public function testOneUnique () {
        $unique = \Gajus\Marray\Uunique([ ['a', 1], ['a', 2], ['a', 3] ], function ($e) {
            return $e[0];
        });

        $this->assertSame([ ['a', 1] ], $unique);
    }

    public function testTwoUnique () {
        $unique = \Gajus\Marray\Uunique([ ['a', 1], ['b', 2], ['c', 2] ], function ($e) {
            return $e[1];
        });

        $this->assertSame([ ['a', 1], ['b', 2] ], $unique);
    }
}