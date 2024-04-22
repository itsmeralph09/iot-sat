<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
<div class="d-none" id="attendance"></div>

    <!-- include navbar -->
    <?php include './include/navbar.php'; ?>
    <!-- end navbar -->
    <!-- include sidebar.php -->
    <?php include './include/sidebar.php'; ?>
    <!-- end sidebar -->

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Attendance Records</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item"><a href="attendance.php">Attendance Records</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="">
              <!-- Column Card -->
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">List of Attendance</h4>
                              <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                              <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                      <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                                      <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li>
                                      <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                                      <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-hover display nowrap" id="myTable" width="100%" cellspacing="0">
                                          <thead class="bg-dark text-white">
                                              <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">UID</th>
                                                  <th scope="col">Name</th>
                                                  <th scope="col">Class</th>
                                                  <th scope="col">Type</th>
                                                  <th scope="col">Date</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
        </div>
      </div>
    </div>

    <!-- include footer.php -->
    <?php include './include/footer.php' ?>
    <!-- end footer -->

    <!-- include scripts.php -->
    <?php include './include/scripts.php'; ?>
    <!-- end scripts -->
<script>
    $(document).ready(function () {
        var lastFetchTime = null;
        var dataTableInitialized = false;
        var dataTable;

        function initializeDataTable() {
            dataTable = $('#myTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": true,
                "scrollCollapse": true,
                "scrollX": true
            });
        }

        function fetchData() {
            $.ajax({
                url: 'action/fetch_attendance.php',
                type: 'GET',
                data: {
                    last_fetch_time: lastFetchTime
                },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        lastFetchTime = response[0].date_time;
                        renderTable(response);
                    }
                },
                complete: function () {
                    setTimeout(fetchData, 300); // Fetch data every 2 seconds
                }
            });
        }

function renderTable(data) {
    if (!dataTableInitialized) {
        initializeDataTable();
        dataTableInitialized = true;
    }

    // Get the current row count in the DataTable
    var rowCount = dataTable.rows().count();

    // Loop through the data and add rows to the table if they are not already present
    $.each(data, function (index, row) {
        var typeBadge = row.type == 1 ? '<span class="badge badge-primary font-weight-bold">IN</span>' : '<span class="badge badge-danger font-weight-bold">OUT</span>';
        var date = new Date(row.date_time);
        var formattedDate = date.toLocaleString();

        // Check if the row is already present in the table
        var existingRow = dataTable.rows().data().filter(function (value) {
            return value[1] == row.uid && value[5] == formattedDate; // Assuming the second column contains the UID and the sixth column contains the date
        });

        if (existingRow.length === 0) {
            dataTable.row.add([
                (rowCount + 1), // Increment the row count
                row.uid,
                row.name,
                row.class,
                typeBadge,
                formattedDate
            ]);

            rowCount++; // Increment row count for the next row
        }
    });

    // Redraw the table
    dataTable.draw(false);
}

        fetchData(); // Start fetching data
    });
</script>

  </body>
</html>