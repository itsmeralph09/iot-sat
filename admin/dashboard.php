<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- include head.php -->
  <?php include './include/head.php'; ?>
  <!-- end head -->

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-red-pink" data-col="2-columns">
    <div class="d-none" id="dashboard"></div>

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
            <h3 class="content-header-title">Dashboard</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="">
              <!-- Column Card -->
  <div class="row match-height">
    
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted danger position-absolute">Porta <span id="device-name">Primaria</span></h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-duotone fa-torii-gate danger font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-center p-1">
                    <i class="fa-duotone fa-wifi-slash secondary fa-5x" id="status-icon"></i>
                    <p id="device-status" class="mt-1 text-secondary">Device is offline!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted primary position-absolute">Porta <span id="device-name2">Exitus</span></h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-duotone fa-torii-gate primary font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-center p-1">
                    <i class="fa-duotone fa-wifi-slash secondary fa-5x" id="status-icon2"></i>
                    <p id="device-status2" class="mt-1 text-secondary">Device is offline!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-12">
    <div class="card height-200 pull-up">
        <div class="card-header">
            <h5 class="text-muted warning position-absolute">Last Active</h5>
            <a class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <i class="fa-duotone fa-clock warning font-large-1 float-right"></i>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-left">
                    <div class="my-2">
                        <p class="mb-0 font-weight-bold"></i>Porta Primaria: <span class="font-weight-light" id="last-active1"> N/A</span></p>
                        
                    </div>
                    <div class="my-2">
                        <p class="mb-0 font-weight-bold"></i>Porta Exitus: <span class="font-weight-light" id="last-active2"> N/A</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
          </section>
<!-- Pie charts section start -->
<section id="chartjs-pie-charts">
    <div class="row">
        <!-- Simple Pie Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card pull-up">
                <div class="card-header">
                    <h4 class="card-title">Chart 1</h4>
                    <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li>/ -->
                            <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                            <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                            <div class="height-300">
                        <canvas id="simple-pie-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Doughnut Chart -->
        <div class="col-md-6 col-sm-12">
            <div class="card pull-up">
                <div class="card-header">
                    <h4 class="card-title">Chart 2</h4>
                    <a class="heading-elements-toggle"><i class="fa-solid fa-ellipsis-vertical font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="fa-solid fa-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="fa-solid fa-rotate"></i></a></li> -->
                            <li><a data-action="expand"><i class="fa-solid fa-expand"></i></a></li>
                            <!-- <li><a data-action="close"><i class="fa-solid fa-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                            <div class="height-300">
                        <canvas id="simple-doughnut-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<!-- // Pie charts section end -->
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
        $(document).ready(function(){
        //inialize datatable
        $('#myTable').DataTable({
            scrollX: true
        })

        });
    </script>
    <script>
    $(document).ready(function() {
        // Function to update the card based on data from check_active.php
        function updateCard(statusIconId, deviceStatusId, deviceNameId, deviceLastActive, color) {
            // Fetch device name from the span
            var deviceName = $('#' + deviceNameId).text().toLowerCase();

            $.ajax({
                url: '../function/check_active.php', // Change the URL to point to your check_active.php script
                dataType: 'json',
                data: { deviceName: deviceName }, // Pass deviceName as data to the AJAX request
                success: function(data) {
                    if (data.length > 0) {
                        var lastActiveTime = new Date(data[data.length - 1].last_active);
                        var currentTime = new Date();
                        var diffInSeconds = (currentTime - lastActiveTime) / 1000;

                        var formattedDateTime = lastActiveTime.toLocaleString('en-US', { 
                            year: 'numeric', 
                            month: '2-digit', 
                            day: '2-digit', 
                            hour: '2-digit', 
                            minute: '2-digit',
                            hour12: true // Specify whether to use 12-hour or 24-hour time format
                        });

                        // Update the card based on the time difference
                        if (diffInSeconds > 10) {
                            $('#' + statusIconId).removeClass('fa-wifi '+color).addClass('fa-wifi-slash secondary');
                            $('#' + deviceStatusId).removeClass('text-'+color).addClass('text-secondary').text('Device is offline!');
                            $('#' + deviceLastActive).addClass('text-warning').text(formattedDateTime);
                        } else {
                            $('#' + statusIconId).removeClass('fa-wifi-slash secondary').addClass('fa-wifi '+color);
                            $('#' + deviceStatusId).removeClass('text-secondary').addClass('text-'+color).text('Device is online!');
                            $('#' + deviceLastActive).addClass('text-warning').text(formattedDateTime);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching device status:', error);
                }
            });
        }

        // Call the updateCard function initially
        updateCard('status-icon', 'device-status', 'device-name','last-active1', 'danger');
        updateCard('status-icon2', 'device-status2', 'device-name2','last-active2', 'primary');

        // Call the updateCard function every 5 seconds
        setInterval(function() {
            updateCard('status-icon', 'device-status', 'device-name','last-active1', 'danger');
            updateCard('status-icon2', 'device-status2', 'device-name2','last-active2', 'primary');
        }, 4000);
    });
    </script>
  </body>
</html>