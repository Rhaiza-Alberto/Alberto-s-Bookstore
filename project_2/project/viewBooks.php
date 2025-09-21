<?php
require_once "../classes/books.php";
$booksObj = new Books();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: white;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 28px;
    }

    .top-bar {
      text-align: right;
      margin-bottom: 15px;
    }

    .add-btn {
      background-color: blue;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 15px;
      display: inline-block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
    }

    th, td {
      border: 1px solid black;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: lightgray;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      color: black;
      text-decoration: none;
    }
    </style>
</head>
<body>
    <h1>View Books</h1>
    <button><a href="addbooks.php">Add Books</button>
    <table border="1">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Publication Year</th>
            </tr>
    
            <?php 
            $no = 1;
            foreach ($booksObj->viewBooks() as $books) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $books["title"]; ?></td>
                <td><?= $books["author"]; ?></td>
                <td><?= $books["genre"]; ?></td>
                <td><?= $books["publication_year"]; ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
</body>
</html>