<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

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
	                  <li><a href="/users/go_to_dashboard">Dashboard</a></li>
	                  <li><a href="/users/edit_profile">Profile</a></li>
	                </ul>
	                <ul class="nav navbar-nav navbar-right">
	                  <li><a href="/main/index">Log off</a></li>
	                </ul>
	              </div><!-- /.navbar-collapse -->
	      </nav>

<?php //var_dump($users)?>

       <!-- ************* Admin Table *************  -->
       <h3>All Users</h3>
	    <div class="row">
			  <div class="col-md-6"></div>
			  <div class="col-md-6"></div>
		</div>
		<div class="row">
	        <div class="col-md-12">
		        <table class="table table-bordered">
		 			<thead>
		 				<tr>
			 				<th>ID</th>
			 				<th>Name</th>
			 				<th>email</th>
			 				<th>created_at</th>
			 				<th>user_level</th>
		 				</tr>
		 			</thead>
		 			<tbody>
<?php 					foreach ($users as $user)
						{
							echo '<tr>';
				 				echo '<td>'.$user['id'].'</td>';
				 				echo '<td><a href="/users/show_wall/'.$user['id'].'"><u>'.$user['first_name'].' '.$user['last_name'].'</u></a></td>';
				 				echo '<td>'.$user['email'].'</td>';
				 				echo '<td>'.date('F jS Y',strtotime($user['created_at'])).'</td>';
				 				echo '<td>'.$user['access_level'].'</td>';
                 			echo '</tr>';

						}
?>
		 			</tbody>
				</table>
			</div>
		</div>
	</div>
  </body>
</html>
