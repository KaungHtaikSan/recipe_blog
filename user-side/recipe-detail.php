<?php
require "../config/config.php";
session_start();

if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}

$stmt=$pdo->prepare("SELECT * FROM recipes WHERE id=".$_GET['id']);
$stmt->execute();
$result=$stmt->fetchAll();


$authorId=$result[0]['author_id'];
$stmtau=$pdo->prepare("SELECT * FROM users WHERE user_id=$authorId");
$stmtau->execute();
$auResult=$stmtau->fetchAll();

?>
   <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-gallery">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php echo $result[0]['recipe_name'];?>
                </h1>
                <ul class="s-content__header-meta">
                    
                    <li class="cat">
                        By
                        <a href="publicinfo-page.php?id=<?php echo $auResult[0]['user_id']?>"><?php echo $auResult[0]['name'];?></a><br>
                        Category 
                        <a href="#"><?php echo $result[0]['category'];?></a>

                    </li>
                </ul>
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__slider slider">
                    <div class="slider__slides">
                        <div class="slider__slide">
                            <img src="../images/<?php echo $result[0]['image']?>"alt=""></br></br>
                        </div>
                    </div>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">
                <h2 style="text-align:center;">Description</h2>
                <div class="s-content__author">
                    <?php echo $result[0]['recipe_description'];?></br></br>
                </div>

            </div> <!-- end s-content__main -->

            <div class="col-full s-content__main">
                <h2 style="text-align:center;">Cooking Time</h2>
                <div class="s-content__author">
                    <?php echo $result[0]['cookingtime'];?> minutes</br></br>
                </div>

            </div> <!-- end s-content__main -->

            <div class="col-full s-content__main">
                <h2 style="text-align:center;">Ingredients</h2>
                <div class="s-content__author">
                    <?php 
                    $ingre= explode("/",$result[0]['ingredients']);
                    foreach($ingre as $ingredata){                        
                        echo "<ul>";
                        echo "<li>". $ingredata ."</li>";
                        echo "</ul>";                      
                    }
                    ?>
                        
                    
                </div>

            </div> <!-- end s-content__main -->

            <div class="col-full s-content__main">
                <h2 style="text-align:center;">Instructions</h2>
                <div class="s-content__author">
                    <?php                    
                    $inst= explode("/",$result[0]['instructions']);
                    echo "<ol>";
                    foreach($inst as $instdata){
                        echo "<li>". $instdata ."</li><br>";
                    }
                    echo "</ol>";
                    ?>
                </div>

            </div> <!-- end s-content__main -->

            <div class="col-full s-content__main">
                <?php if($result[0]['note']){ ?> <h2 style="text-align:center;">Author's note</h2> <?php } ?>
                    
                    <div class="s-content__author">
                        <?php echo $result[0]['note'];?></br></br>
                    </div>
                
                
                

            </div> <!-- end s-content__main -->

        </article>



    </section> <!-- s-content -->

    <?php include ("UserLayouts/footer.html"); ?>
