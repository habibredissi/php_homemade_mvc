<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Interface</title>

    <!-- Bootstrap core CSS -->
    <link href="../../Vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../../Vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../../Vendors/css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="http://localhost/PHP_Rush_MVC/Webroot/home/index">Ze Blog !</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/admin/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/search/index">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../posts/publish">Publish Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/users/edit">Edit profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/posts/admin">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/comments/index">Comments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/PHP_Rush_MVC/Webroot/admin/categories">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('../../Vendors/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>List Users</h1>
              <span class="subheading">Manage Users</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Group</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?= $data['htmlList']; ?>
    </tbody>
  </table>
</div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; Ze Blog ! Coding Academy 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../../Vendors/jquery/jquery.min.js"></script>
    <script src="../../Vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../../Vendors/js/clean-blog.min.js"></script>

  </body>

</html>
