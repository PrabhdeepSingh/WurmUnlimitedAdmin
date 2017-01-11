<?php
$page = "server";
$rootPath = "..";
require("../header.php");
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Server</h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box min-height box-danger" id="boxServer">
            <div class="box-body box-profile">
              <div class="profile-user-img" style="border: 0;"><i class="fa fa-server fa-5x"></i></div>

              <h3 class="profile-username text-center" id="serverName"><?php echo $_SESSION["userData"]["server"]["name"]; ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Online players</b> <a class="pull-right" id="playerCount"></a>
                </li>
                <li class="list-group-item">
                  <b>Uptime</b> <a class="pull-right" id="serverUptime"></a>
                </li>
              </ul>
              <button class="btn btn-danger btn-block" id="btnShutDown">Shutdown Server</button>
            </div>
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>

          </div>

          <div class="box min-height box-danger" id="boxBroadcastMessage">
            <div class="box-header with-border">
              <h3 class="box-title">Broadcast message</h3>
            </div>
            <div class="box-body">
              <textarea id="txtBroadcastMessage" class="form-control"></textarea><br />
              <button id="btnBroadcastMessage" class="btn btn-primary form-control">Send broadcast</button>
            </div>
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="box min-height box-danger" id="boxServerInfo">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Game mode</h5>
                    <span class="description-text" id="serverGameMode"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <button id="btnChangeGameMode" class="btn btn-primary form-control" disabled>Change game mode</button>
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
                    <button id="btnChangeCluster" class="btn btn-primary form-control" disabled>Change cluster</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Is home server</h5>
                    <span class="description-text" id="serverHomeServer"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <button id="btnChangeHomeServer" class="btn btn-primary form-control" disabled>Change home server</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Home server kingdom</h5>
                    <span class="description-text" id="serverKingdom"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <button id="btnChangeServerKingdom" class="btn btn-primary form-control" disabled>Change server kingdom</button>
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
                    <button id="btnChangeWurmTime" class="btn btn-primary form-control" disabled>Change wurm time</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Player limit</h5>
                    <span class="description-text" id="serverPlayerLimit"></span>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="description-block">
                    <button id="btnChangePlayerLimit" class="btn btn-primary form-control" disabled>Change player limit</button>
                  </div>
                </div>
              </div>

            </div>
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
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
  
  <script>
    $(document).ready(function() {
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {'getDataFor': 'playerCount'},
          dataType: 'json',
          async: true,
          success: function(response) {
            /**
             * Left col
             */
            $('#playerCount').html((response.playerCount.success == false) ? 'Offline' : response.playerCount);
            $('#serverUptime').html((response.uptime.success == false) ? 'Offline' : response.uptime);

            if(response.uptime.success == false) {
              $('#btnShutDown').prop('disabled', true);
              $('#btnBroadcastMessage').prop('disabled', true);
              $('#btnChangeGameMode').prop('disabled', false);
              $('#btnChangeCluster').prop('disabled', false);
              $('#btnChangeHomeServer').prop('disabled', false);
              $('#btnChangeServerKingdom').prop('disabled', false);
              $('#btnChangeWurmTime').prop('disabled', false);
              $('#btnChangePlayerLimit').prop('disabled', false);
            }

            $('#boxServer .overlay').remove();
            $('#boxBroadcastMessage .overlay').remove();

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });

        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {'getDataFor': 'serverInfo'},
          dataType: 'json',
          async: true,
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

              if(response.HOMESERVER == 1) {
                $('#serverHomeServer').html('Yes');
              }
              else {
                $('#serverHomeServer').html('No');
              }

              switch(response.KINGDOM) {
                case '0':
                  $('#serverKingdom').html('No kingdom');
                  break;
                case '1':
                  $('#serverKingdom').html('Jenn-Kellon');
                  break;
                case '2':
                  $('#serverKingdom').html('Mol Rehan');
                  break;
                case '3':
                  $('#serverKingdom').html('Horde of the Summoned');
                  break;
                case '4':
                  $('#serverKingdom').html('Freedom Isles');
                  break;
                default:
                  $('#serverKingdom').html('Unknown kingdom');
                  break;
              }

              $('#serverPlayerLimit').html(response.MAXPLAYERS);

              $('#serverWurmTime').html((response.WURMTIME.success == false) ? 'Offline' : response.WURMTIME);

            }
            else {
              swal("Error!", "Could not load this server", "error");
            }

            $('#boxServerInfo .overlay').remove();

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
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
            $('#txtBroadcastMessage').val('');

          },
          error: function(error) {
            console.log(error);
            swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
            $('#btnBroadcastMessage').prop('disabled', false);
            $('#btnBroadcastMessage').html('Send broadcast');
          }
        });

      });

      $('#btnChangeGameMode').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Change game mode',
          text: '<select id="txtGameMode" class="form-control"><option value="0">PVE</option><option value="1">PVP</option></select>',
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
            var newGameMode = $('#txtGameMode').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeGameMode", newGameMode: newGameMode, serverID: serverID},
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
                  var txtGameMode = "";
                  switch(newGameMode) {
                    case '0':
                      txtGameMode = 'PVE';
                      break;
                    case '1':
                      txtGameMode = 'PVP';
                      break;
                    default:
                      txtGameMode = 'Unknown game mode';
                      break;
                  }
                  swal('Game mode changed!', 'The game mode for this server has been changed to [ ' + txtGameMode + ' ]!', 'success');
                  $('#serverGameMode').html(txtGameMode);
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

      $('#btnChangeCluster').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Change game cluster',
          text: '<select id="txtGameCluster" class="form-control"><option value="0">Freedom</option><option value="1">EPIC</option></select>',
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
            var newGameCluster = $('#txtGameCluster').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeGameCluster", newGameCluster: newGameCluster, serverID: serverID},
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
                  var txtGameCluster = "";
                  switch(newGameCluster) {
                    case '0':
                      txtGameCluster = 'Freedom';
                      break;
                    case '1':
                      txtGameCluster = 'Epic';
                      break;
                    default:
                      txtGameCluster = 'Unknown game cluster';
                      break;
                  }
                  swal('Game cluster changed!', 'The game cluster for this server has been changed to [ ' + txtGameCluster + ' ]!', 'success');
                  $('#serverCluster').html(txtGameCluster);
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

      $('#btnChangeHomeServer').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Is home server?',
          text: '<select id="txtHomeServer" class="form-control"><option value="1">Yes</option><option value="0">No</option></select>',
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
            var homeServer = $('#txtHomeServer').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeHomeServer", homeServer: homeServer, serverID: serverID},
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
                  var txtHomeServer = "";
                  switch(homeServer) {
                    case '0':
                      txtHomeServer = 'No';
                      break;
                    case '1':
                      txtHomeServer = 'Yes';
                      break;
                    default:
                      txtHomeServer = 'Unknown home server setting';
                      break;
                  }
                  swal('Home server changed!', 'The home server setting for this server has been changed to [ ' + txtHomeServer + ' ]!', 'success');
                  $('#serverHomeServer').html(txtHomeServer);
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

      $('#btnChangeServerKingdom').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Change home server kingdom',
          text: '<select id="txtHomeServerKingdom" class="form-control"><option value="0">No kingdom</option><option value="1">Jenn-Kellon</option><option value="2">Mol Rehan</option><option value="3">Horde of the Summoned</option><option value="4">Freedom Isles</option></select>',
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
            var homeServerKingdom = $('#txtHomeServerKingdom').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeHomeServerKingdom", homeServerKingdom: homeServerKingdom, serverID: serverID},
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
                  var txtHomeServerKingdom = "";
                  switch(homeServerKingdom) {
                    case '0':
                      txtHomeServerKingdom = 'No kingdom';
                      break;
                    case '1':
                      txtHomeServerKingdom = 'Jenn-Kellon';
                      break;
                    case '2':
                      txtHomeServerKingdom = 'Mol Rehan';
                      break;
                    case '3':
                      txtHomeServerKingdom = 'Horde of the Summoned';
                      break;
                    case '4':
                      txtHomeServerKingdom = 'Freedom Isles';
                      break;
                    default:
                      txtHomeServerKingdom = 'Unknown kingdom';
                      break;
                  }
                  swal('Home server kingdom changed!', 'The default kingdom for this server has been changed to [ ' + txtHomeServerKingdom + ' ]!', 'success');
                  $('#serverKingdom').html(txtHomeServerKingdom);
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

      $('#btnChangeWurmTime').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Change wurm time',
          text: 'Change the world time of this server',
          type: 'input',
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(inputValue) {
          if(inputValue === false || inputValue === "" || inputValue == 0) {
            swal.showInputError("You need to write a number and has to be greater than 0!");
            return false;
          }
          else {
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeWurmTIme", newWurmTime: inputValue, serverID: serverID},
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
                  swal('Wurm time changed!', 'The new world time for this server has been changed to [ ' + inputValue + ' ]!', 'success');
                  $('#serverWurmTime').html(inputValue);
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

      $('#btnChangePlayerLimit').on('click', function(e) {
        e.preventDefault();
        swal({
          title: 'Change max players',
          text: 'Change the max number of players that can be on this server',
          type: 'input',
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(inputValue) {
          if(inputValue === false || inputValue === "" || inputValue == 0) {
            swal.showInputError("You need to write a number and has to be greater than 0!");
            return false;
          }
          else {
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changePlayerLimit", newPlayerLimit: inputValue, serverID: serverID},
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
                  swal('Player limited changed!', 'The new player limit for this server has been changed to [ ' + inputValue + ' ]!', 'success');
                  $('#serverPlayerLimit').html(inputValue);
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

    });
  </script>

<?php
require("../footer.php");
?>