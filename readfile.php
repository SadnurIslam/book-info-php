<?php 
    $booksJson = file_get_contents('books.json');
    $books = json_decode($booksJson, true);
    $keys = array('title', 'author', 'available', 'pages', 'isbn');
?>