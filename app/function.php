<?php 
/**
 * validation text ...
 */

function validate($text, $type="danger")
{
     $msg = "<p class='alert alert-$type alert-dismissible '> $text <button data-bs-dismiss = 'alert' class='btn-close'></button>  </p>";
     return  $msg;
 
}

/**
 * select form table;
 */

function all($table)
{
     $sql =  "SELECT * FROM $table";
     return connect()->query($sql);
}

/***
 * 
 */
function viewData($table,$id)
{
     $sql =  "SELECT * FROM $table WHERE id ='$id'";
     $data = connect()->query($sql);
    return $data;
}

/**
 * delete file 
 *
 */

 function delete($table,$id)
 {
//   return connect()->query("DELETE FROM $table WHERE id='$id'");
     return connect()->query("UPDATE $table SET trash='1' WHERE id='$id' ");
 }

 function trash($table,$id)  {

  return connect()->query("DELETE FROM $table WHERE id='$id'");
    
     
 }





/**
 * 
 * file upload 
 */


 function move($file,$location='/',array $type = ['jpg','png','jpeg','gif'])
 {

     $photo_name = $file['name'];
     $photo_temp = $file['tmp_name'];
   
     $name_arr = explode('.', $photo_name);
     $name_extention = end($name_arr);
   
     $unique_pro = time() . rand();
     $unique_name = md5($unique_pro) . '.' . $name_extention;
     $msg = '';

     if(in_array($name_extention,$type)==false)
     {
          $msg = validate('Invalid file formate');
     }
     else
     {
          //upload file ...
          move_uploaded_file($photo_temp, $location . $unique_name);
     }
   
   
   
    

     return[
          'unique_name' => $unique_name,
          'err_msg'     => $msg
     ];


 }


 /**
  * single user data collect
  */

  function dataCheck($table,$column,$data){
     $data_chek = connect()->query("SELECT $column FROM $table WHERE  $column= '$data' ");

     if($data_chek -> num_rows > 0)
     {
          return true;
     }
     else
     {
          return false; 
     }

  }




  /**
   * old function
   */

   function old($name)  {

     if(isset($_POST[$name]))
     {
          return $_POST[$name];
     }
     
   }
 ?>

 

