<?php require 'readfile.php'; 
    $books1 = $books;
    for($i=0; $i<count($books1); $i++){
        $books1[$i]['action'] = "<form class='editbtn' action='editbook.php' method='post'><input type='submit' value='Update' name='$i'></form>  <form class='editbtn' action='editbook.php' method='post'><input type='submit' value='Delete' name='$i'></form>";
    }
    $keys1 = array('SL','title', 'author', 'available', 'pages', 'isbn', 'action');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'head.php';?>
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
            <?php foreach($books1 as $book): ?>
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
                </tr>
            <?php endforeach; ?>
            <?php if($sl == 0): ?>
                <tr>
                    <td colspan="6" class="text-danger"><b>No data to display!</b></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php 
        $index=null;
        for($i=0;$i<count($books1);$i++){
            $x = strval($i);
            if(isset($_POST[$x])){
                $index = $i;
                if($_POST[$x] === 'Delete'){
                    array_splice($books, $index, 1);
                    array_splice($books1, $index, 1);
                    $booksJson = json_encode($books, JSON_PRETTY_PRINT);
                    file_put_contents('books.json', $booksJson);
                    echo "<script>window.location.href = 'editbook.php';</script>";
                }
                else if($_POST[$x] === 'Update'){
                    $_SESSION['index'] = $index;
                    echo "<script>window.location.href = 'updatebook.php';</script>";
                }
                break;
            }
        }
    ?>
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