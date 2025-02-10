<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=Phones', 'root' , '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$search = $_GET['search'] ?? '';
if ($search){
  $statement = $pdo->prepare('SELECT * FROM Phones WHERE title LIKE :title ORDER BY create_date DESC');
  $statement->bindValue(':title', "%$search%", PDO::PARAM_STR);
} else {
  $statement = $pdo->prepare('SELECT * FROM Phones ORDER BY create_date DESC');
}

$statement->execute();
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
    <p>
<a href="create.php" class="btn btn-success">CREATE PRODUCT</a>
    </p>

<form action="">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search for Product" name="search"
  value="<?php echo $search ?>">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
  </div>
</div>
</form>

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
      <td>
        <img src="<?php echo $product['Image'] ?>" class="thumb-image">
      </td>
      
      <td><?php echo $product['Price'] ?></td>
      <td><?php echo $product['Title'] ?></td>
      <td><?php echo $product['Create_Date'] ?></td>
      <td>
      <a href="update.php?id=<?php echo $product['id'] ?>" type="button" class="btn btn-outline-primary">Edit</a>
      <form style="display: inline-block" method="post" action="delete.php">
        <input type="hidden"name="id" value="<?php echo $product['id'] ?>">
      <button type="submit" class="btn btn-outline-danger">Delete</button>
      </form>
      </td>
     
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
   
  </body>
</html>