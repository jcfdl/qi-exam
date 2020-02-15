<nav class="navbar navbar-expand-md bg-primary navbar-dark">
  <div class="container">
    <?php if(!Yii::app()->user->isGuest): ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">         
          <li class="nav-item">
            <?= CHtml::link('QI Movie', array('movies/index'), array('class'=>'navbar-brand')) ?>
          </li>
          <li class="nav-item">
            <?= CHtml::link('Liked Movies', array('movies/likes'), array('class'=>'nav-link active sp-link')) ?>
          </li>
        </ul>
      </div>
    <?php else: ?>
      <?= CHtml::link('QI Movies', array('site/index'), array('class'=>'navbar-brand')) ?>
    <?php endif; ?>    
      
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php if(Yii::app()->user->isGuest): ?>
          <?= CHtml::link('<i class="fas fa-sign-in-alt"></i>', array('site/login'), array('class'=>'sp-link nav-link active')) ?>
        <?php else: ?>
          <?= CHtml::link('<i class="fas fa-power-off"></i>', array('site/logout'), array('class'=>'nav-link active')) ?>
        <?php endif; ?>
      </li>   
    </ul>
  </div>  
</nav>