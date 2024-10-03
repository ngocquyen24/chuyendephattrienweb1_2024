<?php

session_start();
require_once 'models/UserModel.php';

$userModel = new UserModel();
$user = null; 
$userId = null;


if (!empty($_GET['id'])) {
    $encodedId = $_GET['id'];
    $userId = decodeId($encodedId);
    $user = $userModel->findUserById($userId); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = validateInput($_POST);
    
    if (empty($errors)) {
        if (!empty($userId)) {
            $userModel->updateUser($_POST);
        } else {
            $userModel->insertUser($_POST);
        }
        header('Location: list_users.php');
        exit;
    } else {

        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}


function encodeId($id) {
    return base64_encode($id);
}

function decodeId($encodedId) {
    return base64_decode($encodedId);
}


function validateInput($data) {
    $errors = [];


    if (empty($data['name'])) {
        $errors[] = "Name is required.";
    } elseif (!preg_match('/^[A-Za-z0-9]{5,15}$/', $data['name'])) {
        $errors[] = "Name must be between 5 and 15 characters and contain only letters and numbers.";
    }


    if (empty($data['password'])) {
        $errors[] = "Password is required.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!@#$%^&*()]).{5,10}$/', $data['password'])) {
        $errors[] = "Password must be 5 to 10 characters long and include at least one lowercase letter, one uppercase letter, one number, and one special character.";
    }

    return $errors;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <?php include 'views/meta.php'; ?>
</head>

<body>
    <?php include 'views/header.php'; ?>
    <div class="container">

        <?php if ($user || !$userId) { ?>
            <div class="alert alert-warning" role="alert">
                User Form
            </div>
            <form method="POST" id="userForm">
                <input type="hidden" name="id" value="<?php echo $userId; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" 
                           value="<?php echo isset($user[0]['name']) ? htmlspecialchars($user[0]['name']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>

    <script>
        document.getElementById('userForm').onsubmit = function() {
            return validateForm();
        };

        function validateForm() {
            let name = document.forms["userForm"]["name"].value;
            let password = document.forms["userForm"]["password"].value;


            if (name === "") {
                alert("Name is required.");
                return false;
            }
            if (!/^[A-Za-z0-9]{5,15}$/.test(name)) {
                alert("Name must be 5-15 characters long and can only contain letters and numbers.");
                return false;
            }


            if (password === "") {
                alert("Password is required.");
                return false;
            }
            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()]).{5,10}$/.test(password)) {
                alert("Password must be 5-10 characters long, contain lowercase, uppercase, number, and special character.");
                return false;
            }

            return true; 
        }
    </script>
</body>
</html>
