<?php
$page = "village";
$rootPath = "../..";
require("../../header.php");
?>
  <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css" />
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Village Profile</h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile" id="1stDiv" style="display: none;">
              <img class="profile-user-img img-responsive img-circle" id="villageImage" src="" alt="village picture">

              <h3 class="profile-username text-center" id="villageName"></h3>
              <p class="text-muted text-center" id="villageMayor"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Founder</b> <a class="pull-right" id="villageFounder"></a>
                </li>
                <li class="list-group-item">
                  <b>Founded on</b> <a class="pull-right" id="villageFoundedOn"></a>
                </li>
                <li class="list-group-item">
                  <b>Coordinate points (X,Y)</b> <a class="pull-right" id="villageCords"></a>
                </li>
                <li class="list-group-item">
                  <b>Kingdom</b> <a class="pull-right" id="villageKingdom"></a>
                </li>
              </ul>
            </div>
            <div class="loading" id="loader-0"></div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#history" data-toggle="tab">History</a></li>
              <li><a href="#citizens" data-toggle="tab">Citizens</a></li>
            </ul>
            <div class="tab-content" id="2ndDiv" style="display: none;">
              <div class="active tab-pane" id="history">
                <div class="row" id="divVillageHistoryList">
                  <div class="col-md-4">
                    <input placeholder="Search ..." class="form-control search" />
                  </div>
                  <div class="col-md-12">
                    <table class="table table-hover" id="tblVillageHistoryList">
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
              <div class="tab-pane" id="citizens">
                <div class="row" id="divUserList">
                  <div class="col-md-4">
                    <input placeholder="Search ..." class="form-control search" />
                  </div>
                  <div class="col-md-12">
                    <ul class="users-list clearfix list" id="userList">
                    </ul>
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

  <input type="hidden" id="txtVillageId" value="<?php echo $_GET['id']; ?>" />
  
  <script src="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
  <script src="<?php echo $rootPath; ?>/assets/vendors/listjs/list.min.js"></script>

  <script>
    $(document).ready(function() {
      var villageId = $('#txtVillageId').val();
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {villageId: villageId},
          dataType: 'json',
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the zones database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {

              $('#villageImage').prop('src', '../../assets/images/avatars/' + response.image);
              $('#villageName').html(response.NAME);
              $('#villageMayor').html('Mayor: ' + response.MAYOR);
              $('#villageFounder').html(response.FOUNDER);
              $('#villageFoundedOn').html(response.CREATIONDATE);
              $('#villageCords').html(response.STARTX + ', ' + response.STARTY);
              $('#villageKingdom').html(response.KINGDOMNAME);

              var historyHtml = '';
              for(var i = 0; i < response.history.length; i++) {
                historyHtml += '<tr><td class="users-list-name">' + response.history[i].PERFORMER + '</td><td clas="users-list-action">' + response.history[i].EVENT + '</td><td>' + response.history[i].EVENTDATE + '</td></tr>';
              }

              $('#tblVillageHistoryList tbody').html(historyHtml);

              new List('divVillageHistoryList', {
                valueNames: ['users-list-name', 'users-list-action']
              });

              var citizenHtml = '';
              for(var i = 0; i < response.citizens.length; i++) {
                citizenHtml += '<li><img src="../../assets/images/avatars/' + response.citizens[i].image + '" alt="User Image" onclick="location.href = \'../../players/view/?id=' + response.citizens[i].wurmId + '\'" style="cursor: pointer;"><a class="users-list-name" href="../../players/view/?id=' + response.citizens[i].wurmId + '">' + response.citizens[i].name + '</a></li>';
              }

              $('#userList').html(citizenHtml);

              new List('divUserList', {
                valueNames: ['users-list-name', 'users-list-date']
              });

            }
            else {
              swal("Error!", "Could not load this vilage", "error");
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
    });
  </script>

<?php
require("../../footer.php");
?>