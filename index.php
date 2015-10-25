<?php
require("header.php");
?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">[ Title ]</h3>
                </div>
                <div class="box-body">
                  <?php echo dirname(__FILE__); ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php
require("footer.php");
?>