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

            <div class="col-full s-content__main">
                <h1 class="quarter-top-margin">Contact Us</h1>

                <p>
                To contact Allrecipes magazine, email feedback@armagazine.com 

                For help with your Allrecipes magazine subscription, visit our online help page, 
                email us at alrcustserv@cdsfulfillment.com, or call 800-837-9017.

                To report technical issues or provide feedback about our site, email support@meredith.com
                </p>
                
                <h1 class="quarter-top-margin">Write for us</h1>
                <p>Allrecipes is always on the lookout for talented new writers, recipe developers, 
                    equipment reviewers, and photographers who love cooking to join our team of contributors.
                        We're currently accepting pitches for recipes, technique-driven service articles, 
                        and features (especially personal essays and food histories). Please submit pitches 
                        or inquire about potential assignments by sharing a short bio and your relevant experience in our pitch form.
                </p>                          
                
                <p class="lead">Contents : &copy; Allreceipes Food Magazine</p>
                


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

    <?php include ("UserLayouts/footer.html"); ?>
