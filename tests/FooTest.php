<?php
/*
 * This file is part of the {{ }} package.
 *
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    function test() 
    {
        ok(1);
        ok(true);
        ok('string');
        not_ok(false);
    }

    function test2()
    {
        is(1,1,'msg');
        ok( true );
    }

    function test3()
    {
        count_ok( 3 , [1, 2, 3] );
    }
}

