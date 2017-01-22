<?php

namespace App\Component;

final class MovieRatingList extends EntityRatingList
{
    public function __construct(
        \App\Model\RatingMovieModel $ratingMovieModel)
    {
        parent::__construct();
        $this->model = $ratingMovieModel;
    }
}