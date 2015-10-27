<?php
require("../header.php");
?>
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Players</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="loading" id="loader"></div>
                  <ul class="users-list clearfix" id="userList" style="display: none;">
                  </ul>
                  <!-- /.users-list -->
                </div>
              </div>
              <!--/.box -->
            </div>
          </div>
        </section>
      </div>

      <script>
        $(document).ready(function() {
          $.ajax({
            type: 'POST',
            url: 'player.php',
            data: {},
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
                    html += '<li><img src="' + response[i].image + '" alt="User Image"><a class="users-list-name" href="./view/?id=' + response[i].WURMID + '">' + response[i].NAME + '</a><span class="users-list-date">Power: ' + response[i].POWER + '</span></li>';
                  }

                  $('#userList').html(html);
                }
                else {

                }

                $('#userList').show();
                $('#loader').hide();
              }

            },
            error: function(error) {
              console.log(error);
              $('#userList').show();
              $('#loader').hide();
            }
          });
        });
      </script>
<?php
require("../footer.php");
?>