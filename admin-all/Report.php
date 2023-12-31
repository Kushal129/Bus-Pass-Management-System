<?php

include '../connection.php';

$query = "SELECT * FROM report";
$result = $con->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id'])) {
        $id = $con->real_escape_string($_POST['id']);

        $deleteQuery = "DELETE FROM report WHERE id = '$id'";
        $result = $con->query($deleteQuery);

        if ($result) {
            header('Location: Report.php');
            exit();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        echo "Invalid request. 'id' parameter is missing.";
    }
}

if (!$result) {
    die("Database query failed: " . $con->error);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Report Details </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        #reportTable_wrapper {
            margin: 15px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        #reportTable thead th {
            background-color: #000;
            color: #feff3c;
            padding: 10px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            text-align: center;
        }

        .dataTables_wrapper .dataTables_filter input {
            display: inline-block;
            border: 1px solid #000;
            margin-bottom: 1rem;
            padding: 5px;
            background-color: transparent;
            margin-left: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .dataTables_filter::before {
            font-family: FontAwesome;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #f7dc6f;
        }

        .dataTables_filter input::placeholder {
            color: red;
        }

        .dataTables_length label {
            color: #000;
            font-weight: bold;
            font-size: 14px;
            margin-right: 10px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid black;
            border-radius: 6px;
            padding: 5px;
            padding-left: 2rem;
        }
        .delete-button {
            border: none;
            background-color: red;
            color: #000;
            font-size: 10px;
            margin-left: 2.5rem;
            padding: 6px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">B P M S</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../admin-all/admin.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../admin-all/Passes.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Passes</span>
                </a>
                <span class="tooltip">Passes</span>
            </li>
            <li>
                <a href="../admin-all/Search.php">
                    <i class='bx bx-search'></i>
                    <span class="links_name">Search</span>
                </a>
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="../admin-all/Report.php">
                    <i class='bx bx-bar-chart-square'></i>

                    <span class="links_name">Report of Pass</span>
                </a>
                <span class="tooltip">Report of Pass</span>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="head">
            <div class="profile">
                <img src="../img/admin.ico" class="pro-img" id="user-avatar" alt="User Avatar">
                <p class="profile-text">Admin</p>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>

        <!-- <p>report page je nakhe value aaya fatch kavi ne batavu and </p>
        <p>admin Search and show reports DATE rige pdf download and send it </p> -->

        <table id="reportTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Note</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['note'] . '</td>';
                    echo '<td>
                        <form action="../admin-all/Report.php" method="POST">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                      </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </section>
    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable();
        });
    </script>
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
    >
</body>

</html>