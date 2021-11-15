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
       
       case 2:
          if(!date($input)){

            $status=false;
          }
          break;
   
        case 3: 
            if(!filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
            }
            break;

     }

     return $status;
  }
  
 
  
  
  
  ?>