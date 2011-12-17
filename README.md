PHPUnit Test::More Helpers
==========================

To let you define Test::More like unit testing and also based on the great PHPUnit framework.

In your phpunit.xml, define the bootstrap script, and require the test helpers:

    // In your tests/bootstrap.php
    require 'tests/testmore_helpers.php';

In your PHPUnit test case, you can:

    class FooTest extends PHPUnit_Framework_TestCase
    {
        function test()
        {
            $foo = new Foo;
            ok( $foo );
            ok( $foo , 'message' );
            is( 1, 1 );
            is( 1, 1 , 'message' );
            count_ok( 3 , array( ... ) );
            not_ok( false );
            is_true( true );  // === true
            is_false( false );  // === false

            like( '/pattern/' , 'string' );
        }
    }

Methods
-------
- ok
- not\_ok
- is
- like
- is\_false
- is\_true
- count\_ok
