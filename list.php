<?php
  require_once "db.php";
  try {
    $sql = $conn->prepare("SELECT * FROM users");
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    $error = "<div class='message error'><span>!</span><p>{$e->getMessage()}</p></div>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users Table</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border-radius: 10px;
    }

    thead {
      background: linear-gradient(90deg, #4a90e2, #005bea);
      color: #fff;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: left;
    }
    tbody tr {
      border-bottom: 1px solid #ddd;
      transition: 0.2s;
    }

    tbody tr:hover {
      background: #f1f7ff;
    }

    .skills {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .skill {
      background: #eaf3ff;
      color: #005bea;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: bold;
      display: inline-block;
    }
    .action {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }
    .action a {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      font-size: 18px;
      background: #eaf3ff;
      color: #005bea;
      padding: 10px;
      border-radius: 10px;
      text-decoration: none;
      transition: 0.3s;
    }
    .action a.delete {
      color: red;
    }
    .action a:hover {
      opacity: 0.7;
    }
    .message {
      margin: 15px 0;
      padding: 12px 18px;
      border-radius: 6px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      width: fit-content;
    }
    .message span {
      font-size: 20px;
    }
    .message .message p {
      margin: 0;
    }
    .message .success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .message .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Users List</h1>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>Country</th>
          <th>Gender</th>
          <th>Skills</th>
          <td>actions</td>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($error)) : ?>
          <tr>
            <td colspan="6"><?php echo $error ?></td>
          </tr>
        <?php else : ?>  
          <?php foreach($users as $user): ?>
            <tr>
              <td><?php echo $user["id"] ?></td>
              <td><?php echo $user["first_name"] ?></td>
              <td><?php echo $user["last_name"] ?></td>
              <td><?php echo $user["address"] ?></td>
              <td><?php echo $user["country"]  ?></td>
              <td><?php echo  $user["gender"] ?></td>
              <td>
                <div class="skills">
                  <?php foreach(explode("|", $user["skills"])  as $skill): ?>
                    <span class="skill"><?php echo $skill ?></span>
                  <?php endforeach; ?>
                </div>
              </td>
              <td>
                <div class="action">
                  <a class="edit" href="edit.php?id=<?php echo $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                  <a class="delete" href="delete.php?id=<?php echo $user['id'] ?>"><i class="fa-solid fa-trash" ></i></a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>
</html>

