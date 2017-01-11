<?php
$page = "account";
$rootPath = "../..";
require("../../header.php");
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Change Password
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Change your password</h3>
                </div>
                <div class="box-body">
                  <div id="response"></div>
                  <form role="form" id="formChangePassword">
                    <div class="form-group">
                      <label>Current password</label>
                      <input type="password" class="form-control" id="txtCurrentPassowrd" placeholder="Enter your current password" />
                    </div>
                    <div class="form-group">
                      <label>New password</label>
                      <input type="password" class="form-control" id="txtPassword" placeholder="New password" />
                    </div>
                    <div class="form-group">
                      <label>Confirm new password</label>
                      <input type="password" class="form-control" id="txtConfirmPassword" placeholder="Re-enter new password" />
                    </div>
                    <button type="submit" class="btn btn-primary">Change password</button>
                  </form>
                  <div class="loading" id="loader" style="display: none;"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <script>
      $(document).ready(function() {
        $('#formChangePassword').on('submit', function(e) {
          e.preventDefault();

          var currentPassword = $('#txtCurrentPassowrd').val();
          var password = $('#txtPassword').val();
          var confirmPassword = $('#txtConfirmPassword').val();

          $('#response').html('');

          if(currentPassword != '' && password != '' && confirmPassword != '') {
            if(password == confirmPassword) {
              $.ajax({
                type: 'POST',
                url: 'changepassword.php',
                data: {currentPassword: currentPassword, password: password},
                dataType: 'json',
                beforeSend: function() {
                  $('#formChangePassword').hide();
                  $('#loader').show();
                },
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
                    swal("Changed!", "Your password was successfully changed!", "success");
                    $('#txtCurrentPassowrd').val('');
                    $('#txtPassword').val('');
                    $('#txtConfirmPassword').val('');
                  }
                  else {
                    switch(response.message) {
                      case 'Incorrect':
                        swal("Wrong password", "The password you have given doesn't match with our records! Please try again.", "error");
                        break;
                      default:
                        swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
                        break;
                    }
                  }

                  $('#formChangePassword').show();
                  $('#loader').hide();

                },
                error: function(error) {
                  console.log(error);
                  swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
                  $('#formChangePassword').show();
                  $('#loader').hide();
                }
              });
            }
            else {
              $('#response').html('<div class="alert alert-danger" role="alert"> Your new passwords do not match! </div>');
            }
          }
          else {
            $('#response').html('<div class="alert alert-danger" role="alert"> You left something blank! </div>');
          }

          return false;
        });
      });
    </script>
<?php
require("../../footer.php");
?>