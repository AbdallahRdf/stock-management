<?php

spl_autoload_register(function ($class){
   
   //* replace "\" with "/" and add ".php";
   $file = str_replace("\\", "/", $class).".php";

   //* split the string to get each folder name
   $folders_titles = explode("/", $file);

   //* turn the names of the folders to lowercase except the last one;
   for ($i = 0; $i < count($folders_titles) - 1; $i++) {
      if ($i !== count($folders_titles) - 1) {
         $folders_titles[$i] = lcfirst($folders_titles[$i]);
      }
   }

   //* join the array to get the path to the file
   $path = implode("/", $folders_titles);

   //* build the complete path;
   $full_path = __DIR__."/../../".$path;
   
   if(file_exists($full_path))
   {
      require_once $full_path;
   }
});