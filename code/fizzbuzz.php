<?php

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