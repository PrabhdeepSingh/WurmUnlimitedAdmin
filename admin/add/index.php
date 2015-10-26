<?php
require("../../header.php");
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
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add a user</h3>
                </div>
                <div class="box-body">
                  <div id="response"></div>
                  <form role="form" id="formAddUser">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" id="txtUsername" placeholder="Enter username" />
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="txtPassword" placeholder="Password" />
                    </div>
                    <div class="form-group">
                      <label>Level</label>
                      <input type="number" class="form-control" id="txtLevel" placeholder="User level" />
                    </div>
                    <button type="submit" class="btn btn-primary">Add user</button>
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
        $('#formAddUser').on('submit', function(e) {
          e.preventDefault();

          var username = $('#txtUsername').val();
          var password = $('#txtPassword').val();
          var level = $('#txtLevel').val();

          $('#response').html('');

          if(username != '' && password != '' && level != '') {
            $.ajax({
              type: 'POST',
              url: 'add.php',
              data: {username: username, password: password, level: level},
              dataType: 'json',
              beforeSend: function() {
                $('#formAddUser').hide();
                $('#loader').show();
              },
              success: function(response) {
                console.log(response);
                if(response.success) {
                  $('#response').html('<div class="alert alert-success" role="alert"> User successfully added! </div>');
                  $('#txtUsername').val('');
                  $('#txtPassword').val('');
                  $('#txtLevel').val('');
                }
                else {
                  switch(response.message) {
                    case 'inuse':
                      $('#response').html('<div class="alert alert-danger" role="alert"> The username is already in-use. </div>');
                      break;
                    default:
                      $('#response').html('<div class="alert alert-danger" role="alert"> Something went wrong </div>');
                      break;
                  }
                }

                $('#formAddUser').show();
                $('#loader').hide();

              },
              error: function(error) {
                console.log(error);
                $('#response').html('<div class="alert alert-danger" role="alert"> Something went wrong </div>');
                $('#formAddUser').show();
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