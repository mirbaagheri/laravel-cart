<?php

namespace Mirbaagheri\Cart\Contracts;

use Mirbaagheri\Cart\CartItem;

interface Calculator
{
    public static function getAttribute(string $attribute, CartItem $cartItem);
}
