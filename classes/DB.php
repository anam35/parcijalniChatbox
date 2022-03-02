<?php
namespace DB;
use PDO;

class DB{
	private static $instance = null;
	private $conn;

	private $host;
	private $user;
	private $pass;
	private $name;
	private $driver;

	private function __construct($parametriSpajanja){
		$this->driver=$parametriSpajanja['driver'];
		$this->host=$parametriSpajanja['host'];
		$this->name=$parametriSpajanja['database'];
		$this->user=$parametriSpajanja['username'];
		$this->pass=$parametriSpajanja['password'];

		$this->conn = new PDO(
			"{$this->driver}:host={$this->host};
			dbname={$this->name}",
			$this->user,
			$this->pass,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
		);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function getInstance($polje){
		if(!self::$instance){
			self::$instance = new DB($polje);
		}

		return self::$instance;
	}

	public function getConnection(){
		return $this->conn;
	}

	public function getChats(){
		try {
			$stmt = $this->conn->prepare("SELECT users.username, chats.text, chats.timestamp FROM chats LEFT JOIN users ON users.id = chats.ownerId order by chats.timestamp asc");
			$stmt->execute();

			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$data = $stmt->fetchAll();
			return $data;
		} catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
	}

	public function createTask($newID, $newText){
		try {
			$stmt = $this->conn->prepare("INSERT INTO chats (ownerId, text) VALUES (:ownerId, :text)");
			$stmt->bindParam(':ownerId', $newID);
			$stmt->bindParam(':text', $newText);
			// use exec() because no results are returned
			$stmt->execute();
			return true;
		} catch(PDOException $e) {
			echo $stmt . "<br>" . $e->getMessage();
		}
	}

	public function AuthenticateUser($username){
		try {
			$stmt = $this->conn->prepare("INSERT INTO users (username) VALUES (:username)");
			$stmt->bindParam(':username', $username);
			// use exec() because no results are returned
			$stmt->execute();
			$last_id = $this->conn->lastInsertId();
			$_SESSION["username"] = $username;
			$_SESSION["last_id"] = $last_id;
			return true;
		} catch(PDOException $e) {
			echo $stmt . "<br>" . $e->getMessage();
		}
	}
	public function BackToLanding(){
		header("Location: index.php");
	}
}
