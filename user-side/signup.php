<?php
session_start();
require "../config/config.php";

if($_POST){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $stmt=$pdo->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindValue(':email',$email);
    $stmt->execute();
    $user= $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<script>alert('Email duplicated')</script>";
    }else{
        $stmt = $pdo->prepare("INSERT INTO users(name,email,password) VALUES(:name,:email,:password)");
        $result = $stmt->execute(
            array(':name'=>$name,':email'=>$email,':password'=>$password)
        );
        if ($result) {
            echo "<script>alert('Successfully registered, Please login' );window.location.href='login.php';</script>";
        }

        
    }
}
?>

<?php include("UserLayouts/header.php")?>
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">
        <div class="row">        
            <div class="col-full s-content__main">              
                <h3>Sign Up with email</h3>

                <form name="cForm" method="post" action="signup.php" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-field">
                          <input name="name" type="text" class="full-width form-control" placeholder="Enter username" value="" required>
                        </div>

                        <div class="form-field">
                          <input name="email" type="email" pattern=".+@gmail\.com" class="full-width form-control" placeholder="Enter email (Example. user@gmail.com)" row=2 value="" required>
                        </div>

                        <div class="form-field">
                            <input name="password" type="password" class="full-width form-control" placeholder="Enter password" value="" required>
                        </div>

                        

                        <button type="submit" class="submit btn btn--primary full-width" value="submit">Create Account</button>

                    </fieldset>
                </form> <!-- end form -->
                


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

<?php include("UserLayouts/footer.html")?>


