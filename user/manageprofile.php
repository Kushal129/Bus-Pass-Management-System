<?php
session_start();
include_once '../connection.php';
include_once '../toaster.php';

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
    exit;
} else {
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $use_img = $row['user_img_path'];

    $role = $row['role'];
    if (!$role) {
        header("Location:../index.php");
        exit;
    }

    $email = $_SESSION['username'];
    $q = mysqli_query($con, "select * from users where email='$email'");
    $row = mysqli_fetch_assoc($q);
    $id = $row['id'];
    $q1 = mysqli_query($con, "select * from passenger_info where user_id='$id'");
    $row1 = mysqli_fetch_assoc($q1);

    $email = $row['email'];
    $phone_number = $row['phone_number'];
    $full_name = $row['full_name'];

    $dob = isset($row1['dob']) ? $row1['dob'] : '';
    $gender = isset($row1['gender']) ? $row1['gender'] : '';
    $user_img_path = isset($row1['user_img_path']) ? $row1['user_img_path'] : '';
}

if (isset($_POST['update_profile'])) 
{
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    // $user_img_path = $_POST['user_img_path']; 

    if ($full_name == $row['full_name'] && $gender == $row1['gender'] && $dob == $row1['dob'] && empty($_FILES['img_update']['name'])) {
        echo '<script>showToaster("No changes made to the profile data.", "orange")</script>';

    } else {
        if (!empty($_FILES['img_update']['name'])) {
            $targetDirectory = "../uploads/";
            $targetFile = $targetDirectory . basename($_FILES['img_update']['name']);

            if (move_uploaded_file($_FILES['img_update']['tmp_name'], $targetFile)) {
                $user_img_path = $targetFile;

                $updatePassengerInfoQuery = "UPDATE passenger_info SET full_name=?, gender=?, dob=?, user_img_path=? WHERE user_id=?";
                $stmt = $con->prepare($updatePassengerInfoQuery);
                $stmt->bind_param("ssssi", $full_name, $gender, $dob, $user_img_path, $id);

                if ($stmt->execute()) {
                    $updateUserQuery = "UPDATE users SET full_name=?, user_img_path=? WHERE id=?";
                    $stmt = $con->prepare($updateUserQuery);
                    $stmt->bind_param("ssi", $full_name, $user_img_path, $id);

                    if ($stmt->execute()) {
                        echo '<script>showToaster("Profile updated successfully.", "green")</script>';
                    } else {
                        echo '<script>showToaster("Failed to update user image in the users table.", "red")</script>';
                    }
                } else {
                    echo '<script>showToaster("Failed to update user image in the passenger_info table.", "red")</script>';
                }
            } else {
                echo '<script>showToaster("Image upload failed. Please try again.", "red")</script>';
            }
        } else {
            $updatePassengerInfoQuery = "UPDATE passenger_info SET full_name=?, gender=?, dob=? WHERE user_id=?";
            $stmt = $con->prepare($updatePassengerInfoQuery);
            $stmt->bind_param("sssi", $full_name, $gender, $dob, $id);

            if ($stmt->execute()) {
                $updateUserQuery = "UPDATE users SET full_name=? WHERE id=?";
                $stmt = $con->prepare($updateUserQuery);
                $stmt->bind_param("si", $full_name, $id);

                if ($stmt->execute()) {
                    echo '<script>showToaster("Profile updated successfully.", "green")</script>';
                    echo '<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>';
                } else {
                    echo '<script>showToaster("Failed to update profile in the users table.", "red")</script>';
                }
            } else {
                echo '<script>showToaster("Profile update failed. Please try again.", "red")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Profile </title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="icon" type="image/ico" href="../img/buslogo.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .img_update {
        background-color: green;
        cursor: pointer;
        width: 50%;
    }
</style>

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
                <a href="../user/manageprofile.php">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Manage Profile</span>
                </a>
                <span class="tooltip">Manage Profile</span>
            </li>
            <li>
                <a href="../user/changepass.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Change Password</span>
                </a>
                <span class="tooltip">Change Password</span>
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
                <!-- <img src="../img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar"> -->
                <!-- <img src="<php echo $user_img_path; ?>" class="pro-img" id="user-avatar" alt="User Avatar"> -->
                <img class="pro-img" id="user-avatar" alt="User Avatar" src="../uploads/user_photo/<?php echo $use_img; ?>">

                <div class="profile-text"><?php echo $row['full_name']; ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>

        <form action="../user/manageprofile.php" method="POST" enctype="multipart/form-data">
            <div class="down-container">
                <div class="form-group">
                    <h1>Manage Profile</h1>
                    <hr>
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
                    <br>
                    <label for="mobileNo">Phone Number:</label>
                    <input type="text" id="mobileNo" name="mobileNo" value="<?php echo $phone_number; ?>">
                    <br>
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Transgender" <?php if ($gender === 'Transgender') echo 'selected'; ?>>Transgender</option>
                    </select>
                    <br>
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo $row1['dob']; ?>">
                    <br>
                    <br>
                    <label for="img_update">Photo Upload:</label>
                    <input type="file" name="img_update" id="img_update" accept=".png, .jpg, .jpeg">
                    <p>[Self-attached Passport size Photo Copy. Max size: 300KB]</p>
                    <span id="img_update_error" class="error-message" style="color: red;"></span>
                    <br>
                    <br>
                    <input type="submit" class="btn-pmt" id="update_profile" name="update_profile" value="Update Profile">
                </div>
            </div>
        </form>
    </section>
</body>

</html>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }
</script>
<script>
    function logout() {

        window.location.href = '../logout.php';
    }

    document.getElementById('logout-btn').addEventListener('click', logout);
</script>

<script>
    $(document).ready(function() {
        $('#img_update').on('change', function() {
            const fileInput = this;
            const errorElement = $('#img_update_error');

            errorElement.text('');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
                const maxFileSize = 300 * 1024;

                if (!allowedFormats.includes(file.type)) {
                    errorElement.text('Please upload an image in PNG, JPG, or JPEG format.');
                    fileInput.value = '';
                } else if (file.size > maxFileSize) {
                    errorElement.text('Please upload an image that is no more than 300KB in size.');
                    fileInput.value = '';
                }
            }
        });
    });
</script>