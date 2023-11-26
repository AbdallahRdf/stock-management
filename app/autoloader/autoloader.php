<?php

spl_autoload_register(function ($class)
{
   //* split the array to get each folder name
   $folders_titles = explode("\\", $class);

   //* turn the names of the folders to lowercase except the last one;
   for ($i = 0; $i < count($folders_titles) - 1; $i++)
   {
      $folders_titles[$i] = strtolower($folders_titles[$i]);
   }

   //* join the array to get the path to the file
   $path = implode("/", $folders_titles);
   
   //* build the complete path;
   $full_path = __DIR__."/../../".$path.".php";

   if(file_exists($full_path))
   {
      require_once $full_path;
   }
});