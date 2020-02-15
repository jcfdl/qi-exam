<div class="row py-3">	
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
	<div class="col-md-12 mt-3 text-right">
		<nav aria-label="Page navigation example">
		  <ul class="pagination justify-content-end">
		    <li class="page-item <?= $page==1 ? 'disabled':'' ?>">
		    	<?php $prev = $page - 1; ?>
		    	<?php $next = $page + 1; ?>

		      <?= CHtml::link('<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>', array('movies/indexPage', 'page' => $prev), array('class'=>'page-link sp-link'))?>
		    </li>
		    <?php for($i=1;$i<=$totalResults;$i++): ?>	
					<li class="page-item <?= $page==$i ? 'active':'' ?>">
						<?= CHtml::link($i, array('movies/indexPage', 'page' => $i), array('class'=>'page-link sp-link'))?>
					</li>
		    <?php endfor; ?>
		    <li class="page-item <?= $page==$totalResults ? 'disabled':'' ?>">
		    	<?= CHtml::link('<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>', array('movies/indexPage', 'page' => $next), array('class'=>'page-link sp-link'))?>
		    </li>
		  </ul>
		</nav>
	</div>
</div>