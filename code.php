<?php


/**
 * 
 * ===================================================
 *   Functions to be evaluated go here
 *   All parameters must be type hinted
 * ===================================================
 * 
 */


function prime(int $finish):array
{
    $number = 2;
    $range  = range($number, $finish);
    $primes = array_combine($range, $range);

    while($number*$number<=$finish)
    {
        for($x=$number; $x<=$finish; $x+=$number)
        {
            if($x!==$number) 
            {
                unset($primes[$x]);
            }
        }
        $number = next($primes);
    }
    return $primes;
}


function fizzbuzz(int $finish):array
{
    $results = [];
    for($x=1; $x<=$finish; $x++)
    {
        $output = '';
        $isFizz = (0 === $x%3);
        $isBuzz = (0 === $x%5);
        if(!$isFizz && !$isBuzz) 
        {
            $results[] = $x;
            continue;
        }
        if($isFizz) $output .= 'fizz';
        if($isBuzz) $output .= 'buzz';
        $results[] = $output;
    }
    return $results;
}

// $x=0;
// while(++$x <= $finish) $results[] = $x%15 ? $x%5 ? $x%3 ? $x : 'fizz' : 'buzz' : 'fizzbuzz';