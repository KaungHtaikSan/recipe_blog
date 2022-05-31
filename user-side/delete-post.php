<?php

require "../config/config.php";
$stmt=$pdo->prepare("DELETE FROM posts WHERE id=".$_GET['id']);
$stmt->execute();

header('Location:add-post.php');
?>

<!-- Delete button confirmation box -->
<!-- <a href="delete.php?id=<?php echo $value['id']?>" onclick="return confirm('Are you sure you want to delete?')" type="button" class="btn btn-danger">
DELETE
</a> -->
