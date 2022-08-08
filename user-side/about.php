<?php
require "../config/config.php";
session_start();

if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}
?>

   <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    Who we are
                </h1>
            </div> <!-- end s-content__header -->

            <div class="col-full s-content__main">

                <p>
                    Home cooks are our heroes; it's as simple as that. 
                    Allrecipes is a community built by and for kitchen experts: 
                    The cooks who will dedicate two days to a perfect beef bourguignon
                    but love the simplicity of a slow-cooker rendition, too. The bakers
                    who labor over a showstopping 9-layer cake but will just as happily 
                    doctor boxed brownies for a rich weeknight dessert. The entertainers 
                    who just want a solid snack spread, without spending the whole evening 
                    shuffling dishes in and out of the oven. Most importantly, Allrecipes 
                    connects home cooks with their greatest sources of inspiration — other 
                    home cooks. We're the world's leading digital food brand, and that 
                    inspires us to do everything possible to keep our community vibrant. 
                    Sixty-million home cooks deserve no less. 
                </p>

                <div class="row block-1-2 block-tab-full">
                    <div class="col-block">
                        <h3 class="quarter-top-margin">Our History</h3>
                        <p>Founded in 1997 as CookieRecipe.com, Allrecipes changed the food 
                            world by providing the tools to share recipes and cooking tips, 
                            while celebrating the expertise of home cooks online. Since then, 
                            Allrecipes has become the world's largest community-driven food brand, 
                            providing trusted resources to more than 60 million home cooks each month. 
                            Every day, cooks from around the world publish recipes and inspire one 
                            another through recipe photos, ratings, reviews, and videos. The 
                            combination of the Allrecipes community with our team of editorial 
                            and kitchen professionals provides authority found nowhere else on 
                            the internet and has turned the brand into an indispensable resource 
                            for cooks of all skill levels.
                        </p>
                    </div>

                    <div class="col-block">
                        <h3 class="quarter-top-margin">Our Mission.</h3>
                        <p>Lorem ipsum Nisi amet fugiat eiusmod et aliqua ad qui ut nisi Ut aute anim mollit fugiat qui
                            sit ex occaecat et eu mollit nisi pariatur fugiat deserunt dolor veniam reprehenderit
                            aliquip magna nisi consequat aliqua veniam in aute ullamco Duis laborum ad non pariatur sit.
                        </p>
                    </div>                    
                </div>
                
                <h3 class="quarter-top-margin">Editorial Guidelines</h3>
                <p>At Allrecipes, we take great pride in the quality of our content. Our writers, photographers, 
                    and editors create original, accurate, and engaging content that reflects the interests and 
                    concerns of home cooks, and our recipe editors verify all user submissions before publication. 
                    Original illustrations, graphics, images, and videos are created by internal teams who collaborate 
                    with experts in their fields to produce assets that represent diverse voices, perspectives, and 
                    context. Photos and videos are not edited in any way that may cause them to be false or misleading.
                    We correct any factual errors in a transparent manner and strive to make it easy for our readers 
                    to bring errors to our attention.
                </p>

                <p class="lead">Contents : &copy; Allrecipes Food Magazine</p>
                


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

    <?php include ("UserLayouts/footer.html"); ?>
