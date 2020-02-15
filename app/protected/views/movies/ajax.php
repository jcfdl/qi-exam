<?php $chk_arr = array() ?>
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