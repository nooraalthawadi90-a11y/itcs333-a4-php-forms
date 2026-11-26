<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — implement the three pure validation functions.
 * They are unit-tested by the autograder (tests/UnitTest.php).
 */

function validate_required(string $v): bool
{
    if(trim($v) !== ''){
        return true;
    }
    return false;
}

function validate_email(string $v): bool
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if(preg_match($pattern, trim($v)) === 1){
        return true;
    }
    return false;
}

function validate_length(string $v, int $min, int $max): bool
{
    $len = strlen(trim($v));
    if($len >= $min && $len <= $max){
        return true;
    }
    return false;
}
