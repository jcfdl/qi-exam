<?php
	require '../vendor/autoload.php';
	class Movie extends CActiveRecord {
		private $site;
		private $apikey;
		private $movieapi;

		public function __construct() {
			parent::__construct();
			$this->site = 'http://www.omdbapi.com';
			$this->apikey = '6ed8a301';
			// $this->movieapi= $this->site . '&' . $this->apikey;
		}

		public function tableName() {
			return '{{users}}';
		}

		public function getMovieList($page) {
			$client = new GuzzleHttp\Client();
			$response = $client->request('GET', $this->site, [
				'query' => [
					'apikey' => $this->apikey, 
					's' => 'Avengers',
					'type' => 'movie',
					'page' => $page,
				]
			]);
			return json_decode($response->getBody());
		}

		public function getMovie($imdbID) {
			$client = new GuzzleHttp\Client();
			$response = $client->request('GET', $this->site, [
				'query' => [
					'apikey' => $this->apikey, 
					'i' => $imdbID
				]
			]);
			return json_decode($response->getBody());
		}
	}