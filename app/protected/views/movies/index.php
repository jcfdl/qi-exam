<div class="row py-3">
	<div class="col-md-12">
		<div class="jumbotron">
		    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> | Movie List</h1>
		    <p>Check out the latest movies here!</p>
		</div>
	</div>
	<?php if($movies->Response == 'True'): ?>
		<?php foreach($movies->Search AS $key => $value): ?>
			<div class="col-md-3 movie-item">
				<div class="movie-header">
					<div class="movie-title float-left">
						Title: <span class="title"><?= $value->Title ?> (<?= $value->Year ?>)</span>
					</div>
					<div class="like-movie-wrapper">
						<i class="like-movie fa-heart <?= (in_array($value->imdbID, $likedMovie)) ? 'fas' : 'far' ?>" data-id="<?= $value->imdbID ?>"></i>
					</div>
				</div>
				<div class="movie-picture">
					<img src="<?= ($value->Poster!='N/A') ? $value->Poster : 'http://placehold.it/300x444' ?>" />
				</div>
				
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="col-md-12">
			<div class="jumbotron">
			    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> | Movie List</h1>
			    <p>Currently there are no movies as of the moment. Please come back again to get more!</p>
			</div>
		</div>
	<?php endif; ?>
	<div class="col-md-12">
		<nav aria-label="Page navigation example">
		  <ul class="pagination pagination-sm">
		    <li class="page-item <?= $page==1 ? 'disabled':'' ?>">
		    	<?php $prev = $page - 1; ?>
		    	<?php $next = $page + 1; ?>

		      <?= CHtml::link('<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>', array('movies/index', 'page' => $prev), array('class'=>'page-link'))?>
		    </li>
		    <?php for($i=1;$i<=$totalResults;$i++): ?>	
					<li class="page-item <?= $page==$i ? 'disabled':'' ?>">
						<?= CHtml::link($i, array('movies/index', 'page' => $i), array('class'=>'page-link'))?>
					</li>
		    <?php endfor; ?>
		    <li class="page-item <?= $page==$totalResults ? 'disabled':'' ?>">
		    	<?= CHtml::link('<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>', array('movies/index', 'page' => $next), array('class'=>'page-link'))?>
		    </li>
		  </ul>
		</nav>
	</div>
</div>