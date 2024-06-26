<?php
class Controller
{
	//стартовая страница
	public static function StartSite()
	{
		$allcategories = Model::getCategories();
		include_once('view/homepage.php');
		return;
	}

	//Каталог новостей
	public static function sportCatalogue()
	{
		$allcategories = Model::getCategories();
		include_once('view/sportCatalogue.php');
	}
	//Турниры
	public static function tourcat()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$select_tour = Model::selectTournamets($id);
		}
		if(isset($_POST['send'])){
			$addMatch = ModelAdmin::addMatch();
		}
		$allcategories = Model::getCategories();
		include_once('view/tournaments_cat.php');
	}

	public static function tourdetail()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$select_tour_detail = Model::selectTournametsDetail($id);
		}
		$allcategories = Model::getCategories();
		include_once('view/tournaments_cat.php');
	}

	public static function contacts()
	{
		$allcategories = Model::getCategories();
		include_once('view/contacts.php');
	}

	//Новости по категориям
	public static function newsByCategories($categoryId)
	{
		$allcategories = Model::getCategories();
		$newsByCategories = Model::getNewsByCategories($categoryId);
		$category = Model::getCategoriesCode($categoryId);
		include_once('view/newsByCategories.php');
	}
	//Игроки по категориям
	public static function playersByCategories($categoryId)
	{
		$allcategories = Model::getCategories();
		$playersByCategories = Model::getPlayersByCategories($categoryId);
		$category = Model::getCategoriesCode($categoryId);
		include_once('view/playersByCategories.php');
	}

	//Поиск игрока по названию
	public static function SearchPlayer($searchQuery)
	{
		$allcategories = Model::getCategories();
		$players = Model::playerSearch($searchQuery);
		include_once('view/searchPlayer.php');
		return;
	}

	//Страница с ошибкой
	public static function error404()
	{
		$allcategories = Model::getCategories();
		include_once('view/error404.php');
		return;
	}
} //END CLASS
