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
          <?php
          /**
           * Check if the wurm database variables have been set,
           * If not then show error messages.
           */
          $emptyVariables = array();
          foreach($dbConfig as $key => $value)
          {
            if(empty($value))
            {
              array_push($emptyVariables, $key);
            }

          }

          if(count($emptyVariables) > 0)
          {
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Database variables</h3>
                </div>
                <div class="box-body">
                  <h2 style="color: red;">Error: The following database variable(s) hasn't been set in the config.php file yet</h2>
                  <ul>
                    <?php
                    foreach($emptyVariables as $value)
                    {
                      echo "<li>{$value}</li>";
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>

          <?php
          /**
           * If the database variables are set check if the files exist.
           */
          $dbFiles = array();
          foreach($dbConfig as $key => $value)
          {
            if (file_exists($value))
            {
              array_push($dbFiles, "<font color='green'>{$key}: Found</font>");
            }
            else
            {
              array_push($dbFiles, "<font color='red'>{$key}: Not found</font>");
            }

          }

          if(count($dbFiles) > 0)
          {
          ?>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">File checker</h3>
                </div>
                <div class="box-body">
                  <h2>Results for database file checker:</h2>
                  <ul>
                    <?php
                    foreach($dbFiles as $value)
                    {
                      echo "<li>{$value}</li>";
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>

        </section>
      </div>
<?php
require("footer.php");
?>