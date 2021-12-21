<?php $page_title='Delate an idea';?>
<?php $page_heading='idea deletion';?>
<?php require_once('config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $page_title?></title>
</head>
<body>
    <h1><?php echo $page_heading;?></h1>
    <a href="text.php">go back to home page</a>
    <br><br>

    <?php if (isset($_GET['id'])):?>
        <?php $id=$_GET['id'];?>
        <?php 
        $connection= new PDO($dsn,$db_name_user,$db_user_pasword);
        $sql ="delete from ideas where id=:id";
        $statement =$connection->prepare($sql);
        $statement->bindValue(":id",$id);
        $statement->execute();                 
        ?>
      

    <div style="background:red;width:100%;height:100px; padding:10px;">
     <p>le messege <?php echo $id;?>  est supprimé </p>
    </div>

    <?php endif;?>
</body>
</html>