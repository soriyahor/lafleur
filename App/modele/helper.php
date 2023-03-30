<?php
function is_existe(String $str):bool
{
    return isset($str) && !empty($str);
}