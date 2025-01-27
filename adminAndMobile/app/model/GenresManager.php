<?php

namespace App\Model;

use App\Model\Entity\Genre;
use App\Model\Entity\Song;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\Object;
use Nette\Utils\FileSystem;
use Nette\Utils\Finder;
use Tracy\Debugger;

class GenresManager extends Object
{

	/** @var string */
	private $songsDirectory;

	/** @var EntityManager */
	private $entityManager;

	/** @var EntityRepository */
	private $genreRepository;

	public function __construct(EntityManager $entityManager, string $songsDirectory)
	{
		$this->entityManager = $entityManager;
		$this->songsDirectory = $songsDirectory;
		$this->genreRepository = $entityManager->getRepository(Genre::getClassName());
	}

	public function countAllGenres() : int
	{
		return $this->genreRepository->countBy([]);
	}

	/**
	 * @return Genre[]
	 */
	public function getAllGenres() : array
	{
		return $this->genreRepository->findAll();
	}

	/**
	 * @return Genre[]
	 */
	public function getAllNonEmptyGenres() : array
	{
		$qb = $this->entityManager->createQueryBuilder();
		$qb2 = $this->entityManager->createQueryBuilder();
		$qb2->select('IDENTITY(song.genre)')->from(Song::getClassName(), 'song')
			->distinct();
		$qb->select('genre')->from(Genre::getClassName(), 'genre')
			->where('genre.id IN (' .
				$qb2->getDQL()
				. ')');
		return $qb->getQuery()->getResult();
	}

	/**
	 * @return string[]
	 */
	public function getAllGenreNames() : array
	{
		$qb = $this->entityManager->createQueryBuilder();
		$qb->select('g.name')->from(Genre::getClassName(), 'g');
		return array_column($qb->getQuery()->getScalarResult(), 'name');
	}

	/**
	 * @return string[]
	 */
	public function getAllGenreIdsAndNames() : array
	{
		return $this->genreRepository->findPairs([], 'name');
	}

	public function addGenre(string $name)
	{
		if ($this->genreExists($name)) {
			return;
		}

		$genre = new Genre($name);
		$this->entityManager->persist($genre);
		$this->entityManager->flush($genre);
	}

	public function getGenre(int $id) : Genre
	{
		return $this->genreRepository->find($id);
	}

	public function genreExists(string $name) : bool
	{
		return $this->genreRepository->countBy(['name' => $name]) > 0;
	}

}