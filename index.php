<?php
$page = "Dashboard";
$rootPath = ".";
require("header.php");
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

    	<div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Uptime</span>
            <span class="info-box-number" id="serverUptime"><i class="fa fa-refresh fa-spin"></i></span>
          </div>
          <!-- /.info-box-content -->
        </div>

        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Players Online</span>
            <span class="info-box-number" id="playerCount"><i class="fa fa-refresh fa-spin"></i></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">New Tickets</span>
            <span class="info-box-number" id="ticketCount"><i class="fa fa-refresh fa-spin"></i></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>
  </section>
</div>

<script>
  $(document).ready(function() {
    $.ajax({
      type: 'POST',
      url: 'dashboard.php',
      data: {},
      dataType: 'json',
      success: function(response) {

        $('#playerCount').html((response.playerCount.success == false) ? 'Offline' : response.playerCount);
        $('#serverUptime').html((response.uptime.success == false) ? 'Offline' : response.uptime);
        $('#ticketCount').html(response.activeTickets);

      }
    });
  });
</script>
<?php
require("footer.php");
?>