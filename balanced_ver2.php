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
  
// Match closing bracket 
function matchClosing($X, $start, $end,  
                          $open, $close) 
{ 
    $c = 1; 
    $i = $start + 1; 
    while ($i <= $end)  
    { 
        if ($X[$i] == $open)  
        { 
            $c++; 
        }  
        else if ($X[$i] == $close)  
        { 
            $c--; 
        } 
        if ($c == 0)  
        { 
            return $i; 
        } 
        $i++; 
    } 
    return $i; 
} 
  
// Match opening bracket 
function matchingOpening($X, $start, $end,  
                             $open, $close)  
{ 
    $c = -1; 
    $i = $end - 1; 
  
    while ($i >= $start)  
    { 
        if ($X[$i] == $open) 
        { 
            $c++; 
        }  
        else if ($X[$i] == $close)  
        { 
            $c--; 
        } 
        if ($c == 0) 
        { 
            return $i; 
        } 
        $i--; 
    } 
    return -1; 
} 
  
function isBalanced($X, $n)  
{ 
    $j = 0;
  
    for ($i = 0; $i < $n; $i++)  
    { 
        // Handling case of opening parentheses 
        if ($X[$i] == '(') 
        { 
            $j = matchClosing($X, $i, $n - 1, '(', ')'); 
        }  
        else if ($X[$i] == '{')  
        { 
            $j = matchClosing($X, $i, $n - 1, '{', '}'); 
        }  
        else if ($X[$i] == '[')  
        { 
            $j = matchClosing($X, $i, $n - 1, '[', ']'); 
        } 
          
        // Handling case of closing parentheses 
        else 
        { 
            if ($X[$i] == ')') 
            { 
                $j = matchingOpening($X, 0, $i, '(', ')'); 
            }  
            else if ($X[$i] == '}')  
            { 
                $j = matchingOpening($X, 0, $i, '{', '}'); 
            }  
            else if ($X[$i] == ']') 
            { 
                $j = matchingOpening($X, 0, $i, '[', ']'); 
            } 
  
            // If corresponsing matching opening parentheses  
            // doesn't lie in given interval return 0 
            if ($j < 0 || $j >= $i)  
            { 
                return false; 
            } 
  
            // else continue 
            continue; 
        } 
  
        // If corresponding closing parentheses 
        // doesn't lie in given interval 
        // return 0 
        if ($j >= $n || $j < 0)  
        { 
            return false; 
        } 
  
        // if found, now check for each opening  
        // and closing parentheses in this interval 
        $start = $i; 
        $end = $j; 
  
        for ($k = $start + 1; $k < $end; $k++) 
        { 
            if ($X[$k] == '(')  
            { 
                $x = matchClosing($X, $k, $end, '(', ')'); 
                if (!($k < $x && $x < $end))  
                { 
                    return false; 
                } 
            }  
            else if ($X[$k] == ')') 
            { 
                $x = matchingOpening($X, $start, $k, '(', ')'); 
                if (!($start < $x && $x < $k))  
                { 
                    return false; 
                } 
            } 
  
            if ($X[$k] == '{') 
            { 
                $x = matchClosing($X, $k, $end, '{', '}'); 
                if (!($k < $x && $x < $end)) 
                { 
                    return false; 
                } 
            }  
            else if ($X[$k] == '}') 
            { 
                $x = matchingOpening($X, $start, $k, '{', '}'); 
                if (!($start < $x && $x < $k)) 
                { 
                    return false; 
                } 
            } 
            if ($X[$k] == '[')  
            { 
                $x = matchClosing($X, $k, $end, '[', ']'); 
                if (!($k < $x && $x < $end)) 
                { 
                    return false; 
                } 
            }  
            else if ($X[$k] == ']') 
            { 
                $x = matchingOpening($X, $start, $k, '[', ']'); 
                if (!($start < $x && $x < $k)) 
                { 
                    return false; 
                } 
            } 
        } 
    } 
  
    return true; 
} 

$start_time = microtime(true);

foreach($strings as $string){
    $splittedStr = str_split($string);
    if (isBalanced($splittedStr, count($splittedStr))) 
        echo("Yes\n"); 
    else
        echo("No\n"); 
}

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);
echo " It takes ". $execution_time." seconds to execute the script";
