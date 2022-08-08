<?php
session_start();
require "../config/config.php";
if($_POST){
  $email=$_POST['email'];
  $password=$_POST['password'];

  $stmt=$pdo->prepare("SELECT * FROM users WHERE email=:email");

  $stmt->bindValue(':email',$email);
  $stmt->execute();
  $user= $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && $user['role']==1) {
      if($user['password']==$password){
        $_SESSION['userid']=$user['user_id'];
        $_SESSION['username']=$user['name'];
        $_SESSION['logged_in']=time();

        header('Location:../admin-panel/index.php');
      }
      else{
        echo "<script>alert('Incorrect Credientials')</script>";

      }
  }
  elseif($user && $user['role']==0) {
      if($user['password']==$password){
        $_SESSION['userid']=$user['user_id'];
        $_SESSION['username']=$user['name'];
        $_SESSION['logged_in']=time();

        header('Location:index.php');
      }
      if($user['password']!=$password){
        echo "<script>alert('Incorrect Credientials')</script>";
      }
  }else{
    echo "<script>alert('Incorrect Credientials')</script>";
  }
}
?>

<?php include("UserLayouts/header.php")?>
  <section class="s-content s-content--narrow">
    <div class="row">        
        <div class="col-full s-content__main">              
            <h3>Log in to your account</h3>

            <form name="cForm" method="post" action="login.php" enctype="multipart/form-data">
                <fieldset>                   
                    <div class="form-field">
                      <input name="email" type="text" class="full-width form-control" placeholder="Enter email" value="" required>
                    </div>

                    <div class="form-field">
                        <input name="password" type="password" class="full-width form-control" placeholder="Enter password" value="" required>
                    </div>                   
                    <button type="submit" class="submit btn btn--primary full-width" value="submit">Login</button>
                </fieldset>
                <a href="signup.php">Don't have an account?</a>
            </form> <!-- end form -->              

        </div> <!-- end s-content__main -->
    </div> <!-- end row -->
  </section> <!-- s-content -->
<?php include("UserLayouts/footer.html")?>


