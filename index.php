<?php
    require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'head.php'; ?>
<title>Homepage | Book Info</title>
<style>
    input{
        border: 1px solid gray;
    }
    input:focus{
        outline: none;
        box-shadow: none!important;
        border:1px solid #422918;
    }
</style>
</head>
<body>
    <div class="container container1">
    <h1>List of Books:</h1>
    <form action="index.php" method="get">
        <div class="input-group mb-3">
            <input id="src_box" required name="pattern" type="text" class="form-control" placeholder="Search title/author..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button name="src_btn" value="src" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <?php 
        if(isset($_GET['src_btn'])){
            $pattern=$_GET['pattern'];
            echo "Search results for: <span class='srctxt text-danger'>".$pattern." </span>";
            echo " <a href='index.php' class='cancel_src'> <i class='fa-solid fa-x'></i></a>";
            echo "<br><br>";
        }        
    ?>
    <table class="table table-success table-striped" border="1px">
        <thead>
            <tr>
                <?php foreach($heading as $key): ?>
                    <th><?php echo ucwords($key); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $sl = 0; ?>
            <?php foreach($books as $book): ?>
                <tr>
                    <td><?php echo ++$sl;?></td>
                    <td><?php echo $book['title'];?></td>
                    <td><?php echo $book['author'];?></td>
                    <td><?php if($book['available']>0) echo "Yes"; else echo "No";?></td>
                    <td><?php echo $book['pages'];?></td>
                    <td><?php echo $book['isbn'];?></td>
                    <td>
                        <form class="mb-0 d-inline" action="updatebook.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                            <button type="submit" name="edit" class="btn btn-primary edit_btn" value="submit"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i></button>
                        </form>
                        <form class="mb-0 d-inline" action="index.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                            <button type="submit" class="btn btn-danger delete_btn" name="delete" value="delete"><i class="fas fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if(count($books)==0): ?>
                <tr>
                    <td colspan="7" class="text-danger"><b>No data to display!</b></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Add Book
    </button>

    </div>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><h2>Add New Book</h2></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="index.php" method="post">
                <div class="mb-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>

                <div class="mb-2">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" id="author"  required>
                </div>

                <div class="mb-2">
                    <label for="available" class="form-label">Available</label>
                    <input type="number" name="available" class="form-control" id="available"  required>
                </div>

                <div class="mb-3">
                    <label for="pages" class="form-label">Pages</label>
                    <input type="number" name="pages" class="form-control" id="pages"  required>
                </div>

                <div class="mb-3">
                    <label for="isbn" class="form-label">isbn</label>
                    <input type="text" name="isbn" class="form-control" id="isbn"  required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="add" value="add">Add Book</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>


    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
    <!-- <script>
        document.getElementById('src_btn').addEventListener('click', function(){
            document.getElementById('src_box').value = "";
        });
    </script> -->
</body>
</html>