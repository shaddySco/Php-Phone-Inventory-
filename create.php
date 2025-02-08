<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=Phones', 'root' , '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




$errors = [];

$title = '';
$color = '';
$price = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$title = $_POST['Title'];
$color = $_POST['Color'];
$price = $_POST['Price'];
$date = date('Y-m-d H:i:s');



 //form validation
 if(!$title)
 {
    $errors[] = 'Product title is required';
 }

 if(!$price){
    $errors[] = 'Product price is required';
 }

 if(!is_dir('images')){
  mkdir('images');
 }

 if (empty($errors)){
$image = $_FILES['image'] ?? null;
$imagePath = '';
if ($image){

$imagePath = 'images/'.randomString(8).'/'.$image['name'];
mkdir(dirname($imagePath));

  move_uploaded_file($image['tmp_name'], $imagePath);
}
 
 
$statement = $pdo->prepare("INSERT INTO Phones (Title, Image, Color, Price, Create_date)
            VALUES(:title, :image, :color, :price, :date)");

            $statement->bindValue(':title', $title);
            $statement->bindValue(':image', $imagePath);
            $statement->bindValue(':color', $color);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':date', $date);
            $statement->execute();
            header('Location: index.php');
}
}

function randomString($n)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++){
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];
  }

  return $str;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<link rel="stylesheet" href="app.css">
    <title>Product CRUD</title>
  </head>
  <body>
    <h1>Create new products</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
                <?php endforeach; ?>
        </div>
        <?php endif;?>

    <form action="" method="post"  enctype="multipart/form-data">
  <div class="form-group">
    <label>Product Image</label>
    <input type="file" name="image" >
  </div>
  <div class="form-group">
    <label>Product Title</label>
    <input type="text" name="Title" class="form-control" value ="<?php echo $title?>">
  </div>
  <div class="form-group">
    <label>Product Color</label>
    <textarea class="form-control" name="color"></textarea  value ="<?php echo $color?>">
  </div>
  
  <div class="form-group">
    <label>Product Price</label>
    <input type="number" step=".01" name="Price" class="form-control" value ="<?php echo $price?> ">
  </div>
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   
   
  </body>
</html>