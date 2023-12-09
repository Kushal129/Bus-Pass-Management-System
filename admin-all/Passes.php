<?php
session_start();
$insert = false;
$edit = false;
$deleted = false;

include_once '../connection.php';
include_once '../toaster.php';

if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_bus'])) {
    if (isset($_POST['bus_name'])) {
        $bus_name = $_POST['bus_name'];
    }
    if (isset($_POST['price_multiply'])) {
        $price_multiply = $_POST['price_multiply'];
    }
    $sql = "INSERT INTO bus_type (`bus_name`, `price_multiply`) VALUES ('$bus_name', '$price_multiply')";

    $result = mysqli_query($con, $sql);
    $_POST = array();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_bus'])) {
    $bus_id = $_POST['bus_id'];
    if (isset($_POST['bus_name'])) {
        $bus_name = $_POST['bus_name'];
    }
    if (isset($_POST['price_multiply'])) {
        $price_multiply = $_POST['price_multiply'];
    }
    $sql = "UPDATE bus_type SET bus_name='$bus_name', price_multiply='$price_multiply' WHERE bus_id = $bus_id";
    $result = mysqli_query($con, $sql);
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_bus'])) {
    $bus_id = $_POST['bus_id'];
    $sql = "DELETE FROM bus_type WHERE bus_id = $bus_id";
    $result = mysqli_query($con, $sql);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
        <?php
        if ($insert) {
            echo '<script>showToaster("Your Data Has been Inserted Successfully.", "green")</script>';
        }

        if ($edit) {
            echo '<script>showToaster("Your Data Has been Updated Successfully.", "green")</script>';
        }

        if ($deleted) {
            echo '<script>showToaster(" Your Data Has been Deleted Successfully.", "green")</script>';
        }
        ?>
        <div class="form-group">
            <h1>Manage Pass</h1>
            <hr>
            <h2>Buses</h2>
            <div class="container" my-6>
                <form action="Passes.php" method="POST">
                    <div class="form-group">
                        <label for="bus_name">Bus Name</label>
                        <input type="text" class="form-control" name="bus_name" id="bus_name" aria-describedby="emailHelp">
                        <label for="price_multiply">Price Multiply</label>
                        <input type="text" class="form-control" name="price_multiply" id="price_multiply">
                    </div>
                    <button type="submit" name="add_bus" class="btn btn-primary add_bus">Add Bus</button>
                </form>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Bus Name</th>
                            <th scope="col">Price Multiply</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM bus_type";
                        $result = mysqli_query($con, $sql);
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $bus_id = $row['bus_id'];
                            echo "<tr>";
                            echo "<th scope='row'>" . ++$counter . "</th>";
                            echo "<td class='bus-name' contenteditable='false'>" . $row['bus_name'] . "</td>";
                            echo "<td class='price-multiply' contenteditable='false'>" . $row['price_multiply'] . "</td>";
                            echo "<td>
                                    <button type='button' class='btn btn-warning edit-button'>Edit</button>
                                    <button type='button' class='btn btn-danger delete-button' data-bus_id=$bus_id >Delete</button>
                                    <button type='button' class='btn btn-info cancel-edit hidden' disabled>Cancel</button>
                                    <button type='button' class='btn btn-success save-edit hidden' disabled>Save</button>
                                  </td>";
                            echo "</tr>";
                        }
                        $counter = 0;
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $(document).ready(function() {

                $('.add_bus').click(function() {
                    var url = window.location.href

                    // const bus_name = row.find('.bus-name').text()
                    // const price_multiply = row.find('.price-multiply').text()

                    var formData = {
                        'bus_name': $('#bus_name').val(),
                        'price_multiply': $('#price_multiply').val(),
                        'add_bus': true
                    };
                    $.ajax({
                        type: 'POST',
                        url: 'Passes.php', // Replace with the correct URL
                        data: formData,
                        success: function(response) {
                            console.log(response);

                            // You can also reset the form if necessary
                            $('form')[0].reset();

                            // Reload the DataTable (assuming you're using DataTables)
                            $('#myTable').DataTable().ajax.reload();
                            window.location.href = url

                        },
                        error: function(error) {
                            // Handle the error response, if needed
                            console.error(error);
                        }
                    });;
                });

                $('.edit-button').click(function() {
                    const row = $(this).closest('tr');
                    row.find('.bus-name, .price-multiply').attr('contenteditable', 'true');
                    row.find('.save-edit, .cancel-edit').removeClass('hidden').prop('disabled', false);
                    row.find('.edit-button, .delete-button').prop('disabled', true);
                });

                $('.save-edit').click(function() {
                    var url = window.location.href

                    const row = $(this).closest('tr');
                    const bus_id = row.find('.bus-id').text();

                    const bus_name = row.find('.bus-name').text();
                    const price_multiply = row.find('.price-multiply').text();

                    $.ajax({
                        type: "POST",
                        url: "Passes.php",
                        data: {
                            bus_id: bus_id,
                            bus_name: bus_name,
                            price_multiply: price_multiply,
                            edit_bus: true
                        },
                        success: function(response) {
                            console.log(response);
                            row.find('.bus-name, .price-multiply').attr('contenteditable', 'false');
                            row.find('.save-edit, .cancel-edit').addClass('hidden').prop('disabled', true);
                            row.find('.edit-button, .delete-button').prop('disabled', false);

                            row.find('.bus-name').text(bus_name);
                            row.find('.price-multiply').text(price_multiply);
                            window.location.href = url

                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });

                $('.cancel-edit').click(function() {
                    const row = $(this).closest('tr');
                    row.find('.bus-name, .price-multiply').attr('contenteditable', 'false');
                    row.find('.save-edit, .cancel-edit').addClass('hidden').prop('disabled', true);
                    row.find('.edit-button, .delete-button').prop('disabled', false);
                });

                $(document).on('click', '.delete-button', function() {
                    var url = window.location.href
                    // console.log(url);
                    if (confirm("Are you sure you want to delete this record?")) {
                        const row = $(this).closest('tr');
                        const bus_id = $(this).data('bus_id');
                        $.ajax({
                            type: "POST",
                            url: "Passes.php",
                            data: {
                                bus_id: bus_id,
                                delete_bus: true
                            },
                            success: function(response) {
                                $('#myTable').DataTable().destroy();
                                row.remove();
                                $('#myTable').DataTable();
                                // window.location.href = url                                
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }
                });

            });
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

        function logout() {
            window.location.href = '../logout.php';
        }

        document.getElementById('logout-btn').addEventListener('click', logout);
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>