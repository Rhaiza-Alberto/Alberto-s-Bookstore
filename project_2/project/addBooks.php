<?php

require_once "../classes/books.php";
$booksObj = new Books();

$books = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];
$error = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $books["title"] = trim(htmlspecialchars($_POST["title"] ?? ""));
    if(empty($books["title"])){
        $error["title"] = "Title is required";
    }
    $books["author"] = trim(htmlspecialchars($_POST["author"] ?? ""));
    if(empty($books["author"])){
        $error["author"] = "Author is required";
    }
    $books["genre"] = trim(htmlspecialchars($_POST["genre"] ?? ""));
    if(empty($books["genre"])){
        $error["genre"] = "Genre is required";
    }
    $books["publication_year"] = trim(htmlspecialchars($_POST["publication_year"] ?? ""));
if(!empty($books["publication_year"])) {
    if(!is_numeric($books["publication_year"])) {
        $error["publication_year"] = "Publication year must be a number";
    } elseif(strlen($books["publication_year"]) != 4) {
        $error["publication_year"] = "Publication year must be 4 digits";
    } elseif((int)$books["publication_year"] > date("Y")) {
        $error["publication_year"] = "Publication year cannot be in the future";
    }elseif (empty($books["publication_year"])) {
        $error["publication_year"] = "Publication year is required";
    }
}

    if(empty($error["title"]) && empty($error["author"]) && empty($error["genre"]) && empty($error["publication_year"])){
        $db = new Database();
        $booksObj = new Books($db);
        $booksObj->title = $books["title"];
        $booksObj->author = $books["author"];
        $booksObj->genre = $books["genre"];
        $booksObj->publication_year = $books["publication_year"];
        if($booksObj->addBook()){
            echo "Book added successfully.";
            $books = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];
        }else{
            echo "Failed to add book.";
        }
        echo "Book added successfully.";
        $books = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
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
      text-align: center;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 20px;
      font-size: 28px;
    }

    form {
     width: 400px;
      margin: 0 auto; 
       display: inline-block;  
      text-align: left;     
      padding: 20px;
      border: 1px solid black;
      background-color: white;
      border-radius: 6px;
    }

    label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid black;
      border-radius: 4px;
    }

    .btn-submit {
      background-color: blue;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 15px;
    }

    .btn-submit:disabled {
      background-color: gray;
    }

    .error, span {
      color: red;
      margin: 0;
      font-size: 14px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
    }

    .back-link a {
      background-color: blue;
      color: white;
      padding: 8px 15px;
      border-radius: 6px;
      text-decoration: none;
    }
    </style>
</head>
<body>
    <h1>Add Books</h1>
    <label for="">Field with <span>*</span> is required</label>
    <form action="" method="post">
        <label>Title: <span>*</span></label><br>
        <input type="text" name="title" id="title" value="<?=htmlspecialchars($books["title"])?>"><br>
        <p class="error"><?=htmlspecialchars($error["title"])?></p>
        <label>Author: <span>*</span></label><br>
        <input type="text" name="author" id="author" value="<?=htmlspecialchars($books["author"])?>"><br>
        <p class="error"><?=htmlspecialchars($error["author"])?></p>
        <label>Genre:<span>*</span></label><br>
        <select name="genre" id="genre">
            <option value="">--Select Genre--</option>
            <option value="Fiction"<?= ($books["genre"]=="Fiction")? " selected":""; ?>>Fiction</option>
            <option value="Non-Fiction"<?= ($books["genre"]=="Non-Fiction")? " selected":""; ?>>Non-Fiction</option>
            <option value="Science"<?= ($books["genre"]=="Science")? " selected":""; ?>>Science</option>
            <option value="History"<?= ($books["genre"]=="History")? " selected":""; ?>>History</option>
        </select>
        <p class="error"><?=htmlspecialchars($error["genre"])?></p>
        <label>Publication Year:</label><br>
        <input type="text" name="publication_year" id="publication_year" value="<?=htmlspecialchars($books["publication_year"])?>"><br>
        <p class="error"><?=htmlspecialchars($error["publication_year"])?></p>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>