<div id="movies" class="row py-3">	
	<?php $chk_arr = array() ?>
	<?php if($movies->Response == 'True'): ?>
		<div class="col-md-12">
			<div class="jumbotron">
			    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> | Movie List</h1>
			    <p>Check out the latest movies here!</p>
			</div>
		</div>
		<?php foreach($movies->Search AS $key => $value): ?>
			<?php if(!in_array($value->imdbID, $chk_arr)): ?>
				<div id="<?= $value->imdbID ?>" class="col-md-3 movie-item">					
					<div class="movie-picture">
						<img src="<?= ($value->Poster!='N/A') ? $value->Poster : 'http://placehold.it/300x444' ?>" />
					</div>
					<div class="movie-title">
						<span class="title"><?= CHtml::link($value->Title, array('movies/view', 'imdbID'=>$value->imdbID), array('class'=>'sp-link')) ?></span> <span class="year">(<?= $value->Year ?>)</span>
					</div>
					<div class="like-movie-wrapper">
						<div class="like-num">
							Likes: <span class="like-total"><?= (isset($totalLikes[$value->imdbID]) ? $totalLikes[$value->imdbID] : '0') ?></span>
						</div>
						<div class="like-sign">
							<i class="like-movie fa-heart <?= (in_array($value->imdbID, $likedMovie)) ? 'fas' : 'far' ?>" data-id="<?= $value->imdbID ?>" <?= (in_array($value->imdbID, $likedMovie)) ? 'data-status="1"' : 'data-status="0"' ?>></i>
						</div>
					</div>
				</div>
				<?php $chk_arr[] = $value->imdbID; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="col-md-12">
			<div class="jumbotron">
			    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> | Movie List</h1>
			    <p>Currently there are no movies as of the moment. Please come back again to get more!</p>
			</div>
		</div>
	<?php endif; ?>
	<input id="page" type="hidden" value="1">
	<input id="all-page" type="hidden" value="<?= $totalResults ?>">
</div>
<script>
	$(document).on('scroll', function() {
		var position = $(window).scrollTop();
  	var bottom = $(document).height() - $(window).height();

	  if( position == bottom ){
	   var page = Number($('#page').val());
	   var allcount = Number($('#all-page').val());
	   page = page + 1;

	   if(page <= allcount){

			showIcon();
	    $('#page').val(page);
	    $.ajax({
	     url: '/movies/indexPage',
	     type: 'post',
	     data: {page:page},
	     dataType: 'html',
	     success: function(response){
	     	hideIcon();
	      $(".movie-item:last").after(response);
	     }
	    });
	   }
	  }
	});
</script>