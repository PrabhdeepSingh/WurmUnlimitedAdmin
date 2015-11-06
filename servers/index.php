<?php
$page = "server";
require("../header.php");
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Servers
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row" id="serverList">
          </div>
        </section>
      </div>

      <script>
        $(document).ready(function() {
          $.ajax({
            type: 'POST',
            url: 'server.php',
            data: {},
            dataType: 'json',
            success: function(response) {
              if(response.error) {
                switch(response.error.message) {
                  case 'Missing database':
                    swal("Missing Databases", "Couldn't find the login database. Please double check your config file.", "error");
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
                    html += '<a href="./view/?id=' + response[i].SERVER + '"><div class="col-md-3 col-sm-6 col-xs-12"><div class="info-box"><span class="info-box-icon bg-aqua"><i class="fa fa-server"></i></span><div class="info-box-content"><span class="info-box-text">' + response[i].NAME + '</span><span class="info-box-number">' + response[i].COUNT + ' / ' + response[i].MAXPLAYERS + '</span></div></div></div></a>';
                  }

                  $('#serverList').html(html);
                }
                else {

                }

                $('#serverList').show();
                $('#loader').hide();
              }

            },
            error: function(error) {
              console.log(error);
              $('#serverList').show();
              $('#loader').hide();
            }
          });
        });
      </script>
<?php
require("../footer.php");
?>