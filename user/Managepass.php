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
    $use_img = $row['user_img_path'];
    $name = $row['full_name'];

    $role = $row['role'];
    // echo $role;
    // 1 - user and 0 - admin
    if (!$role) {
        header("Location:../index.php");
    }
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT pi.full_name, pi.validate_through, pi.dob, p.user_id, p.bus_type,pi.role,
                     b.bus_name, p.start_term_id, s.ter_name as s_ter, p.ends_term_id, e.ter_name as e_ter,
                     p.from_date, p.to_date , p.id as pass_id
              FROM passenger_info pi
              INNER JOIN pass p ON pi.id = p.passenger_id
              INNER JOIN bus_type b ON p.bus_type = b.bus_id
              INNER JOIN bus_terminals s ON p.start_term_id = s.ter_id
              INNER JOIN bus_terminals e ON p.ends_term_id = e.ter_id
              WHERE p.user_id = $user_id";
}

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
    $table .= '<th>View Pass</th>';
    // $table .= '<th>Download Pass</th>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $pass_id  = $row['pass_id'];
        $table .= '<tr>';
        $table .= '<td>' . $row['user_id'] . '</td>';
        $table .= '<td>' . $row['full_name'] . '</td>';
        $table .= '<td>' . $row['validate_through'] . '</td>';
        $table .= '<td>' . $row['dob'] . '</td>';
        $table .= '<td>' . $row['bus_name'] . '</td>';
        $table .= '<td>' . $row['s_ter'] . '</td>';
        $table .= '<td>' . $row['e_ter'] . '</td>';
        $table .= '<td>' . $row['from_date'] . '</td>';
        $table .= '<td>' . $row['to_date'] . '</td>';
        $table .= '<td>';
        if($row['role'] == "Student")
        $table .= '<a class="button view-button" href="../main/view_pass.php?pass_id='.$pass_id.'">View <i class="fas fa-eye" style= "margin-left: 5px;"></i></a>';
        else {
            $table .= '<a class="button view-button" href="../main/view_passp.php">View <i class="fas fa-eye" style= "margin-left: 5px;"></i></a>';
        }
        $table .= '</td>';
        // $table .= '<td>';
        // $table .= '<button class="download-button">Download <i class="fas fa-download"></i></button>';
        // $table .= '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';
} else {
    $table = 'Error: ' . $con->error;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Pass | Passes </title>
    <link rel="stylesheet" href="../css/user.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
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

    .button {
        size: 50%;
        display: flex;
        justify-content: center;
        padding: 10px 20px;
        background-color: black;
        color: whitesmoke;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #feff3c;
        color: black;
    }
    .dataTables_filter{
        margin-bottom: 1rem !important ;
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
                <a href="../user/Managepass.php">
                    <i class='bx bx-credit-card-front'></i>
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
                <img class="pro-img" id="user-avatar" alt="User Avatar" src="../uploads/user_photo/<?php echo $use_img; ?>">
                <div class="profile-text"><?php echo $name; ?></div>
            </div>
            <button class="logout-btn" id="logout-btn" onclick="logout()">Logout</button>
        </div>
        <section class="search">
            <div class="form-group">
                <?php echo $table; ?>
            </div>
        </section>
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
        console.log("QR code generation function is executing.");
        const qrData = `
    From Date: <?php echo date('d-m-Y', strtotime($from_date)); ?>
    To Date: <?php echo date('d-m-Y', strtotime($to_date)); ?>
    Name: <?php echo $full_name; ?>
    Gender: <?php echo $gender; ?>
    Pass Type: <?php echo $bus_type; ?>
    Pass Days: <?php echo $passType; ?>
    From Location: <?php echo $start_term_id; ?>
    To Location: <?php echo $ends_term_id; ?>
`;

        console.log("QR Data:", qrData);

        const qrcodeContainer = document.getElementById("qrcode-container");
        if (qrcodeContainer) {
            const qrcode = new QRCode(qrcodeContainer, {
                text: qrData,
            });
        } else {
            console.error("QR code container not found.");
        }
    });
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
    function generatePDF() {
        window.print();
    }
</script>