<?php require_once('config.php'); ?> 
<?php $x = "forms "?>
<?php $y = "mon chat"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $x ; ?></title>
    <style>
        /*table style*/
        td,th,table{   
            border:1px solid;         
           border-collapse:collapse;
           background:#eee;
        }
        table{
            width:100%;
            text-align:center;

        }
    </style>
</head>
<body>
    <h1><?php echo $y ; ?></h1>

<form action="" methode="Get"><?php/*Formulaire avce la méthode Git*/?>
    <label for="title">donner titre</label>
    <input type="text" name="title" value ="
    <?php if( isset($_GET['title'])) {echo $_GET['title']; }?>" ><?php/**/?>
    <br><br>

    <label for="text">donner votre avis</label>
    <textarea type="text" name="text" rows="8" cols="89">
        <?php if( isset($_GET['text'])) {echo $_GET['text']; }?>
    </textarea>

    <input type="submit" name="submit"  >
     
    <?php if( isset($_GET['submit'])): /*Si y'a le submit*/?> 

    <?php if( isset($_GET['title'])):?>
    <?php $title_idea= $_GET['title']; /*récupérer le titre saisi*/?>
    <?php endif; ?>

    <?php if( isset($_GET['text'])):?>
    <?php $text_idea= $_GET['text']; /*récupérer le texte saisi*/?>
    <?php endif; ?>

    <?php $new_idea= array('title' =>$title_idea,'text' =>$text_idea ); /*un array qui contient les données récupérés du formulaire*/?>
    <br>
    <?php $new_idea_1=  implode(',',array_keys($new_idea )); ?>
    <br>
    <?php $new_idea_2= ':'. implode(', :',array_keys($new_idea )); ?>


    <?php $connection= new PDO($dsn,$db_name_user,$db_user_pasword); /*La connection à la base de données*/?>
    <?php $sql=sprintf('insert into %s (%s) values (%s)','ideas',
     $new_idea_1, $new_idea_2); /*La requete sql insérer les données du formulaire dans le tableau de la base de données qu'on crée */
     ?>

    <?php $statement= $connection->prepare($sql); /*préparer la requete*/?>
    <?php $statement->execute($new_idea); /*éxécuter la requete*/?>
    <hr><hr>

    <div style="background:green; color:white; padding:10px;" ><?php/*L'affichage des données saisies*/?>
        <h4>vous avez réussi à entrer vous données</h4>
        <p> <?php echo $title_idea?></p>
        <p> <?php echo $text_idea?></p>
    </div>
    <HR></HR><HR></HR>
    <BR></BR>
    <table >

    <?php
     $connection= new PDO($dsn,$db_name_user,$db_user_pasword);/*La connection à la base de données*/
     $sql=sprintf('select * from ideas ;');/*La requete sql pour récupérer les données saisies*/
     $statement= $connection->prepare($sql);/*préparer la requete*/
     $statement ->execute();/*éxécuter la requete*/
     $result = $statement ->fetchAll();/*récupérer tout les données*/    
    ?>


        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>TEXT</th>
            <th>DELETE</th>
           
        </tr>
        <?php foreach($result as $row): /*l'affichage des données stocké dans la base de donnée*/?>
        <tr>
            <td> <a href="update.php?id=<?php echo $row['id'];?>">#<?php echo $row['id'];?></a></td><?php /*Accéder à la page de mise à jour des données de formulaire*/?>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['text'];?></td>
            <td><a href="delete.php?id=<?php echo $row['id'];?>" >X</a></td><?php /*Accéder à la page de suprission des données de formulaire*/?> 
        </tr>
        <?php endforeach; ?>
    </table>


    <?php endif; ?>

    


</form>
</body>
</html>