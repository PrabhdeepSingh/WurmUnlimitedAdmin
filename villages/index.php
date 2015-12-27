<?php
$page = "village";
require("../header.php");
?>
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of villages</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <div class="loading" id="loader"></div>
                  <table class="table table-hover" id="tblVillageList" style="display: none;">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Motto</th>
                        <th>Founder</th>
                        <th>Mayor</th>
                        <th>Founded on</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      
      <script src="<?php echo $application["rootPath"]; ?>assets/vendors/listjs/list.min.js"></script>

      <script>
        $(document).ready(function() {
          $.ajax({
            type: 'POST',
            url: 'village.php',
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
                console.log(response);
                if(response.length > 0) {
                  var html = '';
                  for(var i = 0; i < response.length; i++) {
                    html += '<tr><td>' + response[i].NAME + '</td><td>' + response[i].DEVISE + '</td><td>' + response[i].FOUNDER + '</td><td>' + response[i].MAYOR + '</td><td>' + response[i].CREATIONDATE + '</td></tr>';
                  }

                  $('#tblVillageList tbody').html(html);

                }
                else {

                }

                $('#tblVillageList').show();
                $('#loader').hide();
              }

            },
            error: function(error) {
              console.log(error);
            }
          });

        });
      </script>
<?php
require("../footer.php");
?>