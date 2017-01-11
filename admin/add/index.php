<?php
$page = "admin";
$rootPath = "../..";
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
                      <label>Confirm password</label>
                      <input type="password" class="form-control" id="txtConfirmPassword" placeholder="Confirm password" />
                    </div>
                    <div class="form-group">
                      <label>Level</label>
                      <select id="txtLevel" class="form-control">
                        <option value="0">Read Only</option>
                        <option value="1">HERO</option>
                        <option value="2">GM</option>
                        <option value="3">High God</option>
                        <option value="4">Arch GM</option>
                        <option value="5">Implementor</option>
                      </select>
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
          var confirmPassword = $('#txtConfirmPassword').val();
          var level = $('#txtLevel').val();

          $('#response').html('');

          if(username != '' && password != '' && confirmPassword != '' && level != '') {
            if(password == confirmPassword) {
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
                    swal("Added", "You have successfully added [ " + username + " ]", "success");
                    $('#txtUsername').val('');
                    $('#txtPassword').val('');
                    $('#txtLevel').val('');
                  }
                  else {
                    switch(response.message) {
                      case 'inuse':
                        swal("In-use", "It looks like the username [ " + username + " ] is already in use. Please try another", "error");
                        break;
                      default:
                        swal("Failed", "Uh-oh, this is unhanlded error :(", "error");
                        break;
                    }
                  }

                  $('#formAddUser').show();
                  $('#loader').hide();

                },
                error: function(error) {
                  console.log(error);
                  swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
                  $('#formAddUser').show();
                  $('#loader').hide();
                }
              });
            }
            else {
              $('#response').html('<div class="alert alert-danger" role="alert"> The two passwords do not match! </div>');
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