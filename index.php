<?php
$page = "Dashboard";
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

<input type="hidden" id="serverId" value="<?php echo $_SESSION["userData"]["server"]["id"]; ?>" />
<script>
  $(document).ready(function() {
    var request1 = $.ajax({
      type: 'POST',
      url: './server/view.php',
      data: {'getDataFor': 'playerCount', serverId: $('#serverId').val()},
      dataType: 'json',
      async: true,
      success: function(response) {

        $('#playerCount').html((response.playerCount.success == false) ? 'Offline' : response.playerCount);
        $('#serverUptime').html((response.uptime.success == false) ? 'Offline' : response.uptime);

      }
    });

    $('a').click(function(e){
    	request1.abort();
    });
  });
</script>
<?php
require("footer.php");
?>