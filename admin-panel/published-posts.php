<?php
session_start();
require "../config/config.php";

    if (!empty($_GET['pageno'])) {
        $pageno=$_GET['pageno'];
    }
    else{
        $pageno=1;
    }
    $numOfrecs=20;
    $offset=($pageno - 1) * $numOfrecs;
    

    $stmt=$pdo->prepare("SELECT * FROM recipes INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id`");
    $stmt->execute();
    $rawResult=$stmt->fetchAll(); 
    $total_pages=ceil(count($rawResult)/$numOfrecs);

    $stmt=$pdo->prepare("SELECT * FROM recipes INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id` LIMIT $offset,$numOfrecs");
    $stmt->execute();
    $result=$stmt->fetchAll(); 
?>

<?php include ('layouts/header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Published Recipes</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No.</th>
                                                <th>Recipe ID</th>
                                                <th>Recipe Name</th>
                                                <th>Category</th>
                                                <th>Author Name</th>
                                                <th>Posted Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($result){
                                                $i = 1;
                                                foreach ($result as $data) { ?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $data['id']?></td>
                                                        <td><?php echo $data['recipe_name']?></td>
                                                        <td><?php echo $data['category'];?></td>
                                                        <td><?php echo $data['name'];?></td>
                                                        <td><?php echo date("d-m-Y",strtotime($data['posted_at']));?></td>                                                    
                                                    </tr>
                                                <?php
                                                $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table><br>
                                    <nav aria-label="Page navigation example" style="float:right">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                                            <li class="page-item" <?php if($pageno <= 1){echo 'disabled';}?>>
                                                <a class="page-link" href="<?php if($pageno <= 1){echo '#';}else{echo "?pageno=".($pageno-1);}?>">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                                            <li class="page-item" <?php if($pageno <= $total_pages){echo 'disabled';}?>>
                                                <a class="page-link" href="<?php if($pageno >= $total_pages){echo "#";}else{echo "?pageno=".($pageno+1);}?>">Next</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages?>">Last</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    <?php include ('layouts/footer.html'); ?>