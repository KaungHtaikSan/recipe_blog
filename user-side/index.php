<?php
session_start();
require "../config/config.php";


if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}

?>


<!-- s-content
    ================================================== -->
<section class="s-content">

<?php
    $stmt=$pdo->prepare("SELECT * FROM recipes INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id`");
    $stmt->execute();
    $result=$stmt->fetchAll(); 

    if(isset($_GET['category'])) {        
        $category=$_GET['category'];
        $stmtcate=$pdo->prepare("SELECT * FROM recipes INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id` WHERE category LIKE '$category%' ");
        $stmtcate->execute();
        $cateResult=$stmtcate->fetchAll(); 
    }

    if (isset($_POST['search'])){
        $searchkey=$_POST['search'];          
        $stmt=$pdo->prepare("SELECT * FROM recipes INNER JOIN `users` ON `users`.`user_id` = `recipes`.`author_id` WHERE recipe_name LIKE '%$searchkey%'");
        $stmt->execute();
        $searchResult=$stmt->fetchAll(); 
    }
  
?>

    <div class="row masonry-wrap">
        <div class="masonry">
        <!-- <h3><?php echo $cateResult[0]['category']?></h3></br> -->
 
        
        <?php                    
            if(isset($_GET['category'])){
                $i = 1;
                foreach ($cateResult as $value) { ?>

                        <article class="masonry__brick entry format-standard" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="recipe-detail.php?id=<?php echo $value['id'];?>" class="entry__thumb-link">
                                    <img src="../images/<?php echo $value['image']?>">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">                                    
                                    <h1 class="entry__title"><a href="recipe-detail.php?id=<?php echo $value['id'];?>"><?php echo $value['recipe_name']?></a>
                                    </h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        <?php echo substr($value['recipe_description'],0,70)." ..."?>
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                    
                                    By
                                    <a href="publicinfo-page.php?id=<?php echo $value['author_id']?>">
                                        <?php echo $value['name'];?>
                                    </a>                                                          
                                    </span>
                                </div>                                
                            </div>

                        </article> <!-- end article -->

                <?php
                $i++; 
                }

            }elseif((isset($_POST['search']))){
                $i = 1; ?>
                <div>
                    <h3>Search results for <?php echo $_POST['search']?></h3>
                </div>
                <?php foreach ($searchResult as $value) { ?>
                    
                        <article class="masonry__brick entry format-standard" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="recipe-detail.php?id=<?php echo $value['id'];?>" class="entry__thumb-link">
                                    <img src="../images/<?php echo $value['image']?>">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">                                    
                                    <h1 class="entry__title"><a href="recipe-detail.php?id=<?php echo $value['id'];?>"><?php echo $value['recipe_name']?></a>
                                    </h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        <?php echo substr($value['recipe_description'],0,70)." ..."?>
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                    
                                    By
                                    <a href="publicinfo-page.php?id=<?php echo $value['author_id']?>">
                                        <?php echo $value['name'];?>
                                    </a>                                                          
                                    </span>
                                </div>                                
                            </div>

                        </article> <!-- end article -->

                <?php
                $i++;
                }
            }else{
                $i = 1;
                foreach ($result as $value) { ?>
                    
                        <article class="masonry__brick entry format-standard" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="recipe-detail.php?id=<?php echo $value['id'];?>" class="entry__thumb-link">
                                    <img src="../images/<?php echo $value['image']?>">
                                </a>
                            </div>

                            <div class="entry__text">
                                <div class="entry__header">                                    
                                    <h1 class="entry__title"><a href="recipe-detail.php?id=<?php echo $value['id'];?>"><?php echo $value['recipe_name']?></a>
                                    </h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        <?php echo substr($value['recipe_description'],0,70)." ..."?>
                                    </p>
                                </div>
                                <div class="entry__meta">
                                    <span class="entry__meta-links">
                                    
                                    By
                                    <a href="publicinfo-page.php?id=<?php echo $value['author_id']?>">
                                        <?php echo $value['name'];?>
                                    </a>
                                                          
                                    </span>
                                </div>                                
                            </div>

                        </article> <!-- end article -->

                <?php
                $i++;
                }
            }
        ?>
            
            </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->
</section> <!-- s-content -->



<?php include ("UserLayouts/footer.html");?>
