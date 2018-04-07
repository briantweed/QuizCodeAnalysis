<?php

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