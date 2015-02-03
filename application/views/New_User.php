<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New User</title>

    <!-- Bootstrap -->
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

  		<!-- ************* Navigation Bar *************  -->
	      <nav class="navbar navbar-default">
	              <!-- Brand and toggle get grouped for better mobile display -->
	              <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                  <span class="sr-only">Home</span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="#">Test App</a>
	              </div>
	              <!-- Collect the nav links, forms, and other content for toggling -->
	              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                  <li><a href="#">Dashboard</a></li>
	                  <li><a href="#">Profile</a></li>
	                </ul>
	                <ul class="nav navbar-nav navbar-right">
	                  <li><a href="#">Log off</a></li>
	                </ul>
	              </div><!-- /.navbar-collapse -->
	      </nav>

       <!-- ************* Main Content *************  -->
       	<div class="row">
		  <div class="col-md-3">
		  		<h4>Add a new user</h3>
				<form>
		                <div class="form-group">
		                  <label for="email">Email address</label>
		                  <input type="email" class="form-control" id="email" placeholder="Enter email">
		                </div>
		                <div class="form-group">
		                  <label for="fName">First Name</label>
		                  <input type="text" class="form-control" id="fName" placeholder="Enter first name">
		                </div>
		                 <div class="form-group">
		                  <label for="lName">Last Name</label>
		                  <input type="text" class="form-control" id="lName" placeholder="Enter last name">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputPassword1">Password</label>
		                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		                </div>
		                <div class="form-group">
		                  <label for="confirmPassword">Confirm Password</label>
		                  <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
		                </div>
		                <div class="row">
                                  <div class="col-xs-8 col-sm-8"></div>
                                  <div class="col-xs-4 col-sm-4">
                                     <button type="submit" class="btn btn-success btn-default">Create</button>
                                  </div>
                        </div>   
		        </form>
		  </div>
		  <div class="col-md-7"></div>
		  <div class="col-md-2">
		  		<p><button type="button" class="btn btn-primary btn-s">Return to Dashboard</button></p>
		  </div>
		</div>
	</div>
  </body>
</html>
