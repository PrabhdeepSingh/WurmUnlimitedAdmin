<?php
$page = "ticket";
$rootPath = "../..";
require("../../header.php");
?>
  <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css" />
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Ticket <?php echo $_GET["id"]; ?></h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile" id="1stDiv" style="display: none;">
              <h3 class="profile-username text-center" id="ticketStatus"></h3>
              <br />
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Owner</b> <a class="pull-right" id="ticketOwner"></a>
                </li>
                <li class="list-group-item">
                  <b>Date created</b> <a class="pull-right" id="ticketCreateDate"></a>
                </li>
                <li class="list-group-item">
                  <b>Assigned to</b> <a class="pull-right" id="ticketAssignedTo"></a>
                </li>
                <li class="list-group-item">
                  <b>Date closed</b> <a class="pull-right" id="ticketClosedDate"></a>
                </li>
              </ul>
            </div>
            <div class="loading" id="loader-0"></div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content" id="2ndDiv" style="display: none;">
              <div class="active tab-pane" id="activity">
                <div class="row">
                  <div class="col-md-12"><b style="font-size: 1.3em;">Category:</b> <p style="font-size: 1.1em;" id="ticketCategory"></p></div>
                  <br />
                  <div class="col-md-12"><b style="font-size: 1.3em;">Description:</b> <p style="font-size: 1.1em;" id="ticketDescription"></p></div>
                </div>
                <br />
                <div class="row" id="divTicketActivityList">
                  <div class="col-md-4 pull-right">
                    <input placeholder="Search ..." class="form-control search" />
                  </div>
                  <div class="col-md-12">
                    <table class="table table-hover" id="tblTicketActivity">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Action</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="loading" id="loader-1"></div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <input type="hidden" id="txtTicketID" value="<?php echo $_GET['id']; ?>" />
  
  <script src="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
  <script src="<?php echo $rootPath; ?>/assets/vendors/listjs/list.min.js"></script>

  <script>
    $(document).ready(function() {
      var ticketId = $('#txtTicketID').val();
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {ticketId: ticketId},
          dataType: 'json',
          success: function(response) {
            if(response.success) {

              if (response.STATENAME === 'New') {
                $('#ticketStatus').html('<span class="label label-danger">New</span>');
              } else if (response.STATENAME === 'On Hold') {
                $('#ticketStatus').html('<span class="label label-warning">On Hold</span>');
              } else if (response.STATENAME === 'Resolved') {
                $('#ticketStatus').html('<span class="label label-success">Resolved</span>');
              } else if (response.STATENAME === 'Responded') {
                $('#ticketStatus').html('<span class="label label-danger">Responded</span>');
              } else if (response.STATENAME === 'Cancelled') {
                $('#ticketStatus').html('<span class="label label-default">Cancelled</span>');
              } else if (response.STATENAME === 'Watching') {
                $('#ticketStatus').html('<span class="label label-success">Watching</span>');
              } else if (response.STATENAME === 'Taken') {
                $('#ticketStatus').html('<span class="label label-primary">Taken</span>');
              } else if (response.STATENAME === 'Forwarded') {
                $('#ticketStatus').html('<span class="label label-info">Forwarded</span>');
              } else if (response.STATENAME === 'Reopened') {
                $('#ticketStatus').html('<span class="label label-danger">Reopened</span>');
              } else {
                $('#ticketStatus').html('<span class="label label-default">Unknown</span>');
              }

              $('#ticketOwner').html(response.PLAYER);
              $('#ticketCreateDate').html(response.TICKETDATE);
              $('#ticketAssignedTo').html(response.RESPONDERNAME);
              $('#ticketClosedDate').html(response.CLOSEDDATE);

              $('#ticketCategory').html(response.CATEGORYNAME);
              $('#ticketDescription').html(response.DESCRIPTION);

              var activityHtml = '';
              for(var i = 0; i < response.ACTIVITY.length; i++) {
                activityHtml += '<tr><td class="users-list-name">' + response.ACTIVITY[i].BYWHOM + '</td><td clas="users-list-action">' + response.ACTIVITY[i].NOTE + '</td><td>' + response.ACTIVITY[i].ACTIONDATE + '</td></tr>';
              }

              $('#tblTicketActivity tbody').html(activityHtml);

              new List('divTicketActivityList', {
                valueNames: ['users-list-name', 'users-list-action']
              });

            }
            else {
              swal("Error!", "Could not load this ticket", "error");
            }

            $('#1stDiv').show();
            $('#2ndDiv').show();
            $('#loader-0').hide();
            $('#loader-1').hide();

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });
      
      }
    });
  </script>

<?php
require("../../footer.php");
?>