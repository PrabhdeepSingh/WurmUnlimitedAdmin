<?php
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

          $('#response').html('');

          if(currentPassword != '' && password != '') {
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
                console.log(response);
                if(response.success) {
                  $('#response').html('<div class="alert alert-success" role="alert"> Password changed! </div>');
                  $('#txtCurrentPassowrd').val('');
                  $('#txtPassword').val('');
                }
                else {
                  switch(response.message) {
                    case 'Incorrect':
                      $('#response').html('<div class="alert alert-danger" role="alert"> The password is incorrect </div>');
                      break;
                    default:
                      $('#response').html('<div class="alert alert-danger" role="alert"> Something went wrong </div>');
                      break;
                  }
                }

                $('#formChangePassword').show();
                $('#loader').hide();

              },
              error: function(error) {
                console.log(error);
                $('#response').html('<div class="alert alert-danger" role="alert"> Something went wrong </div>');
                $('#formChangePassword').show();
                $('#loader').hide();
              }
            });
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