<?php
$page = "player";
$rootPath = "..";
require("../header.php");
?>
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-primary" id="divUserList">
                <div class="box-header with-border">
                  <h3 class="box-title">Players</h3>
                  <div class="box-tools pull-right">
                    <input type="text" name="message" placeholder="Search ..." class="form-control search" />
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="loading" id="loader"></div>
                  <ul class="users-list clearfix list" id="userList" style="display: none;">
                  </ul>
                  <!-- /.users-list -->
                </div>
              </div>
              <!--/.box -->
            </div>
          </div>
        </section>
      </div>
      
      <script src="<?php echo $rootPath; ?>/assets/vendors/listjs/list.min.js"></script>

      <input type="hidden" id="serverId" value="<?php echo $_SESSION["userData"]["server"]["id"]; ?>" />
      <script>
        $(document).ready(function() {
          $.ajax({
            type: 'POST',
            url: 'player.php',
            data: {serverId: $('#serverId').val()},
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
              else
              {
                if(response.length > 0) {
                  var html = '';
                  for(var i = 0; i < response.length; i++) {
                    html += '<li><img src="../assets/images/avatars/' + response[i].image + '" alt="User Image" onclick="location.href = \'./view/?id=' + response[i].WURMID + '\'" style="cursor: pointer;"><a class="users-list-name" href="./view/?id=' + response[i].WURMID + '">' + response[i].NAME + '</a><span class="users-list-date">' + parsePower(response[i].POWER) + '</span></li>';
                  }

                  $('#userList').html(html);

                }
                else {

                }

                $('#userList').show();
                $('#loader').hide();

                new List('divUserList', {
                  valueNames: ['users-list-name', 'users-list-date']
                });
              }

            },
            error: function(error) {
              console.log(error);
              $('#userList').show();
              $('#loader').hide();
            }
          });

        });

        /**
         * Converts int based power to string.
         * @param  {int} power Power of the player
         * @return {string}    User friendly power
         */
        function parsePower(power) {
          switch (power) {
            case '0':
              return 'Player';
            break;
            case '1':
              return 'HERO';
            break;
            case '2':
              return 'GM';
            break;
            case '3':
              return 'High God';
            break;
            case '4':
              return 'Arch GM';
            break;  
            case '5':
              return 'Implementor';
            break;
            default:
              return 'Unknown power';
            break;
          }
        }
      </script>
<?php
require("../footer.php");
?>