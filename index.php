<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<head>
    <title>ToDo List</title>
</head>

<body>
    <?php $db = new PDO('mysql:host=localhost;dbname=todo', 'root', ''); ?>

    <div class="heading">
        <h2 style="font-style: 'Hervetica';">ToDo List </h2>
    </div>
    <form method="post" action="index.php" class="input_form">
        <input type="text" name="task" class="task_input">
        <button type="submit" name="submit" id="add_btn" class="add_btn">    Ajouter</button>

    </form>
    <table>

      <thead>
          <tr>
          <th>No</th>
          <th>Tache</th>
          <th style="width: 60px; ">Suppr</th>
          </tr>
      </thead>
        <tbody>
            <?php
            $sql= "SELECT * FROM todo";
            $query = $db->prepare($sql);
            $query->execute();

             $tasks = $query->fetchAll();

             $i = 1; foreach($tasks as $task) {
             ?>
             <tr>
                 <td> <?php echo $i; ?></td>
                 <td class="task"> <?php echo $task['task']; ?> </td>
                 <td class="delete">
                     <a href="index.php?del_task=<?php echo $task['ID'] ?>">x</a>
                     </td>
             </tr>
             <?php } ?>
        </tbody>

    </table>
    <?php 

      $errors = "";



      if(isset($_POST['submit'])){
      if (empty($_POST['task'])){
      $errors= "tapez avant de valider";
  }
  else{
  $task = $_POST['task'];
  $sql = "INSERT INTO todo (task) VALUES ('$task')";
  $db->query($sql);
  header('location: index.php');
}}

  if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];

    $db->query("DELETE FROM todo WHERE id=".$id);
    header('location: index.php');
}


    ?>

</body>
</html>