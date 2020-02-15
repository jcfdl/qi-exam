<div class="row py-3">
	<div class="col-md-12 mb-2">
		<?= CHtml::link('<em class="fas fa-undo-alt"></em> Go back', array('movies/indexPage'), array('class'=>'btn btn-primary sp-link')) ?>
	</div>
	<div class="col-md-4">
		<img src="<?= ($movie->Poster!='N/A') ? $movie->Poster : 'http://placehold.it/300x444' ?>" />
	</div>
	<div id="<?= $movie->imdbID ?>" class="col-md-8">
		<p>Title: <strong><?= $movie->Title ?></strong></p>
		<p>Year Released: <strong><?= $movie->Year ?></strong></p>
		<p>Rated: <strong><?= $movie->Rated ?></strong></p>
		<p>Runtime: <strong><?= $movie->Runtime ?></strong></p>
		<p>Genre: <strong><?= $movie->Genre ?></strong></p>
		<p>Writer: <strong><?= $movie->Writer ?></strong></p>
		<p>Plot: <strong><?= $movie->Plot ?></strong></p>
		<p>Production: <strong><?= $movie->Production ?></strong></p>
		<p class="like-num">Likes: <strong class="like-total"><?= (count($totalLikes) > 0) ? count($totalLikes) : 0 ?></strong></p>
		<p><i class="like-movie fa-heart <?= ($liked) ? 'fas' : 'far' ?>" data-id="<?= $movie->imdbID ?>" <?= ($liked) ? 'data-status="1"' : 'data-status="0"' ?>></i></p>
	</div>
</div>