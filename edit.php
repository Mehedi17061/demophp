<?php 
include_once "./app/db.php";
include_once "./app/function.php";


 
 if (isset($_POST['submit'])) {


  echo  $name = $_POST['name'];
  echo  $email = $_POST['email'];
  echo  $cell = $_POST['cell'];
  echo  $username = $_POST['username'];
  echo  $age = $_POST['age'];
  echo  $bdate = $_POST['bdate'];
  echo  $gender = $_POST['gender'];
  echo  $location = $_POST['location'];

  echo  $id = $_GET['edit_id'];
  


  //upload file 


//  $data  =  move($_FILES['photos'],'app/assets/');
//  $unique_name = $data['unique_name'];
//  $err_msg = $data['err_msg'];
//   echo "<br>";


  


  if (empty($name) || empty($email) || empty($cell) || empty($username) || empty($age) || empty($bdate) || empty($gender)) {
    $msg = validate("All field are requied!");
  }

  /*elseif(!preg_match("/^[a-zA-Z-']*$/",$name)){
 $msg = validate("Should be latter!","warning");
}*/ elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg = validate("Give me right email!", "warning");
  }

  /*elseif(!preg_match("/^[0-9-']*$/",$cell)){
   $msg = validate("Should be number!","warning");
  }*/ else {

    if(!empty($_FILES['photos']['name']))
    {
      $data = move($_FILES['photos'],'app/assets/');
      $photo_name = $data['unique_name'];
      unlink('app/assets/'.$_POST['old_photos']);

    }
    else
    {
    $photo_name = $_POST['old_photos'];
    }

    $update_at = date('y-m-d');


    $sql = "UPDATE info SET name='$name',email='$email',cell='$cell',username='$username',age='$age',bdate='$bdate',gender='$gender',location='$location', photo='$photo_name' ,upadate_at = '$update_at' WHERE id= '$id' ";


      if (connect()->query($sql)) {
        $msg = validate("Data Update ", "success");
        header('location:index.php');
      } else {
        $msg = validate("Data not insert ", "warning");
      }

   
  }
}

 


if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];

    $data = viewData('info',$id);

    $row = $data->fetch_object();

}


?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


 

  <div class="container">
    <div class="card w-50 mx-auto">

        <div class="card-body">
          <?php 
          if(isset($msg))
          {
            echo $msg;
          }
          ?>
          <a href="index.php" class="btn btn-sm btn-primary">Back</a>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="" class="form-label">Name</label>
              <input type="text" name="name" value="<?php echo $row->name;?>" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="text" name="email"value="<?php echo $row->email;?>" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Phone</label>
              <input type="text" name="cell"value="<?php echo $row->cell;?>" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Usename</label>
              <input type="text" name="username"value="<?php echo $row->username;?>" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Age</label>
              <input type="number" name="age"value="<?php echo $row->age;?>" class="form-control" id="">
            </div>


            <div class="mb-3">
              <label for="" class="form-label">Birth date</label>
              <input type="date" value="<?php echo $row->bdate;?>" name="bdate" class="form-control" id="">
            </div>

            <div class="mb-3">

              <label for="" class="form-label">Gender</label> <br>
              <input type="radio" <?php echo ($row->gender=="Male"?'checked':'');?> name="gender" class="" value="Male" id="male"> <label for="male">Male</label>
              <input type="radio" <?php echo ($row->gender=="Female"?'checked':'');?> name="gender" class="" value="Female" id="female"> <label for="female">Female</label>
              <input type="radio" <?php echo ($row->gender=="Other"?'checked':'');?> name="gender" class="" value="Other" id="other"> <label for="other">Other</label>

            </div>


            <div class="mb-3">
              <label for="" class="form-label">Location</label><br>
              <select class="form-select" name="location" id="">
                <option value="">-select-</option>
                <option <?php echo ($row->location=="Dhaka"?'selected':'');?> value="Dhaka">Dhaka</option>
                <option <?php echo ($row->location=="Khulna"?'selected':'');?> value="Khulna">Khulna</option>
                <option <?php echo ($row->location=="Barisal"?'selected':'');?> value="Barisal">Barisal</option>
                <option <?php echo ($row->location=="Gopalganj"?'selected':'');?> value="Gopalganj">Gopalganj</option>
                <option <?php echo ($row->location=="Jossore"?'selected':'');?> value="Jossore">Jossore</option>
              </select>
            </div>


            <div class="mb-3">
              <label for="" class="form-label">Profile Photo </label><br>
              <img width="100" id="autoLoadPhoto" src="app/assets/<?php echo $row->photo;?>" alt=""><br>
              <label for="photo_upload"><img width="40" src="../studentCurd/assets/image/photo.png" alt=""></label>
              <input type="file" style="display: none;" name="photos" id="photo_upload">
              <input type="text"  value="<?php echo $row->photo;?>" name="old_photos" id="">
            </div>  




            <div class="mb-3 text-end">
              <input type="submit" value="Edit Student" class="btn btn-primary" name="submit">
            </div>

          </form>

        </div>
    </div>
  </div>



          








  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


  <script>
      $('#photo_upload').change(function(e) {

let file_url = URL.createObjectURL(e.target.files[0]);

$('#autoLoadPhoto').attr('src', file_url);



});
  </script>



</body>

</html>