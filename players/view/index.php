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
                  <b>Play Time</b> <a class="pull-right" id="playerPlayTime"></a>
                </li>
                <li class="list-group-item">
                  <b>Banned</b> <a class="pull-right" id="playerIsBanned"></a>
                </li>
              </ul>

              <button class="btn btn-block" id="btnBanUnBan" data-do=""></button>
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
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item text-lg" style="height:54px;">
                    <div class="col-md-1"><b>Money:</b></div>
                    <div class="col-md-4"><a id="playerMoney"></a></div>
                    <div class="col-md-3 pull-right"><a id="btnAddMoney" class="btn btn-primary form-control" style="margin-top:-3px;">Add money</a></div>
                  </li>
                  <li class="list-group-item text-lg" style="height:54px;">
                    <div class="col-md-1"><b>Email:</b></div>
                    <div class="col-md-4"><a id="playerEmail"></a></div>
                    <div class="col-md-3 pull-right"><a id="btnChangeEmail" class="btn btn-primary form-control" style="margin-top:-3px;">Change email</a></div>
                  </li>
                  <li class="list-group-item text-lg" style="height:54px;">
                    <div class="col-md-1"><b>Cheated:</b></div>
                    <div class="col-md-4"><a id="playerCheated"></a></div>
                  </li>
                  <li class="list-group-item text-lg" style="height:54px;">
                    <div class="col-md-1"><b>Kingdom:</b></div>
                    <div class="col-md-4"><a id="playerKingdom"></a></div>
                  </li>
                  <li class="list-group-item text-lg" style="height: 54px;">
                    <div class="col-md-1"><b>Power: </b></div>
                    <div class="col-md-4"><select id="txtPower" class="form-control">
                      <option value="0">Player</option>
                      <option value="1">HERO</option>
                      <option value="2">GM</option>
                      <option value="3">High God</option>
                      <option value="4">Arch GM</option>
                      <option value="5">Implementor</option>
                    </select></div>
                    <div class="col-md-3 pull-right"><a id="btnChangePower" class="btn btn-primary form-control" style="margin-top:-3px;" style="margin-top:-3px;">Update power</a></div>
                  </li>
                </ul>
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
  <script>
    $(document).ready(function() {
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
            $('#playerPower').html('Power: ' + response.POWER);
            $('#playerIP').html(response.IPADDRESS);
            $('#playerFirstSeen').html(new Date(response.CREATIONDATE).toLocaleString());
            $('#playerLastSeen').html(new Date(response.LASTLOGOUT).toLocaleString());
            $('#playerPlayTime').html(response.PLAYINGTIME);
            if(response.BANNED == 0) {
              $('#playerIsBanned').html('False');
              $('#btnBanUnBan').addClass('btn-danger');
              $('#btnBanUnBan').html('Ban');
              $('#btnBanUnBan').attr('data-do', "1");
            }
            else {
              $('#playerIsBanned').html('True: ' + response.BANREASON);
              $('#btnBanUnBan').addClass('btn-success');
              $('#btnBanUnBan').html('Unban');
              $('#btnBanUnBan').attr('data-do', "0");
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
              case '4':
                $('#playerKingdom').html('Horde of the Summoned');
                break;
              default:
                $('#playerKingdom').html('Unknown kingdom');
                break;
            }
            $('#txtPower').val(response.POWER);

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
    });
  </script>

<?php
require("../../footer.php");
?>