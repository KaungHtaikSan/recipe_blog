<?php
session_start();
require "../config/config.php";
?>

<?php include ('layouts/header.html'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pending Posts to publish</h1>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($_GET['pageno'])) {
                $pageno=$_GET['pageno'];
            }
            else{
                $pageno=1;
            }
            $numOfrecs=2;
            $offset=($pageno - 1) * $numOfrecs;

            if (empty($_POST['search'])) {
                $stmt=$pdo->prepare("SELECT * FROM posts ORDER BY id");
                $stmt->execute();
                $rawResult=$stmt->fetchAll(); 
                $total_pages=ceil(count($rawResult)/$numOfrecs);

                $stmt=$pdo->prepare("SELECT * FROM posts ORDER BY id LIMIT $offset,$numOfrecs");
                $stmt->execute();
                $result=$stmt->fetchAll(); 
            }else{
                $searchkey=$_POST['search'];            
                $stmt=$pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchkey%' ORDER BY id");
                $stmt->execute();
                $rawResult=$stmt->fetchAll(); 
                $total_pages=ceil(count($rawResult)/$numOfrecs);

                $stmt=$pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchkey%' ORDER BY id LIMIT $offset,$numOfrecs");
                $stmt->execute();
                $result=$stmt->fetchAll(); 
            }
            

            ?>
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
                                                <th>Post Title</th>
                                                <th>Post Description</th>
                                                <th>Author Name</th>
                                                <th style="width: 40px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($result){
                                                $i = 1;
                                                foreach ($result as $value) { ?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $value['title']?></td>
                                                        <td><?php echo substr($value['content'],0,50)?></td>
                                                        <td>May Phoo Thwin</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <div class="container">
                                                                    <a href="#" class="btn btn-success">Approve</a>
                                                                </div>
                                                                <div class="container">
                                                                    <a href="review-posts.php?id=<?php echo $value['id']?>"class="btn btn-warning">View</a>
                                                                </div>
                                                                <div class="container">
                                                                    <a href="reject-posts.php?id=<?php echo $value['id']?>" class="btn btn-danger">Reject</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table></br>
                                    <nav aria-label="Page navigation example" style="float:right">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                                            <li class="page-item" <?php if($pageno <= 1){echo 'disabled';}?>>
                                                <a class="page-link" href="<?php if($pageno <= 1){echo '#';}else{echo "?pageno=".($pageno-1);}?>">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                                            <li class="page-item" <?php if($pageno <= $total_pages){echo 'disabled';}?>>
                                                <a class="page-link" href="<?php if($pageno >= $total_pages){echo '#';}else{echo "?pageno=".($pageno+1);}?>">Next</a>
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