<?php
session_start();
require "../config/config.php";

if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}
    $current_user=$_SESSION['userid'];  

    $stmt1=$pdo->prepare("SELECT * FROM user_publicinfo WHERE pinfo_user_id=".$current_user);
    $stmt1->execute();
    $result=$stmt1->fetchAll();

    if($result){
        $social = explode("/", trim($result[0]['pinfo_social_media'])); //change into array format

    }


if ($_POST) {
    $name=$_POST['name'];
    $description=$_POST['description'];
    $links= implode ("/",$_POST["social"]); //change into string with /
    
    // if ($_FILES['image']['name']!=null) {
    //     $file='../images/'.($_FILES['image']['name']);
    //     $imageType=pathinfo($file,PATHINFO_EXTENSION);

    //     if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
    //         echo "<script>alert('Image must be jpg or png or jpeg format.')</script>";
    //     }else{            
    //         $image=$_FILES['image']['name'];
    //         move_uploaded_file($_FILES['image']['tmp_name'],$file);

    //         $stmt = $pdo->prepare("UPDATE recipes SET recipe_name='$recipe_name',content='$content',image='$image' WHERE id='$id'");
    //         $result = $stmt->execute();                
    //         if ($result) {
    //             echo "<script>alert('Successfully added')</script>";
    //         }
    //     }
    // }else{
            if($result){
                $stmt2 = $pdo->prepare("UPDATE user_publicinfo SET pinfo_name='$name',pinfo_description='$description',pinfo_social_media='$links' WHERE pinfo_user_id=$current_user");
                $stmtresult = $stmt2->execute();                
                echo "<script>alert('Successfully updated')</script>";
            }else{
                $stmt3 = $pdo->prepare("INSERT INTO user_publicinfo(pinfo_user_id,pinfo_name,pinfo_description,pinfo_social_media) VALUES('$current_user','$name','$description','$links')");
                $stmtresult = $stmt3->execute();                
                echo "<script>alert('Successfully updated')</script>";
            }
            
            
    }
// }


?>

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">           

            <div class="col-full s-content__main">                


                <h3>Edit public info</h3>

                <form name="cForm" method="post" action="myaccount.php" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-field">
                            <input type="hidden" name="id" value="<?php if($result){echo $result[0]['pinfo_id'];}
                                ?>">    
                            <input name="name" type="text" class="full-width form-control" placeholder="My Name" value="<?php if($result){echo $result[0]['pinfo_name'];}?>" required>
                        </div>

                        <div class="message form-field">
                            <textarea name="description" class="full-width form-control" placeholder="Description" row="5"><?php if($result){echo $result[0]['pinfo_description'];}?></textarea>
                        </div>

                        <div class="message form-field">
                            <h5>Facebook</h5><input name="social[]" type="text" class="full-width form-control" placeholder="Social Links" value="<?php if($result){echo $social[0];}?>"><br>
                            <h5>Twitter</h5><input name="social[]" type="text" class="full-width form-control" placeholder="Social Links" value="<?php if($result){echo $social[1];}?>"><br>
                            <h5>Instagram</h5><input name="social[]" type="text" class="full-width form-control" placeholder="Social Links" value="<?php if($result){echo $social[2];}?>"><br>
                            <h5>Email</h5><input name="social[]" type="text" class="full-width form-control" placeholder="Social Links" value="<?php if($result){echo $social[3];}?>"><br>
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width" value="submit">Update</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

    <?php include("UserLayouts/footer.html")?>

