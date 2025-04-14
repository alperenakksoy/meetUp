<?php

/**
 *  Get the base Path
 * @param string $path
 * @return string
 */
 function basePath($path){
    return __DIR__ . '/' . $path;
 }

 /**
  * Load a view
  * @param string $name
  * @return void
  */
  function loadView($name,$data=[]){
   $viewPath =  basePath("App/views/{$name}.view.php");

   if(file_exists($viewPath)){
      extract($data); // allows us to access data
       require $viewPath;
   } else {
      echo "view '{$name} not found!'";
   }
  }

  /**
 * Load a partial
 * @param string $name
 * @return void
 */
 function loadPartial($name){
   $partialPath = basePath("App/views/partials/{$name}.php");
   if(file_exists($partialPath)){
      require $partialPath;
  } else {
     echo "view '{$name} not found!'";
  }
 }
