<?php 

include_once "./app/db.php";
include_once "./app/function.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>view data..</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

  <?php
         // $data = "SELECT * FROM info";

          if(isset($_GET['view_id']))
          {
            echo $view_id = $_GET['view_id'];
          }

          $alldata = viewData('info',$view_id);
       
        //   $alldata = connect()->query($data);
          //  while ($row = $alldata->fetch_assoc()) :
            $row = $alldata -> fetch_assoc();
          ?>

  <div class="card" style="width: 25rem; display: block;margin: auto;">
  <img  src="./app/assets/<?php echo $row['photo'];?>" class="card-img-top rounded-circle " alt="...">
  <div class="card-body">
  
  <table class="table table-bordered">
    <tr>
      <th>Name</th>
      <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?php echo $row['email'];?></td>

    </tr>
    <tr>
      <th>Useranme</th>
      <td><?php echo $row['username'];?></td>

    </tr>
    <tr>
      <th>Phone</th>
      <td><?php echo $row['cell'];?></td>

    </tr>
    <tr>
      <th>Gender</th>
      <td><?php echo $row['gender'];?></td>

    </tr>

  </table>


    <a href="index.php" class="btn btn-primary px-4 ">Back </a>
  </div>
</div>

<?php 
// endwhile;
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>