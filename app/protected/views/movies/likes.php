<div class="row py-3">	
	<?php if(count($movies) > 0): ?>
		<div class="col-md-12">
			<div class="jumbotron">
			    <h1>Welcome to your liked movies!</h1>
			    <p>Check out your liked movies here!</p>
			</div>
		</div>
		<?php foreach($movies AS $key => $value): ?>
			<div id="<?= $value->imdbID ?>" class="col-md-3 movie-item">				
				<div class="movie-picture">
					<img src="<?= ($value->poster!='N/A') ? $value->poster : 'http://placehold.it/300x444' ?>" />
				</div>
				<div class="movie-title">
					<span class="title"><?= CHtml::link($value->title, array('movies/view', 'imdbID'=>$value->imdbID), array('class'=>'sp-link')) ?></span> <span class="year">(<?= $value->year ?>)</span>
				</div>
				<div class="like-movie-wrapper">
					<div class="like-num">
						Likes: <span class="like-total"><?= (isset($totalLikes[$value->imdbID]) ? $totalLikes[$value->imdbID] : '0') ?></span>
					</div>
					<div class="like-sign">
						<i class="like-movie fa-heart fas"data-status="1" data-id="<?= $value->imdbID ?>"></i>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="col-md-12">
			<div class="jumbotron">
			    <h1>Welcome to your liked movies!</h1>
			    <p>Currently you did not have any liked movies.</p>
			</div>
		</div>
	<?php endif; ?>
</div>