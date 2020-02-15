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