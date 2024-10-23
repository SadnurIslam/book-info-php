<?php 
    require 'db.php';
?>

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
        <input type="hidden" name="id" value="<?php if(isset($_POST['id'])) echo $_POST['id']; ?>">
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
                        <input type="number" name="available" id="available" value="<?php echo $available1;?>" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="pages">Pages: </label></td>
                    <td><input class="form-control" type="number" id="pages" name="pages" required value="<?php echo $pages1;?>"></td>
                </tr>         
                <tr>
                    <td><label for="isbn">isbn: </label></td>
                    <td><input class="form-control" type="text" id="isbn" name="isbn" required value="<?php echo $isbn1;?>"></td>
                </tr>    
                <tr>
                    <td></td>
                    <td style="text-align:center"><a href="index.php" class="btn btn-secondary">Cancel</a> <input class="btn btn-success" type="submit" value="Update" name="update" id="btn">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    </div>
    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
</body>
</html>