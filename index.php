<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Dolgov</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	   <script src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">Dolgov TODO List</h3>
      </div>

      <div class="jumbotron">
        <h1>Добавить новое дело</h1>
		<form name="newtaskform" id="newtaskform" action="addtask.php" method="POST" >
			<p class="lead">
				<input type="hidden" name="curID" id="curID" value="0" >
				<textarea id="newtask" name="newtask">
				
				</textarea>
			</p>
			<p><input id="newTaskButton" type="button" name="button"  class="btn btn-primary " value="Добавить дело"></p>
		</form>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <div class="footer">
        <p>&copy; Company 2014</p>
      </div>

    </div> <!-- /container -->


	<script>

	$("#newTaskButton").click(function(){
        var formData = new FormData($('#newtaskform')[0]);
        var url = "addtask.php"; // the script where you handle the form input.
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            
            success: function(responseData, textStatus, jqXHR) {
				console.log(responseData);
                if (responseData==1){
					alert("Задание добавлено!");
				}
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
	
	function getTasks(){
		
		$.ajax({
            url: 'gettasks.php',
            type: 'POST',
            data: formData,            
            success: function(responseData, textStatus, jqXHR) {
                console.log(responseData);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>