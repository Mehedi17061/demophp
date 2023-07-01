
<?php 
include_once "./app/db.php";
include_once "./app/function.php";

if(isset($_GET['delete_id']))
{
  $delete_id = $_GET['delete_id'];
  $photo_id = $_GET['photo'];
  echo $delete_id;

  unlink('app/assets/'.$photo_id);

  trash("info", $delete_id);
  header("location:index.php");

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<a href="index.php">back</a>
    <div class="wrapp">
        <div class="card shadow">
            <div class="card-body">
                <h2>All Friends Data</h2>


                <table class="table table-bordered  border-primary">
                    <?php

                    $sql = "SELECT * FROM info WHERE trash='1'";
                    $data = connect()->query($sql);

                    while ($row = $data->fetch_assoc()) :
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
                                    <!-- <a href="view.php?view_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">View</a> -->
                                    <a id="delete_btn" href="?delete_id=<?php echo $row['id']; ?>&photo=<?php echo $row['photo']; ?>"  name="delete" class="btn btn-sm btn-warning">Delete</a>
                                    <!-- <a href="edit.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Edit</a> -->
                                    <!-- <a href="trash.php" class="btn btn-sm btn-info">Trash</a> -->
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
         $('#delete_btn').click(function(){

let confirmation =  confirm('Are you sure');

if(confirmation == true)
{
  return true;
}
else
{
  return false;
}


});
    </script>


</body>

</html>