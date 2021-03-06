<?php

namespace App\Component;

final class StatUserRadar extends \Nepttune\Component\BaseComponent
{
    /** @var \App\Model\UserModel */
    protected $userModel;

    public function __construct(
        \Nepttune\Model\Authenticator $userModel)
    {
        $this->userModel = $userModel;
    }

    public function render() : void
    {
        $user = $this->userModel->findRow($this->getPresenter()->getUser()->getId())->fetch();

        $this->template->statMovie = $user->ratings_movie;
        $this->template->statSeries = $user->ratings_series;
        $this->template->statSeason = $user->ratings_season;
        $this->template->statBook = $user->ratings_book;
        $this->template->statMusic = $user->ratings_music;
        $this->template->statGame = $user->ratings_game;

        $max = $this->userModel->getMaxRatings();

        $this->template->percentMovie = $max->movie ? $this->template->statMovie  / $max->movie : 0;
        $this->template->percentSeries = $max->series ? $this->template->statSeries  / $max->series : 0;
        $this->template->percentSeason = $max->season ?$this->template->statSeason  / $max->season : 0;
        $this->template->percentBook = $max->book ? $this->template->statBook  / $max->book : 0;
        $this->template->percentMusic = $max->music ? $this->template->statMusic  / $max->music : 0;
        $this->template->percentGame = $max->game ?$this->template->statGame / $max->game : 0;

        $this->template->setFile(__DIR__.'/StatUserRadar.latte');
        $this->template->render();
    }
}
