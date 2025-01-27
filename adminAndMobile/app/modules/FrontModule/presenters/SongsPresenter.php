<?php

namespace App\FrontModule\Presenters;

use App\Forms\SearchFormFactory;
use App\Model\AddressProvider;
use App\Model\Entity\Address;
use App\Model\Entity\Genre;
use App\Model\GenresManager;
use App\Model\QueueManager;
use App\Model\SongsManager;
use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Tracy\Debugger;

class SongsPresenter extends BasePresenter
{

	/** @var SearchFormFactory @inject */
	public $searchFormFactory;

	/** @var SongsManager @inject */
	public $songsManager;

	/** @var GenresManager @inject */
	public $genresManager;

	/** @var AddressProvider @inject */
	public $addressProvider;

	/** @var Genre[] */
	private $genres;

	/** @var double */
	private $pricePerSong;

	/** @var QueueManager @inject */
	public $queueManager;

	/** @var Address */
	private $address;

	/** @var string @persistent */
	public $search;

	public function actionDefault()
	{
		$this->genres = $this->genresManager->getAllNonEmptyGenres();
	}

	public function renderDefault()
	{
		$this->template->genres = $this->genres;
		$this->template->songsWithoutGenre = $this->songsManager->getSongsWithoutGenre();
		/** Song[][] */
		$songs = [];
		foreach ($this->genres as $genre) {
			$songs[$genre->getId()] = $this->songsManager->getSongsByGenreId($genre->getId());
		}
		$this->template->songs = $songs;
	}

	public function createComponentSearchForm()
	{
		$form = $this->searchFormFactory->create();
		return $form;
	}

	public function createComponentOrderForm()
	{
		$form = new Form();
		foreach ($this->songsManager->getSongAlphaNumericIds() as $song) {
			$form->addCheckbox($song);
		}
		$form->addSubmit('order', 'Objednat');
		$form->onValidate[] = $this->atLeastOneSongSelected;
		$form->onSuccess[] = $this->orderSongs;
		return $form;
	}

	public function atLeastOneSongSelected(Form $form)
	{
		$songsArray = $form->getValues();
		$songs = [];
		foreach ($songsArray as $song => $selected) {
			if ($selected) {
				$songs[] = Strings::replace($song, '~_~', '-');
			}
		}
		if (count($songs) == 0) {
			$form->addError('Musíte objednat alespoň jednu skladbu.');
		}

	}

	public function orderSongs(Form $form)
	{
		$songsArray = $form->getValues();
		$songIds = [];
		foreach ($songsArray as $song => $selected) {
			if ($selected) {
				$songIds[] = Strings::replace($song, '~_~', '-');
			}
		}
		$amount = $this->pricePerSong * count($songIds);
		$address = $this->addressProvider->getFreeAddress();
		$this->queueManager->orderSongs($songIds, $amount, $address);
		$this->redirectUrl("bitcoin:{$address->getAddress()}?amount={$amount}");
	}

//	public function actionOrder(string $songIds)
//	{
//		$songIdsArray = Strings::split($songIds, '~, ~');
//		$amount = $this->pricePerSong * count($songIdsArray);
//		$this->address = $this->addressProvider->getFreeAddress();
//		$this->queueManager->orderSongsFromIds($songIdsArray, $amount, $this->address);
//	}
//
//	public function renderOrder(string $songIds)
//	{
//		$songIdsArray = Strings::split($songIds, '~, ~');
//		$amount = $this->pricePerSong * count($songIdsArray);
//		$address = $this->address->getAddress();
//		$this->redirectUrl("bitcoin:{$address}?amount={$amount}");
//		$this->template->amount = $amount;
//		$this->template->address = $address;
//
//		$renderer = new \BaconQrCode\Renderer\Image\Png();
//		$renderer->setHeight(250);
//		$renderer->setWidth(250);
//		$renderer->setMargin(0);
//		$writer = new \BaconQrCode\Writer($renderer);
//		$url = "bitcoin:$address?amount=$amount";
//		$this->template->qrcode = base64_encode($writer->writeString($url));
//	}
//
//	private function modify(string $string) : string
//	{
//		$string = Strings::webalize($string);
//		$string = Strings::replace($string, '~-~', '_');
//		return $string;
//	}

	/**
	 * @param float $pricePerSong
	 */
	public function setPricePerSong($pricePerSong)
	{
		$this->pricePerSong = $pricePerSong;
	}

}
