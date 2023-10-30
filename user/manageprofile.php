<?php
session_start();
include_once '../connection.php';
include_once '../toaster.php';

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
} else {
    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($checkEmailQuery);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $role = $row['role'];
    if (!$role) {
        header("Location:../index.php");
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
    $dob = $row1['dob'];
    echo "-----------------------------------------------=======-----$dob=";
    $gender = $row1['gender'];
    $address = $row1['address'];
    $user_img_path = $row1['user_img_path'];
}

if (isset($_POST['update_profile'])) {
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    if (!empty($_FILES['img_update']['name'])) {
        $targetDirectory = "../uploads/";
        $targetFile = $targetDirectory . basename($_FILES['img_update']['name']);
        if (move_uploaded_file($_FILES['img_update']['tmp_name'], $targetFile)) {
            $user_img_path = $targetFile;

            $updatePassengerInfoQuery = "UPDATE passenger_info SET full_name=?, gender=?, dob=?, user_img_path=? WHERE user_id=?";
            $stmt = $con->prepare($updatePassengerInfoQuery);
            $stmt->bind_param("ssssi", $full_name, $gender, $dob, $user_img_path, $id);

            $updateUserQuery = "UPDATE users SET full_name=? WHERE id=?";
            $stmt = $con->prepare($updateUserQuery);
            $stmt->bind_param("si", $full_name, $id);

            if ($stmt->execute()) {
                echo '<script>showToaster("Profile updated successfully.", "green")</script>';
            } else {
                echo '<script>showToaster("Profile update failed. Please try again.", "red")</script>';
            }
        } else {
            echo '<script>showToaster("Image upload failed. Please try again.", "red")</script>';
        }
    } else {
        $updatePassengerInfoQuery = "UPDATE passenger_info SET full_name=?, gender=?, dob=? WHERE user_id=?";
        $stmt = $con->prepare($updatePassengerInfoQuery);
        $stmt->bind_param("sssi", $full_name, $gender, $dob, $id);

        if ($stmt->execute()) {
            echo '<script>showToaster("Profile updated successfully.", "green")</script>';
        } else {
            echo '<script> showToaster("Profile update failed. Please try again.", "red")</script>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .img_update{
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
                <img src="<?php echo $user_img_path; ?>" class="pro-img" id="user-avatar" alt="User Avatar">

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
                    <input type="file" name="img_update" id="img_update" accept=".png, .jpg, .jpeg" >
                    <p>[Self-attached Passport size Photo Copy. Max size: 200KB]</p>
                    <span id="img_update" class="error-message" style="color: red;"></span>
                    <br>
                    <br>
                    <input type="submit" class="btn-upload btn-" id="update_profile" name="update_profile" value="Update Profile">
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
        alert('Pic ma jai che');
        const imgUpdateInput = $('#img_update');
        const photoErrorElement = $('#img_update');

        imgUpdateInput.on('change', function() {
            const file = this.files[0];

            if (file) {
                const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
                const maxFileSize = 200 * 1024;
                const minFileSize = 50 * 1024;

                if (!allowedFormats.includes(file.type)) {
                    displayError(photoErrorElement, 'Please upload an image in PNG, JPG, or JPEG format.');
                    imgUpdateInput.val('');
                } else if (file.size < minFileSize) {
                    displayError(photoErrorElement, 'Please upload an image that is at least 50KB in size.');
                    imgUpdateInput.val('');
                } else if (file.size > maxFileSize) {
                    displayError(photoErrorElement, 'Please upload an image that is no more than 200KB in size.');
                    imgUpdateInput.val('');
                } else {
                    clearError(photoErrorElement);
                }

            } else {
                clearError(photoErrorElement);
            }
        });

        function displayError(element, message) {
            element.text(message);
        }

        function clearError(element) {
            element.text('');
        }
    });
</script>