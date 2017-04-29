<?php
session_start();
$sessionID=session_id();

$url="http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"].'?sid=';


if (isset($_GET['sid']) and !empty($_GET['sid'])){
	session_id($_GET['sid']);
	$sessionID=$_GET['sid'];
}
$url.=$sessionID;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Dolgov</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
     
        <span class="h3class  text-muted">Dolgov TODO List</span>
        <span class="h3class  text-muted">&nbsp;<a href="<?= $url; ?>">Ссылка для восстановления</a>&nbsp;</span>
      </div>

      <div class="jumbotron">
        <h1>Добавить новое дело</h1>
		<form name="newtaskform" id="newtaskform" action="newtask.php" method="POST" >
			<p class="lead">
				<input type="hidden" name="curID" id="curID" value="0" >
				<textarea class="wid100" id="newtask" name="newtask">
				
				</textarea>
			</p>
			<p><input id="newTaskButton" type="button" name="button"  class="btn btn-primary " value="Добавить дело"></p>
		</form>
      </div>

      <div id="messages"	  class=" row marketing">
        <div id="task-header" class="col-lg-12">
			<span class="wid45"><b>Задача</b></span>
			<span class="wid10"><b>Выполнено</b></span>
			<span class="wid20"><b>Дата</b></span>
			<span class="wid20"><b>Действие</b></span>
		</div>
      </div>

    </div> <!-- /container -->


	<script>

	$("#newTaskButton").click(function(){
		var newtask=$('#newtask').val();
		newtask=newtask.replace(/^\s*(.*)\s*$/, '$1');// удалм\им пробелы
		
		if (newtask==""  || newtask==undefined){
			alert("Нельзя передовать пустое поле!");
			return;
		}
        var data={'newtask':newtask};
        var url = "newtask.php"; // the script where you handle the form input.
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            
            success: function(responseData, textStatus, jqXHR) {
				console.log(responseData);
                $('.task').remove();
				$('#newtask').val('');
				getTasks();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            
        });
        return false;
    });
	
	function edittask(type,id,inputID){
		var alertStr="сохранить";
		if (type==1){
			alertStr="удалить";
		}
		alertStr="Вы действительно хотите "+alertStr+'?';	
		//type: 0 for save, 1 for del
		
		if (window.confirm(alertStr)){
			var text=$('#task-text-id'+inputID).val();
			var done=0;
			if ($('#task-done-id'+inputID).is(':checked')){
				done=1;
			}
			
			var data={'id':id,'text':text,'done':done};
			var url='';
			if (type==0){
				url="savetask";
			}else{
				url="deltask";
			}
			url+='.php';
			
						
			
			$.ajax({
				url: url,
				type: 'POST',
				data: data,            
				success: function(responseData, textStatus, jqXHR) {
					if (type==0){
						$('#task-text-id'+inputID).addClass('done');
					}
					console.log(responseData);
					//alert("Изменено");
					console.log('type='+type.toString());
					if (type==1){
						$('#task-text-id'+inputID).parent().parent().remove();
						if (('.task').length==0){
							
							
							var str='<div class=" task col-lg-12">Ничего не найдено!</div>';
							$('#messages').append(str);		
						}
					}
					
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				},
			   
			});
			return false;
		}
	}

	
	function getTasks(){
		var id=$('#curID').val();
		var data={'id':id,'sid':'<?= $sessionID; ?>'};
		$.ajax({
            url: 'gettasks.php',
            type: 'POST',
            data: data,            
            success: function(responseData, textStatus, jqXHR) {
				console.log(responseData);
				if (responseData==0){
					var str="";
					str+='<div class=" task col-lg-12">Ничего не найдено!</div>';
					$('#messages').append(str);		
						
				}else{
					
				
				
				
					console.log(responseData);
					var obj=JSON.parse(responseData);
					var str="";
					var checked='';
					var i=0;
					for(var key in obj){
						var isDone="";
						if (obj[key][1]==1){
							isDone="done";
						}
						
						str+='<div class=" task task2 col-lg-12">';
							str+='<span class="wid45"><textarea id="task-text-id'+i+'" class="task-text '+isDone+'">'+obj[key][0]+'</textarea></span>';
							if (obj[key][1]==1) checked="checked";
							else checked="";
							
							str+='<span class="wid10"><input id="task-done-id'+i+'" class="task-done" type="checkbox" '+checked+'></span>';
							//str+='<span class="wid10">'+obj[key][1]+'</span>';
							str+='<span class="wid20">'+obj[key][2]+'</span>';
							str+='<span class="wid10">';
								str+='<input type="button" name="button" class="btn btn-primary" value="Сохранить" class="saveTask" onClick="edittask(0,'+obj[key][3]+','+i.toString()+')" >';
							str+='</span>';
							str+='<span class="wid10">';
								str+='<input type="button" name="button" class="btn btn-danger" value="Удалить" class="saveTask" onClick="edittask(1,'+obj[key][3]+','+i.toString()+')" >';
							str+='</span>';
						str+='</div>';
						
						
						
						//class="saveTask" onClick="saveTask('+obj[key][3]+') 
						
						
						i++;
					}
					$('#messages').append(str);
				}
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
           
        });
        return false;
    }
	
	
	
	window.onload=getTasks();
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>