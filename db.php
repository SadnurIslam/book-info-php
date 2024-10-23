<?php 

$heading = ['SL','title','author','available','pages','isbn','action'];

$server = "localhost";
$username = "root";
$password = "";
$db_name ="books";
$conn ="";
try{
    $conn = mysqli_connect($server, $username, $password, $db_name);
}
catch(mysqli_sql_exception $e){
    echo $e;
}

function fetch_data(){
    global $conn;
    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $books;
}

$books = fetch_data();


if(isset($_POST['add'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $available = $_POST['available'];
    $pages = $_POST['pages'];
    $isbn = $_POST['isbn'];
    $sql = "INSERT INTO books (title, author, available, pages, isbn) VALUES ('$title', '$author', $available, $pages, '$isbn')";
    if(mysqli_query($conn, $sql)){
        $books = fetch_data();
    }else{
        echo "Error: ".mysqli_error($conn);
    }
}


if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM books WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        $books = fetch_data();
    }else{
        echo "Error: ".mysqli_error($conn);
    }
}



if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM books WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
    $id1 = $book['id'];
    $title1 = $book['title'];
    $author1 = $book['author'];
    $available1 = $book['available'];
    $pages1 = $book['pages'];
    $isbn1 = $book['isbn'];
}


if(isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $available = $_POST['available'];
    $pages = $_POST['pages'];
    $isbn = $_POST['isbn'];
    $sql = "UPDATE books SET title='$title', author='$author', available=$available, pages=$pages, isbn='$isbn' WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        $books = fetch_data();
        header('Location: index.php');
    }else{
        echo "Error: ".mysqli_error($conn);
    }
}


if(isset($_GET['src_btn'])){
    $sql = "SELECT * FROM books where title like '%".$_GET['pattern']."%' or author like '%".$_GET['pattern']."%'";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
}