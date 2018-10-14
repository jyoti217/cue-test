<?php
    session_start();
    if(empty($_SESSION["username"])){
        header("Location: /admin-login.php");
        exit();
    }
    include "header.php";
    require_once "Database.php";
    $db = new Database();
    $users = $db->getAllUsers();
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">State</th>
      <th scope="col">Application</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user){?>
      <tr>
          <th scope="row"><?php if(!empty($user['id'])) echo $user['id'];?></th>
          <td><?php if(!empty($user['first_name'])) echo $user['first_name'];?></td>
          <td><?php if(!empty($user['last_name'])) echo $user['last_name'];?></td>
          <td><?php if(!empty($user['state'])) echo $user['state'];?></td>
          <td><a target="_blank" href="/user-apply-view.php?user_id=<?php if(!empty($user['id'])) echo $user['id'];?>">Check Application</a></td>
      </tr>
  <?php }?>

  </tbody>
</table>
<?php
    include "footer.php";
?>