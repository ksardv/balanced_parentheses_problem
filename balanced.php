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
    foreach($splitString as $st) {
      //  If the input string contains an opening parenthesis,
      //  push in on to the array.
      if ($st == '(' || $st == '{' || $st == '[') {
        array_push($arr, $st);
      } else {
      // In the case of valid parentheses, the array cannot be 
      // be empty if a closing parenthesis is encountered.
        if(count($arr) == 0) {
            return false;
        }
        // If the input string contains a closing bracket,
        // then remove the corresponding opening parenthesis if
        // present.
        $top = end($arr);
        if($st == ')' && $top == '(' ||
        $st == '}' && $top == '{' ||
        $st == ']' && $top == '['){
          array_pop($arr);
        }
      }
      }
    //  Checking the status of the stack to determine the
    //  validity of the string.
    if(count($arr) == 0) {
      return true;
    } else {
      return false;
    }
  }
  
$start_time = microtime(true);

foreach ($strings as $string){
    if(isValid($string)){
        echo("Yes\n");
    }else{
        echo("No\n");
    }   
}

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);
echo " It takes ". $execution_time." seconds to execute the script";