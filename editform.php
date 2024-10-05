<?php session_start();require 'readfile.php';
    $stitle = $sauthor = $savailable = $spages = $sisbn = '';
    $stitle = $_SESSION ['editBook']['title'];
    $sauthor = $_SESSION ['editBook']['author'];
    $savailable = $_SESSION ['editBook']['available'];
    $spages = $_SESSION ['editBook']['pages'];
    $sisbn = $_SESSION ['editBook']['isbn'];
    $index = $_SESSION ['index'];
    echo $index;
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information</title>
    <style>
        body {
            padding: 50px;
        }
        .container{
            margin: 0 auto;
            border: 1px solid black;
            border-radius: 3px;
            width: 40%;
            padding: 30px 20px;
        }
        input[type=text]{
            margin: 12px 0;
            width: 100%;
            border: 1px solid gray;
            border-radius: 4px;
            height: 22px;
        }
        input[type=radio]{
            border: 2px solid blue;
        }
        table{
            width: 100%;
            margin: auto;
        }
        #btn,#back{
            padding: 5px 10px;
            border-radius: 4px;
            width: 80px;
            margin: 2px 5px;
        }
    </style>
</head>
<body>
    <div class="container">
    <button id="back">&lt;Back</button> <br><br>
    <form action="editform.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td width="15%"><label for="title">Title: </label></td>
                    <td><input type="text" id="title" name="title" required value = "<?php echo $stitle ?>"></td>
                </tr>
                <tr>
                    <td><label for="author">Author: </label></td>
                    <td><input type="text" id="author" name="author" value = "<?php echo $sauthor ?>" required></td>
                </tr>
                <tr>
                    <td><label for="available">Available: </label></td>
                    <td>
                        <input type="radio" value="1" name="available" checked="<?php echo $savailable ?>">Yes
                        <input type="radio" value="" name="available">No 
                    </td>
                </tr>
                <tr>
                    <td><label for="pages">Pages: </label></td>
                    <td><input type="text" id="pages" name="pages" value = "<?php echo $spages ?>" required></td>
                </tr>         
                <tr>
                    <td><label for="isbn">isbn: </label></td>
                    <td><input type="text" id="isbn" name="isbn" value = "<?php echo $sisbn ?>" required></td>
                </tr>    
                <tr>
                    <td></td>
                    <td style="text-align:center"><input type="submit" value="Save" name="submit" id="btn">
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
        foreach($keys as $key){
            $books[$index][$key] = $newBook[$key];
        }
        $booksJson = json_encode($books, JSON_PRETTY_PRINT);
        file_put_contents('books.json', $booksJson);
        echo "<script>window.location.href = 'index.php';</script>";
    }
    ?>
    <script>
        document.getElementById('back').addEventListener('click', function(){
            window.location.href = 'editbook.php';
        });
    </script>
</body>
</html>