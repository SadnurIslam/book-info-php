<?php require 'readfile.php';
    $action =[];
    for($i=0; $i<count($books); $i++){
        $action[$i] = "<form class='editbtn' action='updatebook.php' method='post'><button class='text-danger' value='$i' name='edit' type='submit'>Edit</button></form> <form class='editbtn' action='editbook.php' method='post'><button class='text-danger' type='submit' value='$i' name='delete'>Delete</button></form> ";
    }
    $keys1 = array('SL','title', 'author', 'available', 'pages', 'isbn', 'action');
    $title1 = $author1 = $available1 = $pages1 = $isbn1 = "";
    $index=null;
    if(isset($_POST['delete'])){
        $index = $_POST['delete'];
        array_splice($books, $index, 1);
        array_splice($action, $index, 1);
        $booksJson = json_encode($books, JSON_PRETTY_PRINT);
        file_put_contents('books.json', $booksJson);
        #echo "<script>window.location.href='editbook.php';</script>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'head.php';?>
    <title>Edit/Delete Book | Book Info</title>
    <style>
        td, th {
            text-align: center;
        }
        body {
            padding: 50px;
        }
        table{
            width: 70%;
            margin: auto;
        }
        .container{
            margin: 0 auto;
            text-align: center;
        }
        #btn, #edit{
            padding: 5px 10px;
            border-radius: 4px;
            margin: 2px 5px;
            width: 80px;
        }
        input{
            cursor: pointer;
            color: red;
            font-weight: bold;
        }
        .editbtn{
            display: inline;
            font-size: 12px;
        }
        .text-danger{
            width: 45px;
        }

    </style>
</head>
<body>
    <div class="container">
    <h2>List of Books:</h2>
    
    <table class="table table-success table-striped" border="1px">
        <thead>
            <tr>
                <?php foreach($keys1 as $key): ?>
                    <th><?php echo ucwords($key); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $sl = 0; ?>
            <?php foreach($books as $book): ?>
                <tr>
                    <td><?php echo ++$sl; ?></td>
                    <?php foreach($book as $key => $value): ?>
                        <?php if($key === 'available' && $value==true): ?>
                            <td><?php echo "Yes" ?></td>
                        <?php elseif($key === 'available' && $value==false): ?>
                            <td><?php echo "No" ?></td>
                        <?php else: ?>
                            <td><?php echo $value; ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td><?php echo $action[$sl-1]; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if($sl == 0): ?>
                <tr>
                    <td colspan="6" class="text-danger"><b>No data to display!</b></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <input type="submit" value="Go to Homepage" name="submit" id="btnhm" class="btn btn-primary">
    </div>
    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('btnhm').addEventListener('click', function(){
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>