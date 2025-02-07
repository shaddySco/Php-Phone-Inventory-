<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=Phones', 'root' , '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT*FROM Phones ORDER BY create_date DESC');
$statement -> execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);



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
    <h1>Products CRUD</h1>

    <a href="create.php" class="btn btn-success">CREATE PRODUCT</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Title</th>
      <th scope="col">create_date</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $i => $product): ?>
        <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td></td>
      
      <td><?php echo $product['Price'] ?></td>
      <td><?php echo $product['Title'] ?></td>
      <td><?php echo $product['Create_Date'] ?></td>
      <td>
      <button type="button" class="btn btn-outline-primary">Edit</button>
      <button type="button" class="btn btn-outline-danger">Delete</button>
      </td>
     
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
   
  </body>
</html>