<?php
$page = "ticket";
$rootPath = "..";
require("../header.php");
?>
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id="divTicketList">
            <div class="box-header">
              <h3 class="box-title">List of tickets</h3>
              <div class="box-tools pull-right">
                <input placeholder="Search ..." class="form-control search" />
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <div class="loading" id="loader"></div>
              <table class="table table-hover" id="tblTicketList" style="display: none;">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Owner</th>
                    <th>Category</th>
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
        url: 'ticket.php',
        data: {},
        dataType: 'json',
        success: function(response) {

          if(response.length > 0) {
            var html = '';
            for(var i = 0; i < response.length; i++) {
              var statusLabel = '';

              if (response[i].STATENAME === 'New') {
                statusLabel = '<span class="label label-danger">New</span>';
              } else if (response[i].STATENAME === 'On Hold') {
                statusLabel = '<span class="label label-warning">On Hold</span>';
              } else if (response[i].STATENAME === 'Resolved') {
                statusLabel = '<span class="label label-success">Resolved</span>';
              } else if (response[i].STATENAME === 'Responded') {
                statusLabel = '<span class="label label-danger">Responded</span>';
              } else if (response[i].STATENAME === 'Cancelled') {
                statusLabel = '<span class="label label-default">Cancelled</span>';
              } else if (response[i].STATENAME === 'Watching') {
                statusLabel = '<span class="label label-success">Watching</span>';
              } else if (response[i].STATENAME === 'Taken') {
                statusLabel = '<span class="label label-primary">Taken</span>';
              } else if (response[i].STATENAME === 'Forwarded') {
                statusLabel = '<span class="label label-info">Forwarded</span>';
              } else if (response[i].STATENAME === 'Reopened') {
                statusLabel = '<span class="label label-danger">Reopened</span>';
              }

              html += '<tr onclick="location.href = \'./view/?id=' + response[i].TICKETID + '\'" style="cursor: pointer;"><td>' + statusLabel + '</td><td>' + response[i].TICKETDATE + '</td><td class="ticket-list-playername">' + response[i].PLAYERNAME + '</td><td clas="ticket-list-category">' + response[i].CATEGORYNAME + '</td></tr>';
            }

            $('#tblTicketList tbody').html(html);
          }

          $('#tblTicketList').show();
          $('#loader').hide();

          new List('divTicketList', {
            valueNames: ['ticket-list-playername', 'ticket-list-category']
          });

        },
        error: function(error) {
          console.log(error);
          swal("Error", response.error.message, "error");
        }
      });

    });
  </script>
<?php
require("../footer.php");
?>