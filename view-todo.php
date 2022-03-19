<?php
include "config.php";
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    die();
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">
    <title>TO DOLIST</title>
</head>

<body>
<header class="py-3 mb-4 border-bottom" style="background-color: #4481eb;">
        <div class="d-flex flex-wrap justify-content-center container">
            <a href="todos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="images/u.png" width="55x" height="55px" alt="">
                <span class="fs-4"><?php echo "<h2> &nbsp; Welcome " . $_SESSION['username'] . "</h2>"; ?></span>
            </a>
            <ul class="nav nav-pills">
            <li class="nav-item"><a href="todos.php" class="nav-link bg-light
              text-black">Home </a></li>
            <p> &nbsp;  &nbsp;  &nbsp;</p>
            <li class="nav-item"><a href="add-todo.php" class="nav-link bg-light text-black">Add TODO</a></li>
            <p> &nbsp;  &nbsp;  &nbsp;</p>
            <li class="nav-item"><a href="logout.php" class="nav-link bg-danger text-white">Logout</a></li>
            </ul>
        </div>
    </header>
    
    <div class="container">
        <div class="row">
            <?php
            $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
            // Get User Id based on user email
            $sql = "SELECT id FROM users WHERE email='{$_SESSION["email"]}'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $user_id = $row["id"];
            } else {
                $user_id = 0;
            }
            $sql1 = "SELECT * FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
            $res1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($res1) > 0) {
                foreach ($res1 as $todo) {
            ?>
                    <main>
                        <h1><?php echo $todo["title"]; ?></h1>
                        <p class="fs-5 col-md-8"><?php echo $todo["description"]; ?></p>

                        <div class="mb-5">
                            <a href="<?php echo 'edit-todo.php?id='. $todo['id']; ?>" class="btn btn-primary btn-lg px-3 me-3">Edit</a>
                            <a href="<?php echo 'delete-todo.php?id='. $todo['id']; ?>" class="btn btn-danger btn-lg px-3">Delete</a>
                        </div>
                    </main>
            <?php }
            } else {
                header("Location: todos.php");
                die();
            } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <div style="position: fixed; bottom: 2rem; right: .01rem;">
    <a><img src="images/t.png" width="100px" height="100"/></a>
</body>

</html>