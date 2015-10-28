<?php
require("../../header.php");
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Player Profile</h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile" id="1stDiv" style="display: none;">
              <img class="profile-user-img img-responsive img-circle" id="playerImage" src="" alt="User profile picture">

              <h3 class="profile-username text-center" id="playerName"></h3>
              <p class="text-muted text-center" id="playerPower"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>IP</b> <a class="pull-right" id="playerIP"></a>
                </li>
                <li class="list-group-item">
                  <b>First seen</b> <a class="pull-right" id="playerFirstSeen"></a>
                </li>
                <li class="list-group-item">
                  <b>Last seen</b> <a class="pull-right" id="playerLastSeen"></a>
                </li>
                <li class="list-group-item">
                  <b>Play time</b> <a class="pull-right" id="playerPlayTime"></a>
                </li>
                <li class="list-group-item">
                  <b>Banned</b> <a class="pull-right" id="playerIsBanned"></a>
                </li>
                <li class="list-group-item" id="liPlayerBanTime" style="display:none">
                  <b>Banned until</b> <a class="pull-right" id="playerBanTime"></a>
                </li>
                <li class="list-group-item" id="liPlayerBanReason" style="display:none">
                  <b>Banned reason</b> <a class="pull-right" id="playerBanReason"></a>
                </li>
                <li class="list-group-item">
                  <b>Muted</b> <a class="pull-right" id="playerMuted"></a>
                </li>
                <li class="list-group-item" id="liPlayerMuteTime" style="display:none">
                  <b>Muted until</b> <a class="pull-right" id="playerMuteTime"></a>
                </li>
                <li class="list-group-item" id="liPlayerMuteReason" style="display:none">
                  <b>Muted reason</b> <a class="pull-right" id="playerMuteReason"></a>
                </li>
              </ul>
              <button class="btn btn-block" id="btnMuteUnmute" data-do=""></button>
              <button class="btn btn-block" id="btnBanUnBan" data-do=""></button>
              <button class="btn btn-primary btn-block" id="btnChangePower">Change power</button>
            </div>
            <div class="loading" id="loader-0"></div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
              <li><a href="#inventory" data-toggle="tab">Inventory</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content" id="2ndDiv" style="display: none;">
              <div class="active tab-pane" id="info">
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Money</h5>
                      <span class="description-text" id="playerMoney"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnAddMoney" class="btn btn-success form-control">Add money</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Email</h5>
                      <span class="description-text" id="playerEmail"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnChangeEmail" class="btn btn-primary form-control">Change email</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9">
                    <div class="description-block">
                      <h5 class="description-header">Cheated</h5>
                      <span class="description-text" id="playerCheated"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9">
                    <div class="description-block">
                      <h5 class="description-header">Mute count</h5>
                      <span class="description-text" id="playerMuteCount"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Kingdom</h5>
                      <span class="description-text" id="playerKingdom"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnChangeKingdom" class="btn btn-primary form-control">Change kingdom</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="inventory">

              </div>
              <!-- /.tab-pane -->

            </div>
            <div class="loading" id="loader-1"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <input type="hidden" id="txtWurmID" value="<?php echo $_GET['id']; ?>" />

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

  <script>
    $(document).ready(function() {
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {wurmID: $('#txtWurmID').val()},
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
              $('#playerImage').prop('src', response.image);
              $('#playerName').html(response.NAME);

              switch(response.POWER) {
                case '0':
                  $('#playerPower').html('Power: Player');
                  break;
                case '1':
                  $('#playerPower').html('Power: HERO');
                  break;
                case '2':
                  $('#playerPower').html('Power: GM');
                  break;
                case '3':
                  $('#playerPower').html('Power: High God');
                  break;
                case '4':
                  $('#playerPower').html('Power: Arch GM');
                  break;
                case '5':
                  $('#playerPower').html('Power: Implementor');
                  break;
                default:
                  $('#playerPower').html('Power: Unknown kingdom');
                  break;
              }

              $('#playerIP').html(response.IPADDRESS);
              $('#playerFirstSeen').html(response.CREATIONDATE);
              $('#playerLastSeen').html(response.LASTLOGOUT);
              $('#playerPlayTime').html(response.PLAYINGTIME);
              if(response.BANNED == 0) {
                $('#playerIsBanned').html('False');
                $('#btnBanUnBan').addClass('btn-danger');
                $('#btnBanUnBan').html('Ban');
                $('#btnBanUnBan').attr('data-do', "1");
              }
              else {
                $('#playerIsBanned').html('True');
                $('#playerBanTime').html(response.BANEXPIRY);
                $('#liPlayerBanTime').show();
                $('#playerBanReason').html(response.BANREASON);
                $('#liPlayerBanReason').show();
                $('#btnBanUnBan').addClass('btn-success');
                $('#btnBanUnBan').html('Unban');
                $('#btnBanUnBan').attr('data-do', "0");
              }

              if(response.MUTED == 0) {
                $('#playerMuted').html('False');
                $('#btnMuteUnmute').addClass('btn-danger');
                $('#btnMuteUnmute').html('Mute');
                $('#btnMuteUnmute').attr('data-do', "1");
              }
              else {
                $('#playerMuted').html('True');
                $('#playerMuteTime').html(response.MUTEEXPIRY);
                $('#liPlayerMuteTime').show();
                $('#playerMuteReason').html(response.MUTEREASON);
                $('#liPlayerMuteReason').show();
                $('#btnMuteUnmute').addClass('btn-success');
                $('#btnMuteUnmute').html('Unmute');
                $('#btnMuteUnmute').attr('data-do', "0");
              }

              /**
               * Right col
               */
              $('#playerMoney').html(response.MONEY);
              $('#playerEmail').html(response.EMAIL);

              if(response.CHEATED == 0) {
                $('#playerCheated').html('False');
              }
              else {
                $('#playerCheated').html('True: ' + response.CHEATREASON);
              }

              $('#playerMuteCount').html(response.MUTETIMES);

              switch(response.KINGDOM) {
                case '0':
                  $('#playerKingdom').html('Freedom');
                  break;
                case '1':
                  $('#playerKingdom').html('Jenn-Kellon');
                  break;
                case '2':
                  $('#playerKingdom').html('Mol-Rehan');
                  break;
                case '3':
                  $('#playerKingdom').html('Horde of the Summoned');
                  break;
                default:
                  $('#playerKingdom').html('Unknown kingdom');
                  break;
              }

            }
            else {
              swal("Error!", "Could not load this player", "error");
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

      $('#btnBanUnBan').on('click', function(e) {
        var wurmID = $('#txtWurmID').val();
        var action = $('#btnBanUnBan').data('do');

        if(action == 1) {
          $('#modalBan').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "banFunction", action: action, wurmID: wurmID},
            dataType: 'json',
            beforeSend: function() {
              $('#btnBanUnBan').prop('disabled', true);
              $('#btnBanUnBan').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
            },
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
                swal("Unbanned!", "This player has been unbanned!", "success");
                $('#playerIsBanned').html('False');
                $('#btnBanUnBan').addClass('btn-danger');
                $('#btnBanUnBan').html('Ban');
                $('#btnBanUnBan').attr('data-do', "1");
                $('#liPlayerBanTime').hide();
                $('#liPlayerBanReason').hide();
              }
              else {
                swal("Failed to ban!", "We could not proccess this request at this time.", "error");
              }

              $('#btnBanUnBan').prop('disabled', false);

            },
            error: function(error) {
              console.log(error);
              swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
              $('#btnBanUnBan').prop('disabled', false);
            }
          });
        }

      });
      $('#formBanPlayer').on('submit', function(e) {
        e.preventDefault();
        var wurmID = $('#txtWurmID').val();
        var banDays = $('#txtBanDays').val();
        var banReason = $('#txtBanReason').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "banFunction", action: $('#btnBanUnBan').data('do'), wurmID: wurmID, banDays: banDays, banReason: banReason},
          dataType: 'json',
          beforeSend: function() {
            $('#modalBanLoader').show();
            $('#formBanPlayer').hide();
          },
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
              if($('#modalBan').modal('hide')) {
                swal("Banned!", "This player has been banned!", "success");
                $('#playerIsBanned').html('True');
                $('#playerBanTime').html(response.BANEXPIRY);
                $('#liPlayerBanTime').show();
                $('#playerBanReason').html(banReason);
                $('#liPlayerBanReason').show();

                $('#btnBanUnBan').removeClass('btn-danger');
                $('#btnBanUnBan').addClass('btn-success');
                $('#btnBanUnBan').html('Unban');
                $('#btnBanUnBan').attr('data-do', "0");
              }

            }
            else {
              swal("Failed to ban!", "We could not proccess this request at this time.", "error");
            }

          },
          error: function(error) {
            console.log(error);
            $('#modalBan').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });
      
      });

      $('#btnMuteUnmute').on('click', function(e) {
        var wurmID = $('#txtWurmID').val();
        var action = $('#btnMuteUnmute').data('do');

        if(action == 1) {
          $('#modalMute').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "muteFunction", action: action, wurmID: wurmID},
            dataType: 'json',
            beforeSend: function() {
              $('#btnMuteUnmute').prop('disabled', true);
              $('#btnMuteUnmute').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
            },
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
                swal("Unmuted!", "This player has been unmuted!", "success");
                $('#playerMuted').html('False');
                $('#btnMuteUnmute').addClass('btn-danger');
                $('#btnMuteUnmute').html('Mute');
                $('#btnMuteUnmute').attr('data-do', "1");
                $('#liPlayerMuteTime').hide();
                $('#liPlayerMuteReason').hide();
              }
              else {
                swal("Failed to unmute!", "We could not proccess this request at this time.", "error");
              }

              $('#btnMuteUnmute').prop('disabled', false);

            },
            error: function(error) {
              console.log(error);
              swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
              $('#btnMuteUnmute').prop('disabled', false);
            }
          });
        }

      });
      $('#formMutePlayer').on('submit', function(e) {
        e.preventDefault();
        var wurmID = $('#txtWurmID').val();
        var muteHours = $('#txtMuteHours').val();
        var muteReason = $('#txtMuteReason').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "muteFunction", action: $('#btnMuteUnmute').data('do'), wurmID: wurmID, muteHours: muteHours, muteReason: muteReason},
          dataType: 'json',
          beforeSend: function() {
            $('#modalMuteLoader').show();
            $('#formMutePlayer').hide();
          },
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
              if($('#modalMute').modal('hide')) {
                swal("Muted!", "This player has been muted!", "success");
                $('#playerMuted').html('True');
                $('#playerMuteTime').html(response.MUTEEXPIRY);
                $('#liPlayerMuteTime').show();
                $('#playerMuteReason').html(muteReason);
                $('#liPlayerMuteReason').show();

                $('#btnMuteUnmute').removeClass('btn-danger');
                $('#btnMuteUnmute').addClass('btn-success');
                $('#btnMuteUnmute').html('Unmute');
                $('#btnMuteUnmute').attr('data-do', "0");
              }

            }
            else {
              swal("Failed to mute!", "We could not proccess this request at this time.", "error");
            }

          },
          error: function(error) {
            console.log(error);
            $('#modalMute').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });
      
      });
      
    });
  </script>

<?php
require("../../footer.php");
?>