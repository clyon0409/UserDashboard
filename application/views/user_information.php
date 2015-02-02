<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information</title>

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
<?php var_dump($user); ?>
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
       	<div class="blog-header">
       		<h2 class="blog-title"><?= $user['first_name'].' '.$user['last_name'] ?></h2>
       		<div class="row">
				  <div class="col-md-2"><p>Registered at:</p></div>
				  <div class="col-md-2"><p><?= date('F jS Y', strtotime($user['registered_at'])) ?></p></div>
				  <div class="col-md-8"></div>
			</div>
        
        	<div class="row">
				  <div class="col-md-2"><p>User ID:</p></div>
				  <div class="col-md-2"><p><?= $user['id'] ?></p></div>
				  <div class="col-md-8"></div>
			</div>

			<div class="row">
				  <div class="col-md-2"><p>Email Address</p></div>
				  <div class="col-md-2"><p><?= $user['email'] ?></p></div>
				  <div class="col-md-8"></div>
			</div>
        
        	<div class="row">
				  <div class="col-md-2"><p>Description:</p></div>
				  <div class="col-md-2"><p><?= $user['description'] ?></p></div>
				  <div class="col-md-8"></div>
			</div>
      	</div>

      <div class="row">
          <div class="col-md-12 blog-main">
          	<h2 class="blog-title">Leave a message for <?= $user['first_name'] ?></h2>
  			    <textarea class="form-control" rows="3"></textarea>
          </div>
      </div>
			
			<div class="row">
				  <div class="col-md-11"></div>
				  <div class="col-md-1">
				  	<p><button type="button" class="btn btn-success  btn-default">Post</button></p>
				  </div>

<?php   foreach ($user['posts'] as $post)
        {
           echo '<div class="blog-post">';
           echo '<div class="row">';
                  echo '<div class="col-md-2"><h4 class="blog-post-meta"><a href="#">'.$post['poster_first'].' '.$post['poster_last'].'</a></h4></div>';
                  echo '<div class="col-md-8"></div>';
                  echo '<div class="col-md-2"><p class="blog-post-meta"><p>'.date('F jS Y', strtotime($post['post_date'])).'</p></div>';
             echo '</div>';
             echo '<p>'.$post['content'].'</p>';
        }
?>
            <hr>
            
            <div class="row">
                <div class="col-md-1"><h4></div>
                <div class="col-md-2"><h4><a href="#">Diana Manulu</a> wrote</h4></div>
                <div class="col-md-7"></div>
                <div class="col-md-2"><p class="blog-post-meta">January 1, 2014 by</p></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11"> <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11"> <textarea class="form-control" rows="3" placeholder ='leave a message'></textarea></div>
            </div>
             <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1"><p><button type="button" class="btn btn-success  btn-sm">Post</button></p></div>
            </div>
          </div> <!-- end of first blog post -->
           
          <div class="blog-post">
            <div class="row">
                <div class="col-md-2"><h4 class="blog-post-meta"><a href="#">Mark</a></h4></div>
                <div class="col-md-8"></div>
                <div class="col-md-2"><p class="blog-post-meta">January 1, 2014 by</p></div>
            </div>
            <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
            <hr>
            
            <div class="row">
                <div class="col-md-1"><h4></div>
                <div class="col-md-2"><h4><a href="#">Diana Manulu</a> wrote</h4></div>
                <div class="col-md-7"></div>
                <div class="col-md-2"><p class="blog-post-meta">January 1, 2014 by</p></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11"> <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11"> <textarea class="form-control" rows="3" placeholder ='leave a message'></textarea></div>
            </div>
             <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1"><p><button type="button" class="btn btn-success  btn-sm">Post</button></p></div>
            </div>
          </div> <!-- end of first blog post --> 
	</div>
  </body>
</html>
