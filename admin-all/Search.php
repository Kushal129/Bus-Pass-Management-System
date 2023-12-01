<?php
session_start();

include '../connection.php';
include '../toaster.php';


$query = "SELECT pi.full_name, pi.validate_through, pi.dob,p.user_id, p.bus_type ,pi.role,
                 b.bus_name , p.start_term_id, p.id  as pass_id, s.ter_name ,p.ends_term_id, e.ter_name,
                 p.from_date, p.to_date , p.is_verify FROM passenger_info pi
                 INNER JOIN pass p ON pi.id = p.passenger_id 
                 INNER JOIN bus_type b on p.bus_type = b.bus_id 
                 INNER JOIN bus_terminals s on p.start_term_id = s.ter_id 
                 INNER JOIN bus_terminals e on p.ends_term_id = e.ter_id 
                 INNER JOIN users u ON pi.user_id = u.id";
$start = ['s.ter_name'];
$end = ['e.ter_name'];
$role = ['role'];
$pass_id = ['pass_id'];


$result = $con->query($query);
if ($result) {
    $table = '<table id="passenger-table" class="display">';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th>User Id</th>';
    $table .= '<th>Full Name</th>';
    $table .= '<th>Validation Through</th>';
    $table .= '<th>Date of Birth</th>';
    $table .= '<th>Bus Type</th>';
    $table .= '<th>Start Term</th>';
    $table .= '<th>End Term</th>';
    $table .= '<th>From Date</th>';
    $table .= '<th>To Date</th>';
    $table .= '<th>Staus</th>';
    $table .= '<th>Verification</th>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>';
        $table .= '<td>' . $row['user_id'] . '</td>';
        $table .= '<td>' . $row['full_name'] . '</td>';
        $table .= '<td>' . $row['validate_through'] . '</td>';
        $table .= '<td>' . $row['dob'] . '</td>';
        $table .= '<td>' . $row['bus_name'] . '</td>';
        $table .= '<td>' . $row['ter_name'] . '</td>';
        $table .= '<td>' . $row['ter_name'] . '</td>';
        $table .= '<td>' . $row['from_date'] . '</td>';
        $table .= '<td>' . $row['to_date'] . '</td>';
        if($row['is_verify']  == 0){
        $table .= '<td><span class="bedge bedge-warning"> Panding </span> </td>';
        }elseif($row['is_verify']  == 1){
        $table .= '<td><span class="bedge bedge-success"> Approve </span></td>';
        }else{
        $table .= '<td> <span class="bedge bedge-danger"> Reject </span> </td>';
        }
        $table .= '<td>';
        if($row['role'] == "Student"){
            $table .= '<a class="button view-button" href="verifyP.php?pass_id=' . $row["pass_id"] . '">View <i class="fas fa-eye" style="margin-left: 5px;"></i></a>';
        }else {
            $table .= '<a class="button view-button" href="verifyPp.php?pass_id=' . $row["pass_id"] . '">View <i class="fas fa-eye" style="margin-left: 5px;"></i></a>';

        }
        $table .= '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';
} else {
    $table = 'Error: ' . $con->error;
}
$con->close();
?>



<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin Page </title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    thead {
        background-color: #000;
        color: #feff3c;
        padding: 10px;
        font-weight: bold;
        font-size: 14px;
        text-transform: uppercase;
        text-align: center;
    }

    .btn-view {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        border-radius: 5px;
        border: none;
        padding: 8px;
        background-color: #000;
        color: white;
        margin-left: 2.5rem;
    }

    .btn-view:hover {
        background-color: #feff3c;
        color: #000;
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
        <section class="search">
            <div class="form-group">
                <?php echo $table; ?>
            </div>
        </section>

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
        $(document).ready(function() {
            $('#passenger-table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../Search.php',
                dataType: 'json',
                success: function(data) {
                    var table = $('#passenger-table').DataTable({
                        data: data,
                        columns: [{
                                data: 'user_id'
                            },
                            {
                                data: 'full_name'
                            },
                            {
                                data: 'validate_through'
                            },
                            {
                                data: 'dob'
                            },
                            {
                                data: 'bus_name'
                            },
                            {
                                data: 'ter_name'
                            },
                            {
                                data: 'ter_name'
                            },
                            {
                                data: 'from_date'
                            },
                            {
                                data: 'to_date'
                            }
                        ]
                    });
                }
            });
        });
    </script>

    <script>
        function logout() {

            window.location.href = '../logout.php';
        }

        document.getElementById('logout-btn').addEventListener('click', logout);
    </script>
</body>

</html>