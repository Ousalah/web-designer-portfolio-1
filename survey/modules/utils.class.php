<?php 
// include_once 'config.php';
class Utils
{
	private static $cnx=null;
	public static function connecter_db()
	{
		$options=array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'");
		if(!self::$cnx){
			/* self::$cnx = new PDO("mysql:host={HOST};dbname=".DB_NAME,USER_NAME,PASSE,$options);
			*/
			//
			self::$cnx = new PDO('mysql:host=localhost;dbname=surveys', "root", "", $options);
			//
		}
		return  self::$cnx;	
	}
	// used the first time in Survey Project
	public static function existTable(){
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("select 1 from survey LIMIT 1");

		$pr->execute();
		return $pr->fetchAll();
		 
	}	

	public static function createTable($db_info){
		$cnx=Utils::connecter_db();

		// $exist = Utils::existTable();
		// if($exist === FALSE)
		// {

		try {

			// first Drop exist table
			$dropQr = "DROP TABLE survey";
			$p=$cnx->prepare($dropQr);
			$p->execute();

			// create New Table
			// $query = "CREATE TABLE survey (id INT NOT NULL AUTO_INCREMENT ,";
			$query = "CREATE TABLE survey (";

				foreach ($db_info as $name => $dbType) {
					$query .= "$name $dbType NOT NULL ,";
				}
				// remove the last comma, if we do not have Primary Key in the las query
				$queryTrimComma = rtrim($query,',');
				$queryTrimComma .= ")";

				// $query .= "PRIMARY KEY (id))";
			$pr=$cnx->prepare($queryTrimComma);
			$pr->execute();

		} catch (Exception $e) {
			// create New Table
			// $query = "CREATE TABLE survey (id INT NOT NULL AUTO_INCREMENT ,";
			$query = "CREATE TABLE survey (";

				foreach ($db_info as $name => $dbType) {
					$query .= "$name $dbType NOT NULL ,";
				}
				// remove the last comma, if we do not have Primary Key in the las query
				$queryTrimComma = rtrim($query,',');
				$queryTrimComma .= ")";

				// $query .= "PRIMARY KEY (id))";
			$pr=$cnx->prepare($queryTrimComma);
			$pr->execute();
		}
			
		
	}


	// show columns of table
	public static function showColumns(){
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("SHOW COLUMNS FROM survey");

		$pr->execute();
		return $pr->fetchAll(PDO::FETCH_OBJ);
		 
	}	
	// en Survey Project

	public static function supprimer($table, $id, $nomid="id"){
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("delete from $table where $nomid=?");
		$pr->execute(array($id));
	}

	public static function upload($data)
	{
		# default filename
		$filename = "default_image.png";

		#dossier de destination
		$dossier = $data["dossier"];

		#récupération du nom réel de l'image + son extension
		$name = basename($data["name"]);

		#récupération de l'extension uniquement
		#strtolower changera l'extension en minuscule
		$extension = strtolower(pathinfo($data["name"], PATHINFO_EXTENSION));

		#allowed extentions
		$allowedExtention = array('png', 'jpg', 'jpeg');
		# vérification si le type de fichier est une image
		if(!in_array($extension, $allowedExtention)){
			return $filename;
		}

		$size = $data["size"];
		if($size > 8000000){
			die ("le fichier ne doit pas dépasser 8Mo");
		}

		#Nouveau Nom (crypter et unique)
		$newName = md5(date('ymdHsiu')."ousalah");

		#chemin d'upload
		$imagePath = $dossier."".$newName.".".$extension;

		#déplacement du fichier chargé en mémoire vers le dossier de destination
		#move_uploaded_file(fichier temporaire,la source)
		move_uploaded_file($data["tmp_name"], $imagePath);
		
		$filename = $newName.".".$extension;
		return $filename;

	}

	/**
	* @param $table (require) : table's name
	* @param $data (require) : data to insert : $_POST
	* @param $image (optional) : image info(dossier,name,tmp_name,size) : $_FILES
	**/
	public static function ajouter($table,$data=array(), $image=array()){
		$names=array();
		$values=array();
		$trous=array();
		foreach ($data as $key => $value) {

			// if there is Multi values for one field, like checkboks
			if(is_array($value)){ $value = "<b><u>aswers</u></b> : ".implode(', ', $value); }

			$names[]=$key;
			$values[]=$value;
			$trous[]='?';
		}
		# -- test if Isset image.
		if (($image!=array())) {
			$imagePath = Utils::upload($image);

			$names[] = "image";
			$values[] = $imagePath;
			$trous[] = '?';
		}

		$trousdb=implode(',', $trous);
		$namesdb=implode(',', $names);
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("insert into $table ($namesdb) values($trousdb)");
		var_dump($pr);
		$pr->execute($values);

		
	}

	public static function modifier(
		$table,
		$data=array(),
		$id,
		$image=array(), 
		$nomid="id"
	)
	{
		$names=array();
		$values=array();
		$trous=array();
		foreach ($data as $key => $value) {
			$names[]="$key=?";
			$values[]=$value;

		}

		# -- test if Isset image.
		if ($image!=array() && !empty($image["name"])) {
			
			$imagePath = Utils::upload($image);
			$names[] = "image=?";
			$values[] = $imagePath;
			
		}
		
		$namesdb=implode(',', $names);
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("update $table set $namesdb where
			$nomid=?
			");
		var_dump($pr);
		$values[]=$id;
		$pr->execute($values);

	}

	public static function get_all($table)
	{
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("select * from $table
			order by id desc");

		$pr->execute();
		return $pr->fetchAll(PDO::FETCH_OBJ);
	}

	public static function getAll_noOrderBy($table)
	{
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("select * from $table");

		$pr->execute();
		return $pr->fetchAll(PDO::FETCH_OBJ);
	}

	public static function get_by($table, $data=array(), $limit = 0)
	{
		$names=array();
		$values=array();

		// limiter nombre de resultats,
		if($limit > 0) $limit = "LIMIT $limit";
		else $limit = "";
		
		foreach ($data as $key => $value) {
			$names[]="$key=?";
			$values[]=$value;

		}
		$namesdb=implode(" and ", $names);
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("select * from $table
			where $namesdb order by id desc
			");
		$pr->execute($values);
		return $pr->fetchAll(PDO::FETCH_OBJ);
	}

	
	public static function set_value($nom)
	{
		session_regenerate_id();
		if(!empty($_POST[$nom]))
		{
			//setcookie($nom, $_POST[$nom], time()+60);
			if(isset($_SESSION)){
				$_SESSION[$nom] = $_POST[$nom];
			}
		}

		if(!empty($_SESSION[$nom])){
			echo $_SESSION[$nom];
		}

	}

	public static function creer_session()
	{ 
		if(!isset($_SESSION))
		session_start();
		session_regenerate_id(TRUE);

	}

	public static function set_val_session($notice_name, $notice_value)
	{
		self::creer_session();
	 	$_SESSION[$notice_name] = $notice_value;
		
	}

	public static  function get_notice($notice_name)
	{

		//self::creer_session();
		if(isset($_SESSION[$notice_name])){
			$x = $_SESSION[$notice_name];
			unset($_SESSION[$notice_name]);
			return $x;
		}else{
			return "";
		}
		
	}


	/**
	* get random result
	* @param $table : table name
	* @param $limit : numbre max of results
	**/
	public static function get_all_random($table, $limit = 0)
	{
		// limiter nombre de resultats,
		if($limit > 0) $limit = "LIMIT $limit";
		else $limit = "";

		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("select * from $table
			ORDER BY RAND() $limit");

		$pr->execute();
		return $pr->fetchAll(PDO::FETCH_OBJ);
	}



	/**
	* @param $table : table name
	* @param $conditions : array of conditions = array(
			"etat" => "en cours"
		);    
	* @param $atrCount : counted attributer 
	**/
	public static function get_count(
			$table, 
			$conditions = array(), 
			$atrCount = "id"
		)
	{
		
		$WHERE = "";
		$names = array();
		$values = array();

		if($conditions != array()){
			$WHERE = " WHERE ";

			foreach ($conditions as $key => $value) {
				$names[] = "$key = ?";
				$values[] = $value;
			}
			

		}

		$namesdb=implode(" and ", $names);
		$cnx=Utils::connecter_db();
		$pr=$cnx->prepare("SELECT COUNT(*) FROM $table
			$WHERE $namesdb");
		//var_dump($pr);

		$pr->execute($values);
		return $pr->fetchColumn();
	}	
}
 ?>