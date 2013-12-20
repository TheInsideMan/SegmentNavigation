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
					require_once('inc/DataBase.inc.php');
					$db = new DataBase();
					$sm = new SegmentManager($db);
					echo $segments = $sm->getParentSegments();
					
				?>



				<!-- list of top segments - has no parent -->
				<ul class="root">
					<li class="">
						<!-- styles the checkbox for a selectable segment -->
						<span id="" class="segmentCheck">
							<!-- input id and label takes the corresponding ID of segment in database -->
							<input type="checkbox" name="" value="" id="01" class="parentCheckbox">
							<label for="01"></label>
						</span>
						<!-- class 'isExpandable' is add dynamically if segment has child/ren -->
						<div class="isExpandable">
							<!-- class is changes if expanded -->
							<a href="#" class="isClosed">
								Entertainment 
							</a>
						</div>
						<div class="clear"></div>
						<!-- subRoot is hidden by default, javascript makes visible when expanded -->
							<ul class="subRoot">
							<li class="">
								<span id="" class="segmentCheck">
									
									<input type="checkbox" name="" value="" id="01-01" class="parentCheckbox">
									<label for="01-01"></label>
								</span>
								<div class="isExpandable">
									<a href="#" class="isClosed">
										Movies 
									</a>
								</div>
								<div class="clear"></div>
								<ul class="subRoot">
									<li class="">
										<span id="" class="segmentCheck">
											<input type="checkbox" name="" value="" id="01-01-01" class="">
											<label for="01-01-01"></label>
										</span>
										<a href="">Matrix</a>
									</li>
									<li>
										<span id="" class="segmentCheck">
											<input type="checkbox" name="" value="" id="01-01-02" class="">
											<label for="01-01-02"></label>
										</span>
										<a href="">
											Something else 
										</a>
									</li>
								</ul><!-- end 2 child ul -->
							</li>
							<li>
								<span id="" class="segmentCheck">
									<input type="checkbox" name="" value="" id="01-02" class="">
									<label for="01-02"></label>
								</span>
								<a href="">
									Music
								</a>
							</li>
						</ul><!-- end child ul -->
					</li>
					<li class="">
						<span id="" class="segmentCheck">
							<input type="checkbox" name="" value="" id="02" class="">
							<label for="02"></label>
						</span>
						<div class="isExpandable">
							<a href="#">
								Business
							</a>
						</div>
						<div class="clear"></div>
						<ul class="subRoot">
							<li class="">
								<a href="#">
									I am a child
								</a>
								<ul class="subRoot">
									<li class="">
										<a href="">
											I am a child
										</a>
									</li>
									<li>
										<a href="">
											So am I
										</a>
									</li>
								</ul><!-- end 2 child ul -->
							</li>
							<li>
								<a href="">
									So am I
								</a>
							</li>
						</ul><!-- end child ul -->
					</li>
					<li class="">
						<span id="" class="segmentCheck">
							<input type="checkbox" name="" value="" id="03" class="">
							<label for="03"></label>
						</span>
						<div class="">
							<a href="#">
								Real Estate 
							</a>
						</div>
						<div class="clear"></div>
					</li>
					<li class="">
						<span id="" class="segmentCheck">
							<input type="checkbox" name="" value="" id="05" class="">
							<label for="05"></label>
						</span>
						<div class="isExpandable">
							<a href="#">Custom Segments</a>
							</div>
						<div class="clear"></div>
						<!-- customListLeft is targeted by js to add new segments -->
						<ul id="customListLeft" class="subRoot">

							<li  id="123" class="">

								<span id="" class="segmentCheck">
									<input type="checkbox" name="" value="" id="05-01" class="">
									<label for="05-01"></label>
								</span>
								<a href="#">
										I am custom
								</a>

							</li>
							<li>
								<span id="" class="segmentCheck">
									<input type="checkbox" name="" value="" id="05-02" class="">
									<label for="05-02"></label>
								</span>
								<a href="">
										I am custom too
								</a>
							</li>
						</ul><!-- end child ul -->
					</li>
				</ul><!-- end root ul -->
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
				 	,number = 1 + Math.floor(Math.random() * 6000);
				 
				 val = $.trim(val);

				 //checks to see if field is empty or only spaces
				if(val !=='' && val !==' '){

					//adds value to custom segment on right
					$('#customList').append('<li id="'+number+'"> <p>' + val  + '</p><span class="removeCustom"></span>');
   				 	
					//add to custom segment category on left
					$('#customListLeft').append('<li class="child"><span id="" class="segmentCheck"><input type="checkbox" name="" value="" id="'+number+'" class="" checked><label for="'+number+'"></label></span><a href="#">' + val  + '</a></li>');

   				 	//clears text field
   				 	$('#customInputField').val("");
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
			

			$( "div.isExpandable" ).live('click',function(event) {
				event.preventDefault();
				
				//get the id of the clicked item
				var itemId = $(this).parent().find('input').attr('id');
				var appendTo = $(this).find('a').parent();
				
				
				

				// console.log("ulid: "+$(this).find('ul').attr('id'));

				//if this expandable div has a class of isOpen
				if($(this).find('a').hasClass('isClosed') ){
					 console.log('something');
					 $.ajax({
					url: "inc/ajaxHandler.inc.php?id="+itemId,
					cache: false
					}).done(function( html ) {
						$( appendTo ).append( html );
					});
					$(this).children('a').removeClass('isClosed');
					$(this).children('a').addClass('isOpen');
 					//$(this).parent().find('ul.subRoot').first().slideToggle('fast');
				} else if($(this).find('a').hasClass('isOpen')){
					console.log('nothing');

					$(this).find('ul').remove();
					$(this).children('a').removeClass('isOpen');
					$(this).children('a').addClass('isClosed');

				}

				//this un/hide subsegments
				$(this).parent().find('ul.subRoot').first().slideToggle('fast');

				// // console.log($(this).closest('li').find('span').);
				// 	//changes the direction of arrow
					// if($(this).children('a').hasClass('isClosed')){

					// 	$(this).children('a').removeClass('isClosed');
					// 	$(this).children('a').addClass('isOpen');
					// }
					// else if ($(this).children('a').hasClass('isOpen')){
						
					// 	$(this).children('a').removeClass('isOpen');
					// 	$(this).children('a').addClass('isClosed');
					// }



					

				});

			//simple check to spot a tag from acting as default
			$('#segCol1 a').live('click', function(event){
					event.preventDefault();
			});

		});

	</script>
</body>
</html>