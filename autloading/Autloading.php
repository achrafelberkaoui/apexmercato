<?php
spl_autoload_register(function(string $class){
    $files = __DIR__ . "\\..\\" . $class . ".php";
    $path = str_replace("\\","/",$files);
    if(file_exists($path)){
        require $path;
    }
});