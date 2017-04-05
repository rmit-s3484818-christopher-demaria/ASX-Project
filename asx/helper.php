<?php

if (!function_exists('ppd'))
{
    function ppd($value)
    {
        pp($value);
        die;
    }
}