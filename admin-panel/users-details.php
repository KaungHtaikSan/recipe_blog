<?php
session_start();
require "../config/config.php";

$stmt=$pdo->prepare("SELECT * FROM users ORDER BY user_id");
$stmt->execute();
$result=$stmt->fetchAll();


// $stmt2=$pdo->prepare("SELECT *,count(author_id) AS total_posts FROM `recipes` WHERE author_id=$result[author_id];")

?>

<?php include ('layouts/header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">User Details</h1>
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
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Registered Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($result){
                                                $i = 1;
                                                foreach ($result as $data) { ?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $data['user_id']?></td>
                                                        <td><?php echo $data['name']?></td>
                                                        <td><?php echo $data['email'];?></td>
                                                        <td><?php echo $data['created_at'];?></td>                                                    
                                                    </tr>
                                                <?php
                                                $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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