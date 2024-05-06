<?php
class Model
{
	//Запрос всех категорий
	public static function getCategories()
	{
		$sql = "SELECT * FROM `categories`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

	public static function getTournaments()
	{
		$sql = "SELECT * FROM `tournaments`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	
	public static function getClubs()
	{
		$sql = "SELECT * FROM `clubs`";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

	//Запрос новостей по ид
	public static function getNewsCode($code)
	{
		$sql = "SELECT * FROM `news` WHERE `id`='" . $code . "'";
		$db = new database();
		$item = $db->getOne($sql);
		return $item;
	}
	//Запрос для новостей по категориям
	public static function getNewsByCategories($categoryId)
	{
		$sql = "SELECT news.* FROM `news`, categories WHERE news.categoryID=categories.id AND news.categoryID ='" . $categoryId . "' ORDER BY news.id DESC";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

	//Запрос для игроков по категориям
	public static function getPlayersByCategories($categoryId)
	{
		$sql = "SELECT players.* FROM `players`, categories WHERE players.categoryId=categories.id AND players.categoryId ='" . $categoryId . "' ORDER BY players.lastname";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}

	//Запрос категорий по ид
	public static function getCategoriesCode($categoryId)
	{
		$sql = "SELECT * FROM categories WHERE categories.id ='" . $categoryId . "'";
		$db = new database();
		$item = $db->getOne($sql);
		return $item;
	}

	//Поиск игрока
	public static function playerSearch($searchQuery)
	{
		$db = new Database();
		$sql = "SELECT * FROM `players` WHERE firstname LIKE :searchQuery OR lastname LIKE :searchQuery";
$sql="SELECT players.*, clubs.title as cl1, clubs2.title as cl2 FROM `players`, clubs,clubs as clubs2 WHERE players.clubid=clubs.id and players.nat_team=clubs2.id and (players.firstname LIKE :searchQuery OR players.lastname LIKE :searchQuery)";
		$stmt = $db->conn->prepare($sql);
		$stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Select Category in tournamets
	public static function selectTournamets($id)
	{
		$sql = "SELECT * FROM `tournaments` WHERE `categoryId`='" . $id . "'";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
	//Select tour detail in tourdetail
	public static function selectTournametsDetail($id)
	{
		$sql = "SELECT tourdetail.*,clubs.title as cl1,clubs.banner as ban1, clubs.country as country, clubs2.title as cl2, clubs2.banner as ban2, clubs2.country as country2 FROM `tourdetail`,clubs,clubs as clubs2 WHERE tourdetail.clubid_1=clubs.id and tourdetail.clubid_2=clubs2.id and `tournametsId`='" . $id . "'  ORDER BY tourdetail.date DESC";
		$db = new database();
		$item = $db->getAll($sql);
		return $item;
	}
}
