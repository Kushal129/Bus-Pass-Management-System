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
        <section class="search">
            <!-- <div class="search-form">
                <form>
                    <label for="search-passenger">Search Passenger:</label>
                    <input type="text" id="search-passenger" name="search-passenger">
                    <button type="submit">Search</button>
                    <p>search karin ne table ma data batavse....</p>
                </form>
            </div> -->
            <div class="form-group">
                <h1>Search Passenger Details </h1>
                <form class="search-form">
                    <label for="search-passenger">Search:</label>
                    <input type="text" id="search-passenger" name="search-passenger">
                    <button type="submit">Search</button>
                </form>
                <hr style="margin: 2rem;">
                <div class="table-container">
                    <table id="passenger-table" class="display">
                        <thead>
                            <tr>
                                <th>Bus ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be populated dynamically using jQuery -->
                        </tbody>
                    </table>
                </div>
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
            const dataTable = $('#passenger-table').DataTable();

            $('#search-form').submit(function(e) {
                e.preventDefault();

                const searchKeyword = $('#search-passenger').val();

                $.ajax({
                    method: 'POST',
                    data: {
                        searchKeyword: searchKeyword
                    },
                    dataType: 'json',
                    success: function(data) {
                        dataTable.clear().draw();

                        data.forEach(function(record) {
                            dataTable.row.add([
                                record.bus_id,
                                record.name,
                                record.date,
                            ]).draw(false);
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
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