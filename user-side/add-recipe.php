<?php
session_start();
require "../config/config.php";

if(isset($_SESSION['username'])){
    include("UserLayouts/header-signedin.php");
}else{  
    include("UserLayouts/header.php");
}
// if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
//   header('Location: ../admin-panel/login.php');
// }

if ($_POST) {
    $file='../images/'.($_FILES['image']['name']);
    $imageType=pathinfo($file,PATHINFO_EXTENSION);
    $recipe_name=$_POST['recipe_name'];
    $recipe_description=$_POST['recipe_description'];
    $ingredients = implode ("/",$_POST["ingredients"]); //change into string with comma
    $cookingtime=$_POST['cookingtime'];
    $note=$_POST['note'];
    $instructraw = explode("\r\n", trim($_POST['instructions'])); //change into array format
    $instructions= implode("/",$instructraw);
    $category=$_POST['category'];   
    
    
    if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
        echo "<script>alert('Image must be jpg or png or jpeg format.')</script>";
    }else{
        
        $image=$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$file);

        $stmt = $pdo->prepare("INSERT INTO pending_posts(pp_recipe_name,pp_recipe_description,pp_category,pp_image,pp_cookingtime,pp_ingredients,pp_instructions,pp_note,pp_author_id) VALUES(:recipe_name,:recipe_description,:category,:image,:cookingtime,:ingredients,:instructions,:note,:author_id)");
        $result = $stmt->execute(
            array(':recipe_name'=>$recipe_name,
                    ':recipe_description'=>$recipe_description,
                    ':category'=>$category,
                    ':image'=>$image,
                    ':cookingtime'=>$cookingtime,
                    ':ingredients'=>$ingredients,
                    ':instructions'=>$instructions,
                    ':note'=>$note,
                    ':author_id'=>$_SESSION['userid'],)
        );
        if ($result) { 
            echo "<script>alert('Successfully added. Please wait for the admin's approval for public post.')</script>";
        }
    }
}
?>
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">           

            <div class="col-full s-content__main">                


                <h3>Create A New Recipe</h3>

                <form name="cForm" method="post" action="add-recipe.php" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-field">
                            <input name="recipe_name" type="text" class="full-width form-control" placeholder="Recipe Name" value="" required>
                        </div>

                        <div class="message form-field">
                            <textarea name="recipe_description" class="full-width form-control" placeholder="Description" row="5" required></textarea>
                        </div><br>

                        <div class="form-field">
                            Choose Recipe Category<br><br>

                            <select name="category" class="form-select full-width form-control" aria-label="Select your recipe category" required>
                            <option value="">Open this select menu</option>
                            <option value="Breakfast & Brunch">Breakfast & Brunch</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="Appetizer & Snack">Appetizer & Snack</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Main Dish">Main Dish</option>
                            <option value="Salads">Salads</option>
                            <option value="Side dish">Side dish</option>
                            <option value="Soups">Soups</option>
                            </select>
                        </div>

                        <div class="form-field">
                            Choose Recipe Image<br><br>
                            <input name="image" type="file" class="full-width form-control"  value="" placeholder="Content Photo" required>
                            
                        </div>

                        <div class="wrapper">
                            <div class="form-field">
                                <input name="ingredients[]" type="text" class="full-width form-control" value="" placeholder="Ingredients (e.g. 2 cups of flour,sifted)" required>
                                <button class="btn add-btn" >Add More Ingredients</button>
                            </div>
                        </div>

                        <div class="form-field">
                            <input name="cookingtime" type="text" class="full-width form-control" placeholder="Cooking Time(minutes)" value="" required>
                        </div>

                        <div class="message form-field">
                            <textarea name="instructions" class="full-width form-control " placeholder="Instruction steps to make your recipe&#x0a;*Add one step per line. Press ‘enter’ or ‘return’ to start a new step.&#x0a;Example:&#x0a;Combine all meat in a large bowl.Set aside.&#x0a;Combine all vegetables in a small bowl." row="10" required></textarea>
                        </div><br>

                        <div class="message form-field">
                            <textarea name="note" class="full-width form-control" placeholder="Author's Notes" row="3"></textarea>
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width" value="submit">Submit</button>

                    </fieldset>
                </form> <!-- end form -->
                


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->

    <?php include("UserLayouts/footer.html")?>

    <script type="text/javascript">
        $(document).ready(function () {
    
        // allowed maximum input fields
        var max_input = 20; 
    
        // initialize the counter for textbox
        var x = 1; 
    
        // handle click event on Add More button
        $('.add-btn').click(function (e) {
            e.preventDefault();
            if (x < max_input) { // validate the condition
            x++; // increment the counter
            $('.wrapper').append(`
                <div class="input-group mb-3">
                <input type="text" name="ingredients[]" class="full-width form-control" value="" placeholder="Add another ingredient" required>
                    <button class="btn remove-btn">Remove</button>
                    
                </div>             
                
            `); // add input field
            }
        });
    
        // handle click event of the remove btn
        $('.wrapper').on("click", ".remove-btn", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();  // remove input field
            x--; // decrement the counter
        })
    
        });
    </script>

