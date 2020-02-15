<?php

class MoviesController extends Controller
{
	public $layout = '/layouts/main';
	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions'=>array('index', 'likeMovie', 'indexPage', 'likes', 'view'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),				
			),
		);
	}

	public function labels()
	{
		return array(
			'index' => 'Movies',
		);
	}

	public function actionIndex($page = null) {
		$like_arr = array();
		$total_like_arr = array();
		$movie = new Movie;
		$page = $page ? $page : 1;
		// print_r($movie->getMovieList());exit();
		$res = $movie->getMovieList($page);
		// get total results
		$total = $res->totalResults/10;
		$_total = round($total);
		if($total > $_total) 
			$_total+=1;

		$totallikes = UserLike::model()->existing()->findAll(array(
			'select'=>'t.imdbID, COUNT(*) AS likesNum',
			'group'=>'t.imdbID',
		));
		foreach($totallikes AS $key=>$value) {
			$total_like_arr[$value->imdbID] = $value->likesNum;
		}
		$likes = UserLike::model()->existing()->findAllByAttributes(array(
			'user_id'=>Yii::app()->user->id
		));
		foreach($likes AS $key => $value) {
			$like_arr[] = $value->imdbID;
		}
		$this->render(
			'index',
			array(
				'movies'=>$res,
				'totalResults'=>$_total,
				'page'=>$page,
				'likedMovie'=>$like_arr,
				'totalLikes'=>$total_like_arr,
			)
		);
	}

	public function actionIndexPage() {
		$this->layout = '/layouts/blank';
		if(isset($_POST['page'])) {
			$like_arr = array();
			$total_like_arr = array();
			$movie = new Movie;
			$page = $_POST['page'];
			// print_r($movie->getMovieList());exit();
			$res = $movie->getMovieList($page);
			// get total results
			$total = $res->totalResults/10;
			$_total = round($total);
			if($total > $_total) 
				$_total+=1;

			$totallikes = UserLike::model()->existing()->findAll(array(
				'select'=>'t.imdbID, COUNT(*) AS likesNum',
				'group'=>'t.imdbID',
			));
			foreach($totallikes AS $key=>$value) {
				$total_like_arr[$value->imdbID] = $value->likesNum;
			}
			$likes = UserLike::model()->existing()->findAllByAttributes(array(
				'user_id'=>Yii::app()->user->id
			));
			foreach($likes AS $key => $value) {
				$like_arr[] = $value->imdbID;
			}
			$this->render(
				'ajax',
				array(
					'movies'=>$res,
					'likedMovie'=>$like_arr,
					'totalLikes'=>$total_like_arr,
				)
			);
		}
	}

	public function actionLikes($page = null) {
		$this->layout = '/layouts/blank';
		$like_arr = array();
		$total_like_arr = array();
		$movies = UserLike::model()->existing()->findAll(array(
			'condition'=>'user_id=:id',
			'params'=>array(':id'=>Yii::app()->user->id)	
		));
		$totallikes = UserLike::model()->existing()->findAll(array(
			'select'=>'t.imdbID, COUNT(*) AS likesNum',
			'group'=>'t.imdbID',
		));
		foreach($totallikes AS $key=>$value) {
			$total_like_arr[$value->imdbID] = $value->likesNum;
		}	
		$this->render(
			'likes',
			array(
				'movies'=>$movies,
				'totalLikes'=>$total_like_arr,
			)
		);
	}

	public function actionLikeMovie() {
		$movie_arr = array();
		if(isset($_POST['imdbID'])) {
			$like = UserLike::model()->findByAttributes(array(
					'user_id'=>Yii::app()->user->id,
					'imdbID'=>$_POST['imdbID'],
				));
			$movie = new Movie;
			$_movie = $movie->getMovie($_POST['imdbID']);
			$movie_arr['year'] = $_movie->Year;
			$movie_arr['imdbID'] = $_movie->imdbID;
			$movie_arr['user_id'] = Yii::app()->user->id;
			$movie_arr['type'] = $_movie->Type;
			$movie_arr['poster'] = $_movie->Poster;
			$movie_arr['title'] = $_movie->Title;

			if($like) {
				$like->poster = $movie_arr['poster'];
				$like->save();
 			} else {				
				$_like = new UserLike;
				$_like->attributes = $movie_arr;
				$validation = $_like->validate();
				if($validation) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						if(!$_like->save(false)) {
							throw new Exception('Error on saving user likes.');				
						}
						$transaction->commit();
					} catch(Exception $e) {
						$transaction->rollback();
					}
				}
			}

		}
	}

	public function actionView($imdbID) {
		$this->layout = '/layouts/blank';
		$movie = new Movie;
		$res = $movie->getMovie($imdbID);
		$liked =  UserLike::model()->existing()->find(array(
			'condition'=>'user_id=:id AND imdbID=:imdbID',
			'params'=>array(':id'=>Yii::app()->user->id, ':imdbID'=>$imdbID)	
		));
		$totallikes = UserLike::model()->existing()->findAll(array(
			'condition'=>'imdbID=:imdbID',
			'params'=>array(':imdbID'=>$imdbID),
		));
		$this->render(
			'view',
			array(
				'movie'=>$res,
				'liked'=>$liked,
				'totalLikes'=>$totallikes,
			)
		);

	}

}