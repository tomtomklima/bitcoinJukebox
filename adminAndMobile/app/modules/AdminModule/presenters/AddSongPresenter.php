<?php

namespace App\AdminModule\Presenters;

use App\Forms\AddSongFormFactory;
use App\Model\GenresManager;
use App\Model\SongsManager;
use Nette\Application\UI\Form;
use Nette\Http\FileUpload;
use Tracy\Debugger;

class AddSongPresenter extends BasePresenter
{

	/** @var AddSongFormFactory @inject */
	public $addSongFormFactory;

	/** @var SongsManager @inject */
	public $songsManager;

	/** @var GenresManager @inject */
	public $genresManager;

	/** @var string */
	private $genre;

	public function actionDefault($genre = null)
	{
		$this->genre = $genre;
	}

	public function renderDefault($genre = null)
	{
	}

	public function createComponentAddSongForm()
	{
		$form = $this->addSongFormFactory->create($this->genre);
		$form->onSuccess[] = $this->addSong;
		return $form;
	}

	public function addSong(Form $form, array $values)
	{
		/** @var FileUpload $songFile */
		$songFiles = $values['song'];
		$genreId = $values['genre'];
		$onlyOneSong = count($songFiles) == 1;
		$uploadOk = true;
		foreach ($songFiles as $songFile) {
			if ($songFile->isOk()) {
				$this->songsManager->addSongFromHTTP($songFile, $genreId);
			} else {
				$uploadOk = false;
			}
		}
		if ($uploadOk) {
			if ($onlyOneSong) {
				$this->flashMessage('Skladba byla úspěšně přidána.', 'success');
			} else {
				$this->flashMessage('Skladby byly úspěšně přidány.', 'success');
			}
		} else {
			if ($onlyOneSong) {
				$this->flashMessage('Skladbu se nepodařilo přidat.', 'error');
			} else {
				$this->flashMessage('Skladby se nepodařilo přidat.', 'error');
			}
		}
		$this->redirect('this');
	}

}
