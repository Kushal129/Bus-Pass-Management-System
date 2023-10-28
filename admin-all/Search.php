<?php
include '../connection.php';
include '../toaster.php';

$query = "SELECT pi.full_name, pi.validate_through, pi.dob, p.bus_type, p.start_term_id, p.ends_term_id, p.from_date, p.to_date FROM passenger_info pi
          INNER JOIN pass p ON pi.id = p.id";

$result = $con->query($query);

if ($result) {
    $table = '<table id="passenger-table" class="display">';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th>Full Name</th>';
    $table .= '<th>Validation Through</th>';
    $table .= '<th>Date of Birth</th>';
    $table .= '<th>Bus Type</th>';
    $table .= '<th>Start Term</th>';
    $table .= '<th>End Term</th>';
    $table .= '<th>From Date</th>';
    $table .= '<th>To Date</th>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>';
        $table .= '<td>' . $row['full_name'] . '</td>';
        $table .= '<td>' . $row['validate_through'] . '</td>';
        $table .= '<td>' . $row['dob'] . '</td>';
        $table .= '<td>' . $row['bus_type'] . '</td>';
        $table .= '<td>' . $row['start_term_id'] . '</td>';
        $table .= '<td>' . $row['ends_term_id'] . '</td>';
        $table .= '<td>' . $row['from_date'] . '</td>';
        $table .= '<td>' . $row['to_date'] . '</td>';
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
        <!-- [{"full_name":"Kushal","validate_through":"2024-04-21","dob":"2004-08-12","bus_type":"1","start_term_id":"1","ends_term_id":"2","from_date":"2023-10-21","to_date":"2023-11-20"}] -->

        <!-- <section class="search">
            <table id="passenger-table" class="display">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Validation Through</th>
                        <th>Date of Birth</th>
                        <th>Bus Type</th>
                        <th>Start Term </th>
                        <th>End Term </th>
                        <th>From Date</th>
                        <th>To Date</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </section> -->

        <section class="search">
            <?php echo $table; ?>
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
                "paging": true, // Enable paging
                "searching": true, // Enable searching
                "ordering": true, // Enable sorting
            });
        });
    </script>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: '../admin-all/Search.php', // Replace with the correct URL to fetch your data
            dataType: 'json',
            success: function(data) {
                var table = $('#passenger-table').DataTable({
                    data: data,
                    columns: [
                        { data: 'full_name' },
                        { data: 'validate_through' },
                        { data: 'dob' },
                        { data: 'bus_type' },
                        { data: 'start_term_id' },
                        { data: 'ends_term_id' },
                        { data: 'from_date' },
                        { data: 'to_date' }
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