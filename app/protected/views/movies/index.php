<?php if($movies->Response == 'True'): ?>
	<?php foreach($movies->Search AS $key => $value): ?>
		<div class="movie-item">
			<h3 class="movie-title">
				<?= $value->Title ?> (<?= $value->Year ?>)
			</h3>
			<div class="movie-picture">
				<img src="<?= $value->Poster ?>" />
			</div>
			<div class="like-movie-wrapper">
				<i class="like-movie fa-heart <?= (in_array($value->imdbID, $likedMovie)) ? 'fas' : 'far' ?>" data-id="<?= $value->imdbID ?>"></i>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p>No movies</p>
<?php endif; ?>

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

<script>
	$('.like-movie.fa-heart').on('click', function() {
		// e.stopPropagation();
		$(this).toggleClass("far fas");	

		$.ajax({
			url: '/movies/likeMovie',
			data: {imdbID: $(this).attr('data-id')},
			type: 'POST',
			success: function(data) {
			}
		})
	});
</script>