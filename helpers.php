<?php 


function  Clean($input){
      
      $value = trim($input);
      $value = htmlspecialchars($value);
      $value = stripcslashes($value);
      return $value;  
    
  } 
 


  function validate($input,$flag){
   
    $status = true;

     switch ($flag) {
         case 1:
             # code...
             if(empty($input)){
                $status = false;
             }
             break;
       // validate title --string--
       case 2:
          if(!is_string($input)){

            $status=false;
          }
          break;
   
        case 3: 
            if(!strlen($input) > 100){
                $status = false;
            }
            break;
case 4:
  if(is_int($input)){

    $status=true;
  }
  break;
     }

     return $status;
  }
  
 
  
  
  
  ?>