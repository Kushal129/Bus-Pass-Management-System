<?php
session_start();

include_once '../connection.php';

if (!isset($_SESSION['username'])) {
    // echo "usename not found";
    header('location:../index.php');
} else {
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $role = $row['role'];
    // echo $role;
    // 1 - user and 0 - admin
    if (!$role) {
        header("Location:../index.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $mobileNo = $_POST['mobileNo'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Update the user's profile picture
    if ($_FILES['profilePic']['name']) {
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($_FILES['profilePic']['name']);
        move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFile);

        // Update the user's profile picture path in the database
        // $updatePicQuery = "UPDATE users SET profile_picture = '$targetFile' WHERE email = ?";
        $stmt = $con->prepare($updatePicQuery);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
    }

    // Redirect to the profile page after updating
    header('location:manageprofile.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Profile </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">B P M S</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../user/user.php">
                    <i class='bx bx-comment-edit'></i>
                    <span class="links_name">Generate Pass</span>
                </a>
                <span class="tooltip">Generate Pass</span>
            </li>
            <li>
                <a href="../user/Managepass.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Manage Pass</span>
                </a>
                <span class="tooltip">Manage Pass</span>
            </li>
            <li>
                <a href="../user/manageprofile.php">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Manage Profile</span>
                </a>
                <span class="tooltip">Manage Profile</span>
            </li>
            <li>
                <a href="../user/userreport.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Reports</span>
                </a>
                <span class="tooltip">Reports</span>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="head">
            <div class="profile">
                <img src="../img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <div class="container">
        <!DOCTYPE html>
<html lang="en">
<head>
<style>

    
    .container {
        max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="password"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="file"] {
    margin-top: 10px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

</style>

</head>
<body>
<div class="container">

        <h1>Manage Profile</h1>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $user['full_name']; ?>">

            <label for="mobileNo">Phone Number:</label>
            <input type="text" id="mobileNo" name="mobileNo" value="<?php echo $user['phone_number']; ?>">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="M" <?php if ($user['gender'] == 'M') echo 'selected'; ?>>Male</option>
                <option value="F" <?php if ($user['gender'] == 'F') echo 'selected'; ?>>Female</option>
                <option value="T" <?php if ($user['gender'] == 'T') echo 'selected'; ?>>Transgender</option>
            </select>

            <label for="address">Address:</label>
            <textarea id="address" name="address"><?php echo $user['address']; ?></textarea>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">

            <label for="profilePic">Profile Picture:</label>
            <input type="file" id="profilePic" name="profilePic">

            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>
</html>

        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        searchBtn.addEventListener("click", () => {
            // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        // following are the code to change sidebar button
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
    <script>
        // Function to handle logout
        function logout() {

            window.location.href = '../logout.php';
        }

        document.getElementById('logout-btn').addEventListener('click', logout);
    </script>
</body>

</html>