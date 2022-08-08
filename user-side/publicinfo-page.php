<?php
session_start();
require "../config/config.php";

if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}
    $current_user=$_GET['id'];  

    $myaccstmt=$pdo->prepare("SELECT * FROM `recipes` INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id` WHERE `author_id`=$current_user");
    $myaccstmt->execute();
    $myacc=$myaccstmt->fetchAll(); 

    
    $pinfostmt=$pdo->prepare("SELECT * FROM `user_publicinfo` WHERE `pinfo_user_id` = $current_user");
    $pinfostmt->execute();
    $pinfo=$pinfostmt->fetchAll();

    $social = explode("/", trim($pinfo[0]['pinfo_social_media'])); //change into array format

    
?>
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">             
            <div class="s-content__author">

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href=""><?php if($pinfo){echo $pinfo[0]['pinfo_name'];}
                            else{echo "Sorry, This user currently don't have a public profile to display.";}?></a>
                        </h4>
                    
                        <p><?php if($pinfo){echo $pinfo[0]['pinfo_description'];}?>
                        </p>
                            <?php if(isset($social[0]) && $social[0]!=null){ ?> <a href="https://<?php echo $social[0]?>"><i class="fa fa-facebook fa-2xl" aria-hidden="true"></i> <?php } ?>

                            <?php if(isset($social[1]) && $social[1]!=null){ ?> <a href="https://<?php echo $social[1]?>"><i class="fa fa-twitter" aria-hidden="true"></i> <?php } ?>

                            <?php if(isset($social[2]) && $social[2]!=null){ ?> <a href="https://<?php echo $social[2]?>"><i class="fa fa-instagram" aria-hidden="true"></i> <?php } ?>

                            <?php if(isset($social[3]) && $social[3]!=null){ ?> <a href="mailto:<?php echo $social[3]?>?&subject=Greeting from K Recipes Blog"><i class="fa fa-envelope icon-4x" aria-hidden="true"></i> <?php } ?>
                                
                    </div>
            </div>
            
            

            <div class="col-full md-six tab-full popular">             
                <h3>Recently posted recipes</h3>
                    <div>
                            <?php foreach($myacc as $value){?>
                            
                                <article class="col-block popular__post">
                                    <!-- <a href="recipe-detail.php?id=<?php echo $value['id'];?>" class="popular__thumb">
                                        <img src="../images/<?php echo $value['image']?>" width="200px" height="200px">
                                    </a> -->
                                    
                                        <h5><a href="recipe-detail.php?id=<?php echo $value['id'];?>"><?php echo $value['recipe_name'] ?></a></h5>
                                        <section class="popular__meta">
                                            <span class="popular__author"><span>By</span> <a href="#0"><?php echo $value['name'] ?></a></span><br>
                                            <span class="popular__date"><span>on</span> <time><?php echo date("d-m-Y",strtotime($value['posted_at'])) ?></time></span>
                                        </section>
                                   
                                </article>
                            
                            <?php 
                            }
                            ?>                        
                    </div> <!-- end popular_posts -->

            </div> <!-- end popular -->

        </div> <!-- end row -->

    </section> 

<?php include("UserLayouts/footer.html")?>

   