<?php
$page = "admin";
$rootPath = "../../..";
require("../../../header.php");
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Add User
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-body box-profile" id="quickInfo" style="display:none;">
                  <img id="userPicture" class="profile-user-img img-responsive img-circle" src="" alt="User profile picture" />
                  <h3 id="username" class="profile-username text-center"></h3>
                  <p id="userLevel" class="text-muted text-center"></p>
                </div>
                <div class="loading" id="loader-0"></div>
              </div>

            </div>

            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-body" id="userSettings" style="display:none;">
                  <div class="row">
                    <form role="form" id="formChangeLevel">
                      <div class="col-md-9 col-sm-9 col-xs-6">
                        <div class="form-group">
                          <label>Change level</label>
                          <select id="txtLevel" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <button type="submit" id="btnUpdate" class="btn btn-primary form-control pull-right">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <button class="btn btn-primary form-control" id="btnResetPassword">Reset password</button>
                    </div>
                    <div class="col-md-4" id="generatedPassword">

                    </div>
                  </div>
                  <div class="row" style="margin-top: 13px;">
                    <div class="col-md-3">
                      <button class="btn btn-danger form-control" id="btnDeleteUser">Delete</button>
                    </div>
                  </div>
                </div>
                <div class="loading" id="loader-1"></div>
              </div>
            </div>
            <input type="hidden" id="accountID" value="<?php echo $_GET['id']; ?>" />
          </div>
        </section>
      </div>

      <script>
      $(document).ready(function() {

        $.ajax({
          type: 'POST',
          url: 'edit.php',
          data: {doing: "loadUser", accountID: $('#accountID').val()},
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
              $('#userPicture').prop('src', '../../../assets/images/avatars/' + response.userPicutre);
              $('#username').html(response.USERNAME);
              $('#userLevel').html('Level: ' + response.LEVEL);
              $('#txtLevel').val(response.LEVEL);

              $('#loader-0').hide();
              $('#loader-1').hide();
              $('#quickInfo').show();
              $('#userSettings').show();
            }
            else {
              swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
            }

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });

        $('#formChangeLevel').on('submit', function(e) {
          e.preventDefault();
          var accountID = $('#accountID').val();
          var level = $('#txtLevel').val();

          $('#response').html('');

          if(level != '') {
            $.ajax({
              type: 'POST',
              url: 'edit.php',
              data: {doing: "changeLevel", accountID: accountID, level: level},
              dataType: 'json',
              beforeSend: function() {
                $('#txtLevel').prop('disabled', true);
                $('#btnUpdate').prop('disabled', true);
                $('#btnUpdate').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
              },
              success: function(response) {
                if(response.success) {
                  swal("Updated", "The user level was successfully changed to [ " + level + " ].", "success");
                  $('#userLevel').html('Level: ' + level);
                }
                else {
                  switch(response.message) {
                    case 'permission':
                      swal("Failed", "Uh-oh, looks like you don't have the permission to change this.", "error");
                      break;
                    default:
                      swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
                      break;
                  }
                }

                $('#txtLevel').prop('disabled', false);
                $('#btnUpdate').prop('disabled', false);
                $('#btnUpdate').html('Update');

              },
              error: function(error) {
                console.log(error);
                swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
                $('#txtLevel').prop('disabled', false);
                $('#btnUpdate').prop('disabled', false);
                $('#btnUpdate').html('Update');
              }
            });
          }
          else {
            $('#response').html('<div class="alert alert-danger" role="alert"> You left something blank! </div>');
          }

          return false;
        });

        $('#btnResetPassword').on('click', function(e) {
          e.preventDefault();
          var accountID = $('#accountID').val();

          $('#generatedPassword').html('');

          swal({
            title: "Are you sure?",
            text: "You want to reset this users password?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#039e08",
            confirmButtonText: "Yes!",
            closeOnConfirm: false },
            function() {
              $.ajax({
                type: 'POST',
                url: 'edit.php',
                data: {doing: "resetPassword", accountID: accountID},
                dataType: 'json',
                beforeSend: function() {
                  $('#btnResetPassword').prop('disabled', true);
                  $('#btnResetPassword').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
                },
                success: function(response) {
                  if(response.success) {
                    swal("Reset Complete", "Password has been set to [ " + response.password + " ].", "success");
                    $('#generatedPassword').html('New password: ' + response.password);
                  }
                  else {
                    switch(response.message) {
                      case 'permission':
                        swal("Failed", "Uh-oh, looks like you don't have the permission to change this.", "error");
                        break;
                      default:
                        swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
                        break;
                    }
                  }

                  $('#btnResetPassword').prop('disabled', false);
                  $('#btnResetPassword').html('Reset password');

                },
                error: function(error) {
                  console.log(error);
                  swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
                  $('#btnResetPassword').prop('disabled', false);
                  $('#btnResetPassword').html('Reset password');
                }
              });
            }
          );

          return false;
        });

        $('#btnDeleteUser').on('click', function(e) {
          e.preventDefault();
          var accountID = $('#accountID').val();

          swal({
            title: "Are you sure?",
            text: "You want to delete this user? This action can't be undone.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            closeOnConfirm: false },
            function() {
              $.ajax({
                type: 'POST',
                url: 'edit.php',
                data: {doing: "deleteUser", accountID: accountID},
                dataType: 'json',
                beforeSend: function() {
                  $('#btnDeleteUser').prop('disabled', true);
                  $('#btnDeleteUser').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
                },
                success: function(response) {
                  if(response.success) {
                    swal({
                      title: "Deleted",
                      text: "This user has been successfully deleted!",
                      type: "success",
                      showCancelButton: false,
                      closeOnConfirm: true,
                      closeOnCancel: true },
                      function(isConfirm) {
                        window.location.href = '../';
                      }
                    );
                  }
                  else {
                    switch(response.message) {
                      case 'permission':
                        swal("Failed", "Uh-oh, looks like you don't have the permission to change this.", "error");
                        break;
                      default:
                        swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
                        break;
                    }
                  }

                  $('#btnDeleteUser').prop('disabled', false);
                  $('#btnDeleteUser').html('Delete');

                },
                error: function(error) {
                  console.log(error);
                  swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
                  $('#btnResetPassword').prop('disabled', false);
                  $('#btnResetPassword').html('Delete');
                }
              });
            }
          );

          return false;
        });
      });
    </script>
<?php
require("../../../footer.php");
?>