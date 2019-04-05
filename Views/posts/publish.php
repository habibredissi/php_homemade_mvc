<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Website CSS style -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../Vendors/css/style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Admin</title>
	</head>
	<body>
		<div class="container">
			<div class="row main">
            <?php echo $data['alert']?>

				<div class="main-login main-center">
					<form class="" method="post" action="#">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Title</label>
							<div class="cols-sm-10">
							</div>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="title" id="title"  placeholder="Title of your article"/>
								</div>
							</div>
						</div>
						<div class="form-group">
                            <label for="exampleFormControlTextarea1">Large textarea</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="content" rows="10"></textarea>
                            </div>
						<div class="form-group ">

						<div class="form-group">
							<select class="form-control" name="category_id">
								<?= $data['htmlCategories']; ?>
							</select>
						</div>
						
							<input href="#" target="_blank" type="submit" id="submit" name="submit" class="btn btn-primary btn-lg btn-block login-button">
						</div>

						
						
					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>