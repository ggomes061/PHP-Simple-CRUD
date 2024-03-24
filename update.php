<?php
include 'partials/header.php';
require __DIR__.'/users/users.php';


if (!isset($_GET['id'])){
    include "partials/not_found.php";
    exit;
}

$userid = $_GET['id'];
$user = getUserById($userid);

if (!$user){
    include "partials/not_found.php";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    updateUser($_POST, $userid);

    if (isset($_FILES['picture'])){
        if (!is_dir(__DIR__."/users/images")){
            mkdir(__DIR__."/users/images");
        }
        move_uploaded_file($_FILES['picture']['tmp_name'], __DIR__."/users/images/$userid.jpg");
    }

    //header("Location: index.php");
}


?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Update: <b><?php echo $user['name']?></b></h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" value="<?php echo $user['name'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" value="<?php echo $user['username'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" value="<?php echo $user['email'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" value="<?php echo $user['phone'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input name="website" value="<?php echo $user['website'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <input name="picture" type="file" class="form-control-file">
                </div>

                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>