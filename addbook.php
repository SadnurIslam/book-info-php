<?php require 'readfile.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'head.php'; ?>
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
    </style>
</head>
<body>
    <div class="container2 container">
    <br>
    <form action="addbook.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td width="22%"><label for="title">Title: </label></td>
                    <td>
                    <input class="form-control" type="text" id="title" name="title" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="author">Author: </label></td>
                    <td><input class="form-control" type="text" id="author" name="author" required></td>
                </tr>
                <tr>
                    <td><label for="available">Available: </label></td>
                    <td>
                        <input type="radio" value="1" name="available" checked>Yes
                        <input type="radio" value="" name="available">No 
                    </td>
                </tr>
                <tr>
                    <td><label for="pages">Pages: </label></td>
                    <td><input class="form-control" type="text" id="pages" name="pages" required></td>
                </tr>         
                <tr>
                    <td><label for="isbn">isbn: </label></td>
                    <td><input class="form-control" type="text" id="isbn" name="isbn" required></td>
                </tr>    
                <tr>
                    <td></td>
                    <td style="text-align:center"><button id="back" class="btn btn-secondary">Back</button><input class="btn btn-success" type="submit" value="Save" name="submit" id="btn">
                    </td>
                </tr>   
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
        $newBook = array('title' => $title, 'author' => $author, 'available' => $available, 'pages' => $pages, 'isbn' => $isbn);
        $books[] = $newBook;
        $booksJson = json_encode($books, JSON_PRETTY_PRINT);
        file_put_contents('books.json', $booksJson);
        echo "<script>window.location.href = 'index.php';</script>";
    }
    ?>
    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('back').addEventListener('click', function(){
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>