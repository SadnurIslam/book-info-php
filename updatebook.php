<?php require 'readfile.php';
    $title1 = $author1 = $available1 = $pages1 = $isbn1 = "";
    $index = "";
    if(isset($_POST['edit'])){
        $index = $_POST['edit'];
        $title1 = $books[$index]['title'];
        $author1 = $books[$index]['author'];
        $available1 = $books[$index]['available'];
        $pages1 = $books[$index]['pages'];
        $isbn1 = $books[$index]['isbn'];
    }

?>

<?php require 'readfile.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'head.php'; ?>
    <title>Update Book | Book Info</title>
    <style>
        td,th{
            border: none;
            padding: 10px 0;
            text-align: left;
        }
        label{
            font-weight: bold;
            font-size: 18px;
        }
        .container2{
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        table{
            width: 100%;
        }
        .btn{
            width: 100px;
            color: white;
        }
        .vis-hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="container2 container">
    <h3 class="text-center">Edit Book Info</h3>
    <br>
    <form action="updatebook.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td width="22%"><label for="title">Title: </label></td>
                    <td>
                    <input class="form-control" type="text" id="title" name="title" value="<?php echo $title1;?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="author">Author: </label></td>
                    <td><input class="form-control" type="text" id="author" name="author" required value="<?php echo $author1;?>"></td>
                </tr>
                <tr>
                    <td><label for="available">Available: </label></td>
                    <td>
                        <input type="radio" value="1" name="available">Yes
                        <input type="radio" value="" name="available">No 
                    </td>
                    <?php if($available1 == true): ?>
                        <script>document.getElementsByName('available')[0].checked = true;</script>
                    <?php else: ?>
                        <script>document.getElementsByName('available')[1].checked = true;</script>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td><label for="pages">Pages: </label></td>
                    <td><input class="form-control" type="text" id="pages" name="pages" required value="<?php echo $pages1;?>"></td>
                </tr>         
                <tr>
                    <td><label for="isbn">isbn: </label></td>
                    <td><input class="form-control" type="text" id="isbn" name="isbn" required value="<?php echo $isbn1;?>"></td>
                </tr>    
                <tr>
                    <td></td>
                    <td style="text-align:center"><button id="back" class="btn btn-secondary">Cancel</button><input class="btn btn-success" type="submit" value="Update" name="submit" id="btn">
                    </td>
                </tr>
                <?php if($index != ""): ?>
                    <input class="vis-hidden" type="text" name="index" value="<?php echo $index; ?>">
                <?php endif; ?>   
            </tbody>
        </table>
    </form>
    </div>
    <?php if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $available = $_POST['available'];
        if($available == 1){
            $available = true;
        }else{
            $available = false;
        }
        $pages = $_POST['pages'];
        $isbn = $_POST['isbn'];
        $index = $_POST['index'];
        $newBook = array('title' => $title, 'author' => $author, 'available' => $available, 'pages' => $pages, 'isbn' => $isbn);
        $books[$index] = $newBook;
        echo $index."<br>";
        $booksJson = json_encode($books, JSON_PRETTY_PRINT);
        file_put_contents('books.json', $booksJson);
        echo "<script>window.location.href = 'editbook.php';</script>";
    }
    ?>
    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('back').addEventListener('click', function(){
            window.location.href = 'editbook.php';
        });
    </script>
</body>
</html>