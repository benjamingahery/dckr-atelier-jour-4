<?php

namespace tests;

require 'src/utils.php';

class ElementTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyElement()
    {
        $this->assertFalse(isShoppingListElementValid(''));
    }
}