<?php

require_once 'Song.php';

/**
 * Created by PhpStorm.
 * User: Azathoth
 * Date: 14. 3. 2016
 * Time: 15:41
 */
class SongProvider
{

	/** @var PDO */
	private $connection;

	/** @var string */
	private $webSongsDir;

	/** @var string */
	private $filesystemSongsDir;

	public function __construct(string $host, string $dbName, string $username, string $password, string $songsDirectory, string $webSongsDir, int $port) {
		$this->connectToDatabase($host, $dbName, $username, $password, $port);
		$this->webSongsDir = $webSongsDir;
		$this->filesystemSongsDir = $songsDirectory;
	}

	private function connectToDatabase(string $host, string $dbName, string $username, string $password, int $port)
	{
		$dsn = "mysql:dbname=$dbName;host=$host;port=$port;charset=utf8";

		try {
			$this->connection = new PDO($dsn, $username, $password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			throw new Exception('Connection failed: ' . $e->getMessage());
		}
	}

	/**
	 * @return Song[]
	 */
	public function readNonProcessedSongs() : array
	{
		$stmt = $this->connection->prepare('SELECT song.id, song.name, queue.id AS queueId, song.album_cover, song.artist, song.title, song.duration FROM song JOIN queue ON song.id = queue.song WHERE queue.paid = TRUE AND queue.proceeded = FALSE');
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//		var_dump($result);

		$queueIds = array_column($result, 'queueId');

		/** @var Song[] $data */
		$data = [];
		foreach ($result as $songData) {
			$song = new Song($songData['name'], "$this->webSongsDir/{$songData['id']}.mp3", "$this->filesystemSongsDir/{$songData['id']}.mp3", $songData['album_cover'], $songData['artist'], $songData['title'], $songData['duration']);
			$data[] = $song;
		}

//		var_dump($data);

		if (count($queueIds) > 0) {
			$quotedIds = array_map(function($id) {return $this->connection->quote($id);}, $queueIds);
			$stmt = $this->connection->prepare('UPDATE queue SET proceeded = TRUE WHERE id IN ('. implode(',', $quotedIds) . ')');
//			echo $stmt->queryString . PHP_EOL;
			$stmt->execute();
		}

		return $data;
	}

	public function getRandomSong(int $genreId) : Song
	{
		//todo: ošetřit, aby bylo možno objednávat jen žánry s alespoň jednou písní
		$stmt = $this->connection->prepare('SELECT song.id, song.name, song.album_cover, song.artist, song.title, song.duration FROM song WHERE genre_id = :genreId ORDER BY RAND() LIMIT 1');
		$stmt->execute(['genreId' => $genreId]);
		$songData = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$songData) {   //vybraný žánr nemá žádnou skladbu
			$stmt = $this->connection->prepare('SELECT song.id, song.name, song.album_cover, song.artist, song.title, song.duration FROM song ORDER BY RAND() LIMIT 1');
			$stmt->execute();
			$songData = $stmt->fetch(PDO::FETCH_ASSOC);
		}
//		echo 'song name: ' . $songData['name'] .  ', album cover:' . $songData['album_cover'] . PHP_EOL;
		$song = new Song($songData['name'], "$this->webSongsDir/{$songData['id']}.mp3", "$this->filesystemSongsDir/{$songData['id']}.mp3", $songData['album_cover'], $songData['artist'], $songData['title'], $songData['duration']);
		return $song;
	}

}