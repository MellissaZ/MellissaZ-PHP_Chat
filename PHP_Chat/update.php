<?php $page_title='update an idea';?>
<?php $page_heading='Update idea';?>
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
    <a href="text.php">go back to home page</a><?php/*Lien pur aller à la page principal*/?>
    <br><br>

    <?php if (isset($_GET['id'])): /*Vérifier si le get est réalisé*/?>
        <?php $id=$_GET['id']; /*récupérer le id*/?>
        <?php 
        $connection= new PDO($dsn,$db_name_user,$db_user_pasword);
        $sql ="select * from ideas where id=:id;";/*requete sql pour récupérer les données selon le id*/
        $statement =$connection->prepare($sql);
        $statement->bindValue(":id",$id);
        $statement->execute();  
        $idea=$statement->fetch(PDO::FETCH_ASSOC);/*récupérer et mettre les données dans un tableau associative*/
                      
        ?>
        
      
        <?php if(isset($_REQUEST['submit'])):/*vérifier le post et on peut vérifier avec isset($_POST['submit'])*/?> 
              
            <?php 
           
             $ide=array(
                          'title'=>$_REQUEST['title'],
                           'text'=>$_REQUEST['text'],
                           'id'=>$_REQUEST['id']
                          );/*on met les données récupéré dans un array*/
                                     
             $connection= new PDO($dsn,$db_name_user,$db_user_pasword);
             $sql ="update ideas SET title=:title,text=:text where id=:id;";/*requete pour modifier les données de form*/
             $statement=$connection->prepare($sql);/*préparer la requete sql*/
             $statement->execute($ide);/*éxécuter la requete*/
            ?>
            
        <?php endif; ?>
     
        <form  methode="Post"> <?php /*créer form pour modifier la mise à jour des données*/?>     
            <?php foreach($idea as $key => $value): /*parcourir les clés et valeurs du tableau associative contenants les données récupéré*/?>
              <?php if( $key =='text') :/*Le style et la forme du message de formulaire*/?>
                <textarea name=" <?php echo $key; ?>"  cols="30" rows="10"><?php echo $value; ?></textarea>
              <?php else:/*le titre et le id ont la meme forme et style*/?>
                   <label for="<?php echo $key; ?>"><?php echo $key ; ?></label>
                    <input type="text" name="<?php echo $key ; ?>"
                     value="<?php echo $value;?>"  id="<?php echo $key ; ?>"
                     <?php if($key=='id'){echo 'readonly';}/*On met le id en mode lécture seulement*/?>
                    >
                    <br><br>                   
               <?php endif; ?>
            
            <?php endforeach ; ?>
             <br><br>
            <input type="submit" name="submit" value="update">
            
        </form>
      

        <br><hr><hr><br>
       <div style="background:red;width:100%;height:100px; padding:10px;">
              <p> message <?php echo $id;?> updated </p>
        </div>
    <?php endif;?>
</body>
</html>