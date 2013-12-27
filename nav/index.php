<html>
<head>
	<title>Segment UI</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> 
</head>
<body>
<form action="">
	<div id="segContainer">




		<!-- shows right column with list of selectable segments -->
			<div id="segCol1">
				
				<?php
					require_once('inc/SegmentManager.inc.php');
					
					if( empty($_REQUEST['orgid']) ) {
						$orgid='0';
					} 
					if( !empty($_REQUEST['orgid']) ) {
						$orgid = $_REQUEST['orgid'];
					}
					
					$sm = new SegmentManager($orgid);
					echo $sm->getParentSegments();
					
				?>
				<!-- list of top segments - has no parent -->
			</div>



			<div id="segCol2">
				<p class="title">Custom Segments</p>
				<div id="customSeg">
					<input type="text" name="customSegments" value="" id="customInputField">
					<button id="addCustomSeg"></button>
					<div class="clear"></div>
					<ul id="customList">
							<!-- <li><p>Soccer</p><span class="removeCustom"></span></li> -->
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-latest.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" /> 
	<script src="js/jquery-1.5.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		$( document ).ready(function() {

			

			//add new custom segment to the right column
			$('button#addCustomSeg').click(function(event){
				 event.preventDefault();

				 //'number' will need to correspond with customs segment ID in database
				 var val = $('#customInputField').val()
				 	,number = 1 + Math.floor(Math.random() * 6000000);
				 
				 val = $.trim(val);

				 //checks to see if field is empty or only spaces
				if(val !=='' && val !==' '){

					//First AJAX Call to get the current list and open it
					

					$.ajax({
						url: "inc/ajaxHandler.inc.php?customid="+number+"&title="+val+"&orgid="+<?php echo $orgid; ?>,
						cache: false
					}).done(function( data ) {
						console.log("AJAX SUCCESS - Title: "+val+" ID: "+number+" -- STATUS: "+data);
						
						//adds value to custom segment on right
						$('#customList').append('<li id="'+data+'"> <p>' + val  + '</p><span class="removeCustom"></span>');
	   				 	
						//add to custom segment category on left
						$('#customListLeft').append('<li class="child"><span id="" class="segmentCheck"><input type="checkbox" name="" value="'+data+'" id="'+data+'" class="" checked><label for="'+data+'"></label></span><a href="#">' + val  + '</a></li>');

	   				 	//clears text field
	   				 	$('#customInputField').val("");

												
					}); //end of AJAX
				}
				else{
					alert("Please add a segment");
				} 

			});

			//remove customs segments from right column and
			//uncheck from list on left
			$('#customList span.removeCustom').live('click', function(event){

					event.preventDefault();

					//find id of current li
					var thisID = $(this).closest('li').attr('id');

					console.log(thisID);

					//find item from list 
					//$("#customListLeft li:[id='"+thisID+"']").remove();
					$("#customListLeft input[type='checkbox']:[id='"+thisID+"']").attr('checked', false);
					
					$(this).closest('li').remove();

			});


			//this performs the slide function on expandable elements in left column
			$( "a.isClosed" ).live('click',function(event) {
				event.preventDefault();					
				console.log("CLOSED live click catch");
				var itemId =  $(this).attr('id');
				var appendTo = $(this).parent();
				//AJAX Call
				$.ajax({
					url: "inc/ajaxHandler.inc.php?id="+itemId+"&orgid="+<?php echo $orgid; ?>,
					cache: false
				}).done(function( data ) {
					$( appendTo ).append( data );
				});
				$(this).removeClass('isClosed');
		 		$(this).addClass('isOpen');
			});

			$( "a.isOpen" ).live('click',function(event) {
				event.preventDefault();
				var itemId =  $(this).attr('id');
				var appendTo = $(this).parent();
				$(this).parent().find('ul').remove();
				console.log("OPEN live click catch");
				$(this).removeClass('isOpen');
		 		$(this).addClass('isClosed');
		 		$(this).parent().find('ul.subRoot').first().slideToggle('fast');
			});

		

			//simple check to spot a tag from acting as default
			$('#segCol1 a').live('click', function(event){
					event.preventDefault();
			});

		});

	</script>
</body>
</html>