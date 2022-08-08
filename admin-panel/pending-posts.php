<?php
session_start();
require "../config/config.php";

$stmt=$pdo->prepare("SELECT * FROM pending_posts ORDER BY pp_id");
$stmt->execute();
$result=$stmt->fetchAll(); 

if ($result) {
    $authorId=$result[0]['pp_author_id'];

    $stmtau=$pdo->prepare("SELECT * FROM users WHERE user_id=$authorId");
    $stmtau->execute();
    $auResult=$stmtau->fetchAll();
}

    if (empty($_POST['search'])) {
        $stmt=$pdo->prepare("SELECT * FROM pending_posts ORDER BY pp_id");
        $stmt->execute();
        $rawResult=$stmt->fetchAll(); 

    }else{
    $searchkey=$_POST['search'];
    $stmt=$pdo->prepare("SELECT * FROM pending_posts WHERE pp_recipe_name LIKE '%$searchkey%' ORDER BY pp_id");
    $stmt->execute();
    $rawResult=$stmt->fetchAll();
    }     

?>

<?php include ('layouts/header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pending Recipes to publish</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <?php
                                    if (isset($_GET['view'])) //show single post when view button clicked
                                    {
                                        $stmt=$pdo->prepare("SELECT * FROM pending_posts WHERE pp_id=".$_GET['id']);
                                        $stmt->execute();
                                        $viewResult=$stmt->fetchAll();
                                    ?>
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Recipe ID</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_id'];?>"><br>
                                                    <label>Recipe Name</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_recipe_name']?>"><br>
                                                    <label>Recipe Description</label>
                                                    <textarea name="content" class="full-width form-control" readonly="readonly" value="" row="5"><?php echo $viewResult[0]['pp_recipe_description'];?></textarea><br>
                                                    <label>Category</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly"  value="<?php echo $viewResult[0]['pp_category']?>"><br>
                                                    <label>Image</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_image']?>"><br>
                                                    <label>Cooking Time</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_cookingtime']?>"><br>
                                                    <label>Ingredients</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_ingredients']?>"><br>
                                                    <label>Instructions</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_instructions']?>"><br>
                                                    <label>Author's note</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_note']?>"><br>
                                                    <label>Author ID</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_author_id']?>"><br>
                                                    <label>Posted At</label>
                                                    <input name="recipe_name" type="text" class="full-width form-control" readonly="readonly" value="<?php echo $viewResult[0]['pp_posted_at']?>"><br>
                                                
                                                    <div class="button-group">
                                                            <!-- <input type="submit" class="btn btn-success" name="accept" value="Accept"/>  -->
                                                            <a href="?accept&id=<?php echo $viewResult[0]['pp_id'];?>" type="submit" class="btn btn-success" value="accept">Accept</a>
                                                        
                                                            <a href="?reject&id=<?php echo $viewResult[0]['pp_id'];?>" type="submit" class="btn btn-danger" value="reject">Reject</a>
                                                           
                                                    </div>
                                                    
                                                </div>
                                                <!-- /.form-group -->                                                         
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    <?php
                                    }
                                    elseif (isset($_GET['accept'])) //accept and insert view done post into RECIPES table
                                    {
                                        $stmt=$pdo->prepare("SELECT * FROM pending_posts WHERE pp_id=".$_GET['id']);
                                        $stmt->execute();
                                        $acceptResult=$stmt->fetchAll();
                                        
                                        // $insertData=array(
                                        //     'recipe_name'=>$acceptResult[0]['pp_recipe_name'],
                                        //     'recipe_description'=>$acceptResult[0]['pp_recipe_description'],
                                        //     'category'=>$acceptResult[0]['pp_category'],
                                        //     'image'=>$acceptResult[0]['pp_image'],
                                        //     'cookingtime'=>$acceptResult[0]['pp_cookingtime'],
                                        //     'ingredients'=>$acceptResult[0]['pp_ingredients'],
                                        //     'instructions'=>$acceptResult[0]['pp_instructions'],
                                        //     'note'=>$acceptResult[0]['pp_note'],
                                        //     'author_id'=>$acceptResult[0]['pp_author_id'],
                                        //     'posted_at'=>$acceptResult[0]['pp_posted_at'],
                                        // );
                                        

                                        // $stmt2 = $pdo->prepare("INSERT INTO recipes(" . implode(',',array_keys($insertData)) . ") VALUES(" . implode(',',$insertData) . ")");
                                        // $acceptResult2 = $stmt2->execute();

                                        $stmt = $pdo->prepare("INSERT INTO recipes(recipe_name,recipe_description,category,image,cookingtime,ingredients,instructions,note,author_id,posted_at) VALUES(:recipe_name,:recipe_description,:category,:image,:cookingtime,:ingredients,:instructions,:note,:author_id,:posted_at)");
                                        $acceptResult2 = $stmt->execute(
                                            array(':recipe_name'=>$acceptResult[0]['pp_recipe_name'],
                                                    ':recipe_description'=>$acceptResult[0]['pp_recipe_description'],
                                                    ':category'=>$acceptResult[0]['pp_category'],
                                                    ':image'=>$acceptResult[0]['pp_image'],
                                                    ':cookingtime'=>$acceptResult[0]['pp_cookingtime'],
                                                    ':ingredients'=>$acceptResult[0]['pp_ingredients'],
                                                    ':instructions'=>$acceptResult[0]['pp_instructions'],
                                                    ':note'=>$acceptResult[0]['pp_note'],
                                                    ':author_id'=>$acceptResult[0]['pp_author_id'],
                                                    ':posted_at'=>$acceptResult[0]['pp_posted_at'],
                                                    )
                                        );

                                        if ($acceptResult2) { 
                                            $stmt=$pdo->prepare("DELETE FROM pending_posts WHERE pp_id=".$_GET['id']);
                                            $deleresult=$stmt->execute();  
                                            echo "<script>alert('Successfully inserted into Recipes')</script>"; 
                                                                                   
                                        }                                        
                                        echo "<script>document.location.href='pending-posts.php';</script>";
                                    }                                   
                                                                        
                                    elseif (isset($_GET['reject'])) //reject and delete view done from PENDING table
                                    {
                                        $stmt=$pdo->prepare("DELETE FROM pending_posts WHERE pp_id=".$_GET['id']);
                                        $deleresult=$stmt->execute();
                                        if ($deleresult) { 
                                            echo "<script>alert('Successfully deleted')</script>";                                           
                                        }                                        
                                        echo "<script>document.location.href='pending-posts.php';</script>";
                                        
                                    }                                 
                                                                           
                                    else{ //show all pending posts
                                    ?>                                       
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No.</th>
                                                    <th>Recipe Name</th>
                                                    <th>Recipe Description</th>
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
                                                            <td><?php echo $value['pp_recipe_name']?></td>
                                                            <td><?php echo substr($value['pp_recipe_description'],0,50)?></td>
                                                            <td><?php echo $auResult[0]['name'];?></td>
                                                            <td>
                                                                <form action="pending-posts.php" method="post">
                                                                    <div class="btn-group">
                                                                        
                                                                        <div class="container">
                                                                            <a href="?view&id=<?php echo $value['pp_id'];?>" type="submit" class="btn btn-warning" value="view">View</a>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </form>                                                            
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table></br>
                                    <?php
                                    }
                                    ?>
                                    
                                    
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