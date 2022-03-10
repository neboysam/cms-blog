<?php

$array = [
    
  'username' => '1',
  'password' => '2',
  'email' => '3'
    
];

foreach($array as $key => $value) {
    
    if(!empty($value)) {
        
        echo $key . " " . $value . "<br>";
        
    }
    
}

$str1 = "opa";
$str2 = "opacupa";

$result = strpos($str2, $str1);

if($result !== false) {
    echo "These strings are equal";
} else {
    echo "Strings are not equal";
}

?>