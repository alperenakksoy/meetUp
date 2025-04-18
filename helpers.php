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

 function loadWelcomePartial($name){
    $partialPath = basePath("App/views/welcomePartials/{$name}.php");
    if(file_exists($partialPath)){
       require $partialPath;
   } else {
      echo "view '{$name} not found!'";
   }
  }

 /** Inspect value(s)
  * @param mixed $value 
  * @return void
  */
  function inspect($value){
   echo '<pre>';
   var_dump($value);
   echo '</pre>';
  }
/** Inspect value(s) and die
 * @param mixed $value 
 * @return void
 */
function inspectAndDie($value): void {
   echo '<pre>';
   var_dump($value);
   echo '</pre>';
   die(); // Ensure output is printed before termination
}

/**   
 * Sanitize Data TO prevent instert a code in to the post method for security
 * 
 * @return string $dirty
 * @return string
 */

 function sanitize($dirty){
   return filter_var(trim($dirty),FILTER_SANITIZE_SPECIAL_CHARS);
 }

 /**
  * Redirect to a given URL
  * 
  * @param string $url
  * @return void
  */

  function redirect($url){
   header("Location: {$url}");
   exit;
  }