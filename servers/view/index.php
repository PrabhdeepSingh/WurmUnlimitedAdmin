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
            </div>
            <div class="box-body" id="loader-1">
              <div class="loading"></div>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </div>

  <div class="modal" id="modalBan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Ban player</h4>
        </div>
        <div class="modal-body" id="modalBanLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formBanPlayer">
          <div class="modal-body">
            <div class="form-group">
              <label>How many days?</label>
              <input type="number" class="form-control" id="txtBanDays" placeholder="Enter how many days to ban player" />
            </div>
            <div class="form-group">
              <label>Reason</label>
              <input type="text" class="form-control" id="txtBanReason" placeholder="Reason for ban" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Ban!</button>
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
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              /**
               * Left col
               */
              $('#serverName').html(response.NAME);
              $('#playerCount').html(response.COUNT + '/' + response.MAXPLAYERS);

              $('#serverUptime').html(response.UPTIME);

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

    });
  </script>

<?php
require("../../footer.php");
?>