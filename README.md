# demophp

<?php
include_once './app/db.php';
include_once './app/function.php';
?>

<!-- <?php
if (isset($_POST['khojo'])) {
  $search_id = $_POST['search'];

  $khoja = "SELECT * FROM info WHERE name LIKE '%$search_id%'";
  $khoja_data = connect()->query($khoja);
  while ($rows = $khoja_data->fetch_assoc()) {
    echo "<pre>";
    print_r($rows);
    echo "</pre>";
  }
}

?> -->

<?php
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $photo_id = $_GET['photo'];
  echo $delete_id;

  // unlink('app/assets/'.$photo_id);

  delete("info", $delete_id);
  header("location:index.php");
}

?>


<?php

if (isset($_POST['submit'])) {

  echo  $name = $_POST['name'];
  echo  $email = $_POST['email'];
  echo  $cell = $_POST['cell'];
  echo  $username = $_POST['username'];
  echo  $age = $_POST['age'];
  echo  $bdate = $_POST['bdate'];
  echo  $gender = $_POST['gender'];
  echo  $location = $_POST['location'];

  //upload file 
  $data  =  move($_FILES['photos'], 'app/assets/');
  $unique_name = $data['unique_name'];
  $err_msg = $data['err_msg'];
  echo "<br>";

  // $mail = connect()->query("SELECT email FROM info WHERE email='$email'");

  // echo $email_check = $mail->num_rows;


  // $user_name = connect()->query("SELECT username FROM info WHERE username='$username'");

  // echo $user_name_check = $user_name->num_rows;





  if (empty($name) || empty($email) || empty('cell' || empty('username') || empty('age') || empty($bdate) || empty($gender))) {
    $msg = validate("All field are requied!");
  }

  /*elseif(!preg_match("/^[a-zA-Z-']*$/",$name)){
 $msg = validate("Should be latter!","warning");
}*/ elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg = validate("Give me right email!", "warning");
  } else if (dataCheck('info', 'email ', $email)) {
    $msg = validate("Email all ready exits", 'warning');
  } else if (dataCheck('info', 'username ', $username)) {
    $msg = validate("username all ready exits", 'warning');
  }

  /*elseif(!preg_match("/^[0-9-']*$/",$cell)){
   $msg = validate("Should be number!","warning");
  }*/ else {


    if (empty($err_msg)) {
      $sql = "INSERT INTO info(name,email,cell,username,age,bdate,gender,location,photo)VALUES('$name','$email','$cell','$username','$age','$bdate','$gender','$location','$unique_name')";

      if (connect()->query($sql)) {
        $msg = validate("Data Stable", "success");
      } else {
        $msg = validate("Data not insert ", "warning");
      }
    } else {
      $msg = $err_msg;
    }
  }
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


  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Student Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">



          <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="" class="form-label">Name</label>
              <input type="text" name="name" value="<?php echo old('name');?>" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="text" name="email" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Phone</label>
              <input type="text" name="cell" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Usename</label>
              <input type="text" name="username" class="form-control" id="">
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Age</label>
              <input type="number" name="age" class="form-control" id="">
            </div>


            <div class="mb-3">
              <label for="" class="form-label">Birth date</label>
              <input type="date" name="bdate" class="form-control" id="">
            </div>

            <div class="mb-3">

              <label for="" class="form-label">Gender</label> <br>
              <input type="radio" checked name="gender" class="" value="Male" id="male"> <label for="male">Male</label>
              <input type="radio" name="gender" class="" value="Female" id="female"> <label for="female">Female</label>
              <input type="radio" name="gender" class="" value="Other" id="other"> <label for="other">Other</label>

            </div>


            <div class="mb-3">
              <label for="" class="form-label">Location</label><br>
              <select class="form-select" name="location" id="">
                <option value="">-select-</option>
                <option value="Dhaka">Dhaka</option>
                <option value="Khulna">Khulna</option>
                <option value="Barisal">Barisal</option>
                <option value="Gopalganj">Gopalganj</option>
                <option value="Jossore">Jossore</option>
              </select>
            </div>


            <div class="mb-3">
              <label for="" class="form-label">Profile Photo </label><br>
              <img width="100" id="autoLoadPhoto" src="" alt=""><br>
              <label for="photo_upload"><img width="40" src="../studentCurd/assets/image/photo.png" alt=""></label>
              <input type="file" style="display: none;" name="photos" id="photo_upload">
            </div>




            <div class="mb-3 text-end">
              <input type="submit" value="Add Student" class="btn btn-primary" name="submit">
            </div>

          </form>



        </div>
      </div>
    </div>
  </div>





  <div class="wrapp">
    <div class="card shadow">
      <div class="card-body">
        <h2>All Friends Data</h2>
        <?php
        if (isset($msg)) {
          echo $msg;
        }
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add Student
        </button>

        <form action="" method="POST">
          <input type="search" class="form-control d-inline-block w-25 " name="search" id="">
          <select name="location" id=""></select>
          <input type="submit" value="Khojo" name="khojo">
        </form>

        <table class="table table-bordered  border-primary">

          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Username</th>
              <!-- <th>Age</th> -->
              <!-- <th>Birthdate</th> -->
              <th>Gender</th>
              <th>Location</th>
              <th>Photo</th>
              <th>Action</th>
              <!-- <th>Trash</th> -->
            </tr>
          </thead>


          <?php
          $data = "SELECT * FROM info";
          // $alldata = all('info');
          $alldata = connect()->query($data);

          if (isset($_POST['khojo'])) {
            $search_id = $_POST['search'];

            $data = "SELECT * FROM info WHERE name LIKE '%$search_id%' OR username LIKE '%$search_id%' OR cell LIKE '%$search_id%'";
            $alldata = connect()->query($data);
            // while ($rows = $khoja_data->fetch_assoc()) {
            //   echo "<pre>";
            //   print_r($rows);
            //   echo "</pre>";
            // }
          }


          while ($row = $alldata->fetch_assoc()) :
          ?>


            <tbody>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['cell']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <!-- <td><?php echo $row['age']; ?></td> -->
                <!-- <td><?php echo $row['bdate']; ?></td> -->
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><img width="50" class="rounded-circle" src="app/assets/<?php echo $row['photo']; ?>" alt=""></td>
                <td>
                  <a href="view.php?view_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">View</a>
                  <a id="delete_btn" href="?delete_id=<?php echo $row['id']; ?>&photo=<?php echo $row['photo']; ?>" class="btn btn-sm btn-warning">Delete</a>
                  <a href="edit.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                  <a href="trash.php" class="btn btn-sm btn-info">Trash</a>
                </td>
                <!-- <td><?php echo $row['trash']; ?></td> -->


              </tr>
            </tbody>

          <?php
          endwhile;
          ?>



        </table>
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

    $('#delete_btn').click(function() {

      let confirmation = confirm('Are you sure');

      if (confirmation == true) {
        return true;
      } else {
        return false;
      }


    });
  </script>




</body>

</html>
