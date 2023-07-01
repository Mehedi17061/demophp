
<?php 

if(isset($_POST['submit']))
{
    $photo = $_FILES['photos'];
  
    $photo_name =  $photo['name'];
    $photo_temp = $photo['tmp_name'];
 

    $photo_size =  $photo['size'];

    $file_arr = explode('.',$photo_name);
    echo $extension = end($file_arr);


$unique_pro = time().rand();
$unique_name = md5($unique_pro).'.'.$extension;

    move_uploaded_file($photo_temp,'assets/'.$unique_name);

    $conn = new mysqli('localhost','root','','demo');
    // $sql = "INSERT INTO file(photo)VALUES('$unique_name')";
    // $connected = $conn -> query($sql);
    // if($connected)
    // {
    //     echo "connneted";
    // }
    // else
    // {
    //     echo "Not connected";
    // }
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

<img src="" id="load_student_photo" alt="">

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="photos" id="photo_upload">


    <input type="submit" value="submit" name="submit" >
</form>


<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>photo</th>
        </tr>
    </thead>
    <?php 
    global $conn;
$data = "SELECT * FROM file";
$data_connect = $conn->query($data);


while($row= $data_connect->fetch_assoc()):



?>
    <tbody>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><img width="40" src="assets/<?php echo $row['photo'];?>" alt="">
            </td>
        </tr>
    </tbody>

    <?php 
    endwhile;
    ?>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $('#photo_upload').change(function(e){
        let file_url = URL.createObjectURL(e.target.files[0]);

        $('#load_student_photo').attr('src',file_url);
    });

</script>

</body>
</html>






