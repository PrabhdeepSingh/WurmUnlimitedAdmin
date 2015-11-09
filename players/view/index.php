<?php
$page = "player";
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
              <li><a href="#inventory" data-toggle="tab" onclick="$('#btnRefreshInventory').trigger('click');">Inventory</a></li>
              <li><a href="#skills" data-toggle="tab" onclick="$('#btnRefreshSkills').trigger('click');">Skills</a></li>
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
              <div class="tab-pane" id="inventory">
                <div class="box no-border">
                  <div class="box-header">
                    <h3 class="box-title">Player Inventory</h3>

                    <div class="box-tools">
                      <a href="#" class="btn btn-success" onclick="$('#modalAddItem').modal('show');">Add item</a>
                      <a href="#" class="btn btn-primary" id="btnRefreshInventory">Refresh inventory</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                    <div class="row" id="invFirstLoad">
                      <div class="col-md-12"><div class="text-center"><h3>Please click on 'Refresh invenory' button on the top right</h3></div></div>
                    </div>
                    <table class="table table-hover" id="tableInventory" style="display: none;">
                      <thead>
                        <th></th>
                        <th>Item</th>
                        <th>Rarity</th>
                        <th>Orginal Quality</th>
                        <th>Quality</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <div class="tab-pane" id="skills">
                <div class="box no-border">
                  <div class="box-header">
                    <h3 class="box-title">Player Skills</h3>

                    <div class="box-tools">
                      <a href="#" class="btn btn-primary" id="btnRefreshSkills">Refresh skills</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                    <div class="row" id="skillsFirstLoad">
                      <div class="col-md-12"><div class="text-center"><h3>Please click on 'Refresh skills' button on the top right</h3></div></div>
                    </div>
                    <table class="table table-hover" id="tableSkills" style="display: none;">
                      <thead>
                        <th>Skill</th>
                        <th>Min Value</th>
                        <th>Current Value</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>
            <div class="loading" id="loader-1"></div>
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
  <div class="modal" id="modalAddItem" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Add item</h4>
        </div>
        <div class="modal-body" id="modalAddItemLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formAddItem">
          <div class="modal-body">
            <div class="form-group">
              <label>Item to give</label>
              <input type="number" class="form-control" id="txtItemID" placeholder="Enter how many hours to mute player" />
            </div>
            <div class="form-group">
              <label>Quality</label>
              <input type="text" class="form-control" id="txtItemQuality" placeholder="Item quality" />
            </div>
            <div class="form-group">
              <label>Rarity</label>
              <select class="form-control" id="txtItemRarity">
                <option value="0">Common</option>
                <option value="1">Rare</option>
                <option value="2">Supreme</option>
                <option value="3">Fantastic</option>
              </select>
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="txtItemAmount" value="1" placeholder="How many to give" />
            </div>
            <div class="form-group">
              <label>Creator</label>
              <input type="text" class="form-control" id="txtItemCreator" value="<?php echo $userData['username']; ?>" placeholder="Creator of the item" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add!</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <input type="hidden" id="txtWurmID" value="<?php echo $_GET['id']; ?>" />

  <script>
    $(document).ready(function() {
      var wurmID = $('#txtWurmID').val();
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {wurmID: wurmID},
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
        e.preventDefault();

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
        e.preventDefault();

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
                $('#btnMuteUnmute').attr('data-do', '1');
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

      $('#btnChangePower').on('click', function(e) {
        swal({
          title: 'Change player power',
          text: '<select id="txtPower" class="form-control"><option value="0">Player</option><option value="1">HERO</option><option value="2">GM</option><option value="3">High God</option><option value="4">Arch GM</option><option value="5">Implementor</option></select>',
          html: true,
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(isConfirm) {
          if(isConfirm) {
            var tempPower = $('#txtPower').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changePower", power: tempPower, wurmID: wurmID},
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
                  var textPower = "";
                  switch(tempPower) {
                    case '0':
                      textPower = 'Player';
                      break;
                    case '1':
                      textPower = 'HERO';
                      break;
                    case '2':
                      textPower = 'GM';
                      break;
                    case '3':
                      textPower = 'High God';
                      break;
                    case '4':
                      textPower = 'Arch GM';
                      break;
                    case '5':
                      textPower = 'Implementor';
                      break;
                    default:
                      textPower = 'Unknown power';
                      break;
                  }
                  swal('Power changed!', 'The powers for this player has been changed to [ ' + textPower + ' ]!', 'success');
                  $('#playerPower').html('Power: ' + textPower);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
          }
        });

      });

      $('#btnAddMoney').on('click', function(e) {
        e.preventDefault();

        swal({
          title: 'Add money',
          text: 'Enter the amount of money to add to players bank in IRON coins ( 10000 = 1 silver, 1000000 = 1 gold):',
          type: 'input',
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          inputPlaceholder: 'Enter money in IRON coins'
        }, function(money) {
          if (money === false || money === '') {
            swal.showInputError('You need to write something!');
            return false
          }
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "addMoney", money: money, wurmID: wurmID},
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
                  swal('Money added!', '[ ' + response.money + ' ] was added to the players bank!', 'success');
                  $('#playerMoney').html(response.totalMoney);
                }
                else {
                  swal('Failed to add!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
        });

      });

      $('#btnChangeEmail').on('click', function(e) {
        e.preventDefault();

        swal({
          title: 'Add email',
          text: 'Enter a new email address for this user:',
          type: 'input',
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          inputPlaceholder: 'Email address'
        }, function(email) {
          if (email === false || email === '') {
            swal.showInputError('You need to write something!');
            return false
          }
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeEmail", email: email, wurmID: wurmID},
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
                  swal('Changed!', 'The players new email is [ ' + email + ' ]!', 'success');
                  $('#playerEmail').html(email);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
        });

      });

      $('#btnChangeKingdom').on('click', function(e) {
        swal({
          title: 'Change player kingdom',
          text: '<select id="txtKingdom" class="form-control"><option value="0">Freedom</option><option value="1">Jenn-Kellon</option><option value="2">Mol-Rehan</option><option value="3">Horde of the Summoned</option></select>',
          html: true,
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(isConfirm) {
          if(isConfirm) {
            var tempKingdom = $('#txtKingdom').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeKingdom", kingdom: tempKingdom, wurmID: wurmID},
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
                  var textKingdom = "";
                  switch(tempKingdom) {
                    case '0':
                      textKingdom = 'Freedom';
                      break;
                    case '1':
                      textKingdom = 'Jenn-Kellon';
                      break;
                    case '2':
                      textKingdom = 'Mol-Rehan';
                      break;
                    case '3':
                      textKingdom = 'Horde of the Summoned';
                      break;
                    default:
                      textKingdom = 'Unknown kingdom';
                      break;
                  }
                  swal('Kingdom changed!', 'The players kingdom has been changed to [ ' + textKingdom + ' ]!', 'success');
                  $('#playerKingdom').html(textKingdom);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
          }
        });

      });

      $('#btnRefreshInventory').on('click', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "getInventory", playerID: wurmID},
          dataType: 'json',
          beforeSend: function() {
            $('#btnRefreshInventory').prop('disabled', true);
            $('#btnRefreshInventory').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
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
            else {
              console.log(response);
              var html = '';
              for(var i = 0; i < response.length; i++)
              {
                var rarity = '';
                switch(response[i].RARITY) {
                  case '0':
                    rarity = 'Normal';
                    break;
                  case '1':
                    rarity = '<font color="#3D79AB">Rare</font>';
                    break;
                  case '2':
                    rarity = '<font color="#00FFFF">Supreme</font>';
                    break;
                  case '3':
                    rarity = '<font color="#F809FC">Fantastic</font>';
                    break;
                  default:
                    rarity = 'Unknown';
                    break;
                }
                html += '<tr><td><input type="checkbox" /></td><td>' + response[i].NAME + '</td><td>' + rarity + '</td><td>' + response[i].ORIGINALQUALITYLEVEL + '</td><td>' + response[i].QUALITYLEVEL + '</td></tr>';
              }
              $('#tableInventory tbody').html(html);

              $('#invFirstLoad').hide();
              $('#tableInventory').show();
            }

            $('#btnRefreshInventory').prop('disabled', false);
            $('#btnRefreshInventory').html('Refresh inventory');


          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#btnRefreshInventory').prop('disabled', false);
            $('#btnRefreshInventory').html('Refresh inventory');
          }
        });

      });

      $('#formAddItem').on('submit', function(e) {
        e.preventDefault();

        var itemID = $('#txtItemID').val();
        var itemQuality = $('#txtItemQuality').val();
        var itemRarity = $('#txtItemRarity').val();
        var itemAmount = $('#txtItemAmount').val();
        var itemCreator = $('#txtItemCreator').val();
        
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "addItem", wurmID: wurmID, itemTemplateID: itemID, itemQuality: itemQuality, itemRarity: itemRarity, creator: itemCreator, itemAmount: itemAmount},
          dataType: 'json',
          beforeSend: function() {
            $('#modalAddItemLoader').show();
            $('#formAddItem').hide();
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
              if($('#modalAddItem').modal('hide')) {
                swal("Added!", "The item has been added to the players inventory!", "success");
              }

            }
            else {
              swal("Failed to add!", "We could not proccess this request at this time.", "error");
            }

            $('#modalAddItemLoader').hide();
            $('#formAddItem').show();

          },
          error: function(error) {
            console.log(error);
            $('#modalAddItem').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#modalAddItemLoader').hide();
            $('#formAddItem').show();
          }
        });
      });

      $('#btnRefreshSkills').on('click', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "getSkills", playerID: wurmID},
          dataType: 'json',
          beforeSend: function() {
            $('#btnRefreshSkills').prop('disabled', true);
            $('#btnRefreshSkills').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
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
            else {
              var html = '';
              for(var i = 0; i < response.length; i++)
              {
                html += '<tr><td>' + response[i].NAME + '</td><td>' + response[i].MINVALUE + '</td><td>' + response[i].VALUE + '</td></tr>';
              }
              $('#tableSkills tbody').html(html);

              $('#skillsFirstLoad').hide();
              $('#tableSkills').show();
            }

            $('#btnRefreshSkills').prop('disabled', false);
            $('#btnRefreshSkills').html('Refresh skills');


          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#btnRefreshSkills').prop('disabled', false);
            $('#btnRefreshSkills').html('Refresh skills');
          }
        });

      });

    });
  </script>

<?php
require("../../footer.php");
?>