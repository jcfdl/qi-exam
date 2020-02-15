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
				'actions'=>array('index', 'likeMovie'),
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
		$movie = new Movie;
		$page = $page ? $page : 1;
		// print_r($movie->getMovieList());exit();
		$res = $movie->getMovieList($page);
		// get total results
		$total = $res->totalResults/10;
		$_total = round($total);
		if($total > $_total) 
			$_total+=1;

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
				'likedMovie'=>$like_arr
			)
		);
	}

	public function actionLikes() {
		echo 'Like movies';
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

}