<?php require 'readfile.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'head.php'; ?>
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
    <form action="search.php" method="get">
        <div class="input-group mb-3">
            <input id="src_box" required name="pattern" type="text" class="form-control" placeholder="Search title/author..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button name="src_btn" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <table class="table table-success table-striped" border="1px">
        <thead>
            <tr>
                <th>SL</th>
                <?php foreach($keys as $key): ?>
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
                </tr>
            <?php endforeach; ?>
            <?php if($sl == 0): ?>
                <tr>
                    <td colspan="6" class="text-danger"><b>No data to display!</b></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <input type="submit" value="Add New" name="submit" id="btn" class="btn btn-primary">
    <input type="submit" value="Edit" id="edit" class="btn btn-danger">
    </div>
    <script src="assets/bootstrap5/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('btn').addEventListener('click', function(){
            window.location.href = 'addbook.php';
        });
        document.getElementById('edit').addEventListener('click', function(){
            window.location.href = 'editbook.php';
        });
        document.getElementById('src_btn').addEventListener('click', function(){
            document.getElementById('src_box').value = "";
        });
    </script>
</body>
</html>