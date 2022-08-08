<?php
session_start();
require "../config/config.php";


// if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
//   header('Location: ../admin-panel/login.php');
// }
if ($_POST) {
    $id=$_POST['id'];
    $recipe_name=$_POST['recipe_name'];
    $content=$_POST['content'];
    
    if ($_FILES['image']['name']!=null) {
        $file='../images/'.($_FILES['image']['name']);
        $imageType=pathinfo($file,PATHINFO_EXTENSION);

        if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
            echo "<script>alert('Image must be jpg or png or jpeg format.')</script>";
        }else{            
            $image=$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],$file);

            $stmt = $pdo->prepare("UPDATE recipes SET recipe_name='$recipe_name',content='$content',image='$image' WHERE id='$id'");
            $result = $stmt->execute();                
            if ($result) {
                echo "<script>alert('Successfully added')</script>";
            }
        }
    }else{
        $stmt = $pdo->prepare("UPDATE recipes SET recipe_name='$recipe_name',content='$content' WHERE id='$id'");
            $result = $stmt->execute();                
            if ($result) {
                echo "<script>alert('Successfully updated')</script>";
            }
    }
}

$stmt=$pdo->prepare("SELECT * FROM recipes WHERE id=".$_GET['id']);
$stmt->execute();
$result=$stmt->fetchAll();
?>

<?php include("UserLayouts/header.html")?>
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">           

            <div class="col-full s-content__main">                


                <h3>Edit Recipe</h3>

                <form name="cForm" method="post" action="edit-recipe.php" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-field">
                            <input type="hidden" name="id" value="<?php echo $result[0]['id']?>">    
                            <input name="recipe_name" type="text" class="full-width form-control" placeholder="Recipe Name" value="<?php echo $result[0]['recipe_name'];?>" required>
                        </div>

                        <div class="message form-field">
                            <textarea name="content" class="full-width form-control" placeholder="Content" row="5"><?php echo $result[0]['recipe_description'];?></textarea>
                        </div>

                        <div class="form-field">
                            <img src="../images/<?php echo $result[0]['image']?>" width="250" height="150" alt=""></br></br>
                            <input type="file" name="image" class="full-width form-control"  value="" placeholder="Content Photo" required>
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width" value="submit">Submit</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

    <?php include("UserLayouts/footer.html")?>

