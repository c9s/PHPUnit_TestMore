<?php
/*
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @VERSION 1.3.2
 */

if (! defined('DEBUG_BACKTRACE_PROVIDE_OBJECT')) {
    define( 'DEBUG_BACKTRACE_PROVIDE_OBJECT', true);
}

use PHPUnit\Framework\TestCase;

function get_testcase_object() 
{
    $objs = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT );
    foreach($objs as $obj) {
        if ( isset($obj['object']) 
            && ($obj['object'] instanceof PHPUnit_Framework_TestCase
            ||  $obj['object'] instanceof TestCase) )
        {
            return $obj['object'];
        }
    }

    return NULL;
}

function ok( $v , $msg = '' )
{
    $test = get_testcase_object();
    $test->assertTrue( (bool) $v , $msg );
    return (bool) $v;
}

function not_ok( $v , $msg = '' )
{
    $test = get_testcase_object();
    $test->assertFalse( (bool) $v , $msg );
    return (bool) $v;
}

function is( $expected , $v , $msg = '' )
{
    $test = get_testcase_object();
    $test->assertEquals( $expected , $v , $msg );
    return $expected === $v;
}


function isa_ok( $expected , $v , $msg = '' )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertInstanceOf( $expected , $v , $msg );
}

function is_class( $expected , $v , $msg = '' )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertInstanceOf( $expected , $v , $msg );
}

function count_ok( $expected, $v, $msg = '' )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertCount( $expected , $v , $msg );
}

function select_ok( $selected , $expected , $xml )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $dom = null;
    if( is_string($xml) ) {
        $dom = new DOMDocument;
        $dom->loadXML($xml);
    } else {
        $dom = $xml;
    }

    $testobj = $stacks[1]['object'];
    $testobj->assertSelectCount( $selected , $expected , $dom );
}

function skip( $msg )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->markTestSkipped( $msg );
}

function contains_ok($e,$v, $msg = '')
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertContains($e,$v,$msg);
}

function like( $e, $v , $msg = '' )
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertRegExp($e,$v,$msg);
}

function is_true($e,$v,$msg = '')
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertTrue($e,$v,$msg);
}

function is_false($e,$v,$msg= null)
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT ); 
    $testobj = $stacks[1]['object'];
    $testobj->assertFalse($e,$v,$msg);
}

function file_equals($e,$v,$msg = '')
{
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT );
    $testobj = $stacks[1]['object'];
    $testobj->assertFileEquals($e,$v,$msg);
}

function file_ok( $path , $msg = '' ) {
    $stacks = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT );
    $testobj = $stacks[1]['object'];
    $testobj->assertFileExists($path , $msg );
    $testobj->assertTrue( is_file( $path ) , $msg );
}

function class_ok( $val , $msg = '' )
{
    $test = get_testcase_object();
    $test->assertTrue( class_exists( $val ) , $msg ?: sprintf('Class %s exists', $val));
}

function path_ok( $path , $msg = '' )
{
    $test = get_testcase_object();
    $test->assertFileExists($path , $msg );
}

function dir_ok($path, $msg = '')
{
    $test = get_testcase_object();
    $test->assertFileExists($path , $msg , sprintf('Directory %s exists.', $path) );
    $test->assertTrue( is_dir($path) , sprintf('Path %s is a directory.', $path) );
}

function same($e,$v) 
{
    $test = get_testcase_object();
    $test->assertSame($e,$v);
}

function same_ok($e,$v) 
{
    $test = get_testcase_object();
    $test->assertSame($e,$v);
}

function null_ok($e)
{
    $test = get_testcase_object();
    $test->assertNull($e);
}


/**
 * Assert object has an attribute
 *
 */
function object_attribute_ok($o,$attributeName)
{
    $test = get_testcase_object();
    $test->assertNotNull($o, "object " . $o::class . " is not empty");
    $test->assertObjectHasAttribute($attributeName, $o);
}

function is_empty($e,$msg = '')
{
    $test = get_testcase_object();
    $test->assertEmpty($e,$msg);
}

function array_key_ok($array,$key,$msg = '')
{
    $test = get_testcase_object();
    $test->assertArrayHasKey($key,$array, $msg);
}


/**
 * Assert html tags
 */
function tag_ok($matcher,$actual, $message = '',$isHtml = true)
{
    $test = get_testcase_object();
    $test->assertTag($matcher,$actual, $message, $isHtml);
}


function dump($e)
{
    var_dump($e);
    ob_flush();
}



