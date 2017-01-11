<?php
$page = "village";
$rootPath = "..";
require("../header.php");
?>
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box" id="divVillageList">
                <div class="box-header">
                  <h3 class="box-title">List of villages</h3>
                  <div class="box-tools pull-right">
                    <input placeholder="Search ..." class="form-control search" />
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <div class="loading" id="loader"></div>
                  <table class="table table-hover" id="tblVillageList" style="display: none;">
                    <thead>
                      <tr>
                        <th class="sort" data-sort="status">Status</th>
                        <th class="sort" data-sort="village-list-name">Name</th>
                        <th>Motto</th>
                        <th>Founder</th>
                        <th>Mayor</th>
                        <th>Founded on</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      
      <script src="<?php echo $rootPath; ?>/assets/vendors/listjs/list.min.js"></script>

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
                if(response.length > 0) {
                  var html = '';
                  for(var i = 0; i < response.length; i++) {

                    if (response[i].DISBANDED == 0) {
                      statusLabel = '<span class="status label label-success">Active</span>';
                    } else {
                      statusLabel = '<span class="status label label-default">Disbanded</span>';
                    }

                    html += '<tr onclick="location.href = \'./view/?id=' + response[i].ID + '\'" style="cursor: pointer;"><td>' + statusLabel + '</td><td class="village-list-name">' + response[i].NAME + '</td><td>' + response[i].DEVISE + '</td><td clas="village-list-founder">' + response[i].FOUNDER + '</td><td class="village-list-mayor">' + response[i].MAYOR + '</td><td>' + response[i].CREATIONDATE + '</td></tr>';
                  }

                  $('#tblVillageList tbody').html(html);
                }

                $('#tblVillageList').show();
                $('#loader').hide();

                new List('divVillageList', {
                  valueNames: ['status', 'village-list-name', 'village-list-founder', 'village-list-mayor']
                });
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