<?php

$strings = [
    '(())', //yes
    '())', //no
    '(', //no
    '(()())', //yes
    ')()(', //no
    '(())()([{}])({})', //yes
    '({)}' //no
];

function isValid(string $str): bool
{
    $arr = [];
    $splitString = str_split($str);
    
    foreach ($splitString as $st) {
      //  If the input string contains an opening bracket,
      //  push in on to the array.
        if ($st == '(' || $st == '{' || $st == '[') {
            array_push($arr, $st);
        } else {
      // In the case of valid bracket, the array cannot be
      // be empty if a closing bracket is encountered.
            if (count($arr) == 0) {
                return false;
            }
        // If the input string contains a closing bracket,
        // then remove the corresponding opening bracket if
        // present.
            $last = end($arr);
            if ($st == ')' && $last == '(' ||
            $st == '}' && $last == '{' ||
            $st == ']' && $last == '[') {
                array_pop($arr);
            }
        }
    }
    //  Checking the status of the array to determine the
    //  validity of the string.
    if (count($arr) == 0) {
        return true;
    } else {
        return false;
    }
}

function checkStrings(array $strings): void
{
    foreach ($strings as $str) {
        if (isValid($str)) {
            echo("Yes\n");
        } else {
            echo("No\n");
        }
    }
}

checkStrings($strings);
