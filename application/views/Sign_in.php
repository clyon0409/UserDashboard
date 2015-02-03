 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
   <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  </head>

  <body>
      <div class="container">
          <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Home</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <p>Test App</p>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li ><a href='/main/home'>Home</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/main/sign_in">Sign in<span class="sr-only">(current)</span></a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            </nav>

            <!-- ********* Display Errors ********** -->
<?php
          if($this->session->flashdata('errors') != NULL)
          {
            echo '<h4 class="text-danger text-center"><bold>'.$this->session->flashdata('errors').'</bold></h4>';
          }
?>
            <!-- ********* Sign In Form ********** -->
            <div class="row">
              <div class="col-md-3 col-md-offset-3">
                <h3>Sign in</h3>
                <form action='/main/login_or_register' method='post'>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name='email' placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name='password' placeholder="Password">
                    </div>
                        <div class="row">
                        <div class="col-xs-8 col-sm-8"></div>
                        <div class="col-xs-4 col-sm-4">
                            <button type='submit' class='btn btn-success btn-default' name='action' value='login'>Sign In</button>
                        </div>
                    </div>
                    <p><a href='/main/register'><u>Don't have an account? Register</u></a></p>
                </form>
              </div>
              <div class="col-md-3 col-md-offset-3"></div>
            </div>
      </div>
  </body>
</html>