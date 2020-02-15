<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/8c4db60a8a.js" crossorigin="anonymous"></script>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link href="/css/custom.css" rel="stylesheet">
	<link href="/css/loading.css" rel="stylesheet">
</head>

<body>
	<?php include('navbar.php') ;?>
	<div class="container" id="app">
		<?php echo $content; ?>
		<div class="clear"></div>
	</div><!-- app -->
	<!-- Footer -->
	<footer class="page-footer font-small bg-dark text-light">
	  <!-- Copyright -->
	  <div class="footer-copyright text-center py-3">© 2020 Copyright:
	    <a href="https://quantum-i.com.sg/">Quantum Interactive</a>
	  </div>
	  <!-- Copyright -->
	</footer>
	<!-- Footer -->
	<div class="load-icon"></div>
</body>
<script>
	function showIcon() {
		$('.load-icon').show();
	}
	function hideIcon() {
		$('.load-icon').fadeOut(1000);
	}

	$(function() {
		$('.load-icon').fadeOut('slow');
		$(document).on('click', '.sp-link', function(e) {
			e.preventDefault();
			showIcon();
			$.ajax({
				type: 'POST',
				url: $(this).attr('href'),
				dataType: 'html',
				success: function(data) {
					$('#app').html(data);
					hideIcon();
				}
			})
		});
		$(document).on('submit', '.sp-form', function(e) {
      e.preventDefault();
      showIcon();
      var values = $(this).serialize();
      $.ajax({
				url: $(this).attr('action'),
			  type: "post",
			  data: values,
			  dataType: 'html',
			  success: function(data) {
			  	$('#app').html(data);
					hideIcon();
			  }
      });
    })
    $(document).on('click', '.like-movie.fa-heart', function() {
			// e.stopPropagation();
			$(this).toggleClass("far fas");	

			$.ajax({
				url: '/movies/likeMovie',
				data: {imdbID: $(this).attr('data-id')},
				type: 'POST',
				success: function(data) {
				}
			})
		})
	});
</script>
</html>
