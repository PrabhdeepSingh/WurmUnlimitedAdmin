<?php
$page = "server";
require("../../header.php");
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Server</h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-danger">
            <div class="box-body box-profile" id="1stDiv" style="display: none;">
              <div class="profile-user-img" style="border: 0;"><i class="fa fa-server fa-5x"></i></div>

              <h3 class="profile-username text-center" id="serverName"></h3>
              <p class="text-muted text-center" id="playerCount"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Uptime</b> <a class="pull-right" id="serverUptime"></a>
                </li>
              </ul>
              <button class="btn btn-danger btn-block" id="btnShutDown">Shutdown Server</button>
            </div>
            <div class="loading" id="loader-0"></div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="box box-danger">
            <div class="box-body" id="2ndDiv" style="display: none;">
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Game mode</h5>
                    <span class="description-text" id="serverGameMode"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <a id="btnChangeGameMode" class="btn btn-primary form-control">Change game mode</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Cluster</h5>
                    <span class="description-text" id="serverCluster"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <a id="btnChangeCluster" class="btn btn-primary form-control">Change cluster</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Wurm time</h5>
                    <span class="description-text" id="serverWurmTime"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <a id="btnChangeWurmTime" class="btn btn-primary form-control">Change wurm time</a>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Broadcast Message</h5>
                    <input type="text" class="form-control" id="txtBroadcastMessage" />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <a id="btnBroadcastMessage" class="btn btn-primary form-control">Send broadcast</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body" id="loader-1">
              <div class="loading"></div>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>

  <div class="modal" id="modalShutdown" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Shutdown Server</h4>
        </div>
        <div class="modal-body" id="modalShutdownLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formShutdown">
          <div class="modal-body">
            <div class="form-group">
              <label>How many seconds until shutdown?</label>
              <input type="number" class="form-control" id="txtShutdownSeconds" placeholder="Enter how many seconds until server shuts down" />
            </div>
            <div class="form-group">
              <label>Reason</label>
              <input type="text" class="form-control" id="txtShutdownReason" placeholder="Reason for shutdown" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Shutdown!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal" id="modalMute" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Mute player</h4>
        </div>
        <div class="modal-body" id="modalMuteLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formMutePlayer">
          <div class="modal-body">
            <div class="form-group">
              <label>How many hours?</label>
              <input type="number" class="form-control" id="txtMuteHours" placeholder="Enter how many hours to mute player" />
            </div>
            <div class="form-group">
              <label>Reason</label>
              <input type="text" class="form-control" id="txtMuteReason" placeholder="Reason for mute" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Mute!</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <input type="hidden" id="txtServerID" value="<?php echo $_GET['id']; ?>" />

  <script>
    $(document).ready(function() {
      var serverID = $('#txtServerID').val();
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {serverID: serverID},
          dataType: 'json',
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the server database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              console.log(response);
              /**
               * Left col
               */
              $('#serverName').html(response.NAME);
              $('#playerCount').html((response.COUNT.success == false) ? 'Offline' : response.COUNT + '/' + response.MAXPLAYERS);
              $('#serverUptime').html((response.UPTIME.success == false) ? 'Offline' : response.UPTIME);

              if(response.COUNT.success == false) {
                $('#btnShutDown').prop('disabled', true);
              }

              /**
               * Right col
               */
              if(response.PVP == 1) {
                $('#serverGameMode').html('PVP');
              }
              else {
                $('#serverGameMode').html('PVE');
              }

              if(response.EPIC == 1) {
                $('#serverCluster').html('EPIC');
              }
              else {
                $('#serverCluster').html('FREEDOM');
              }

              $('#serverWurmTime').html((response.WURMTIME.success == false) ? 'Offline' : response.WURMTIME);

            }
            else {
              swal("Error!", "Could not load this server", "error");
            }

            $('#1stDiv').show();
            $('#2ndDiv').show();
            $('#loader-0').hide();
            $('#loader-1').hide();

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#userList').show();
            $('#loader').hide();
          }
        });
      
      }

      $('#btnShutDown').on('click', function(e) {
        e.preventDefault();
        $('#modalShutdown').modal('show');
      
      });

      $('#formShutdown').on('submit', function(e) {
        e.preventDefault();

        var seconds = $('#txtShutdownSeconds').val();
        var reason = $('#txtShutdownReason').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "shutdown", seconds: seconds, reason: reason},
          dataType: 'json',
          beforeSend: function() {
            $('#formShutdown').hide();
            $('#modalShutdownLoader').show();
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the server database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              swal('Sent!', 'Shutdown request has been sent!', 'success');
              $('#txtBroadcastMessage').val('');
              $('#modalShutdown').modal('hide');
            }
            else {
              swal('Failed to send!', 'We could not proccess this request at this time.', 'error');
            }

            $('#formShutdown').show();
            $('#modalShutdownLoader').hide();

          },
          error: function(error) {
            console.log(error);
            swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
            $('#formShutdown').show();
            $('#modalShutdownLoader').hide();
          }
        });

      });

      $('#btnBroadcastMessage').on('click', function(e) {
        e.preventDefault();
        var message = $('#txtBroadcastMessage').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "broadcast", message: message},
          dataType: 'json',
          beforeSend: function() {
            $('#btnBroadcastMessage').prop('disabled', true);
            $('#btnBroadcastMessage').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the server database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              swal('Sent!', 'The broadcast message was successfully sent!', 'success');
              $('#txtBroadcastMessage').val('');
            }
            else {
              swal('Failed to send!', 'We could not proccess this request at this time.', 'error');
            }

            $('#btnBroadcastMessage').prop('disabled', false);
            $('#btnBroadcastMessage').html('Send broadcast');

          },
          error: function(error) {
            console.log(error);
            swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
            $('#btnBroadcastMessage').prop('disabled', false);
            $('#btnBroadcastMessage').html('Send broadcast');
          }
        });
      
      });

    });
  </script>

<?php
require("../../footer.php");
?>