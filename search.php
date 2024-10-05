<?php require 'readfile.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'head.php'; ?>
</head>
<body>
    <div class="container container1">
    <h1>List of Books:</h1>
    <?php $pattern="";
        if(isset($_GET['src_btn'])){
            $pattern=$_GET['pattern'];
        }
        echo "Search results for: <span class='srctxt'>".$pattern."</span>";
    ?>
    <br><br>
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
                    <?php
                    if($pattern != "" && stripos($book['title'], $pattern) === false && stripos($book['author'], $pattern) === false){
                        continue;
                    }?>
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
        </tbody>
    </table>
    <br>
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