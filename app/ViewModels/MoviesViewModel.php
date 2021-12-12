<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowmov;
    public $genres;
    public function __construct($popularMovies, $nowmov, $genres)
    {
        $this->popularMovies=$popularMovies;
        $this->nowmov=$nowmov;
        $this->genres=$genres;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }
    public function nowmov(){
        return $this->formatMovies($this->nowmov);
    }
    public function genres(){

        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id']=>$genre['name']];
        });
    }
    private function formatMovies($movies){

        return collect($movies)->map(function($movie){
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($movie)->merge([
                'poster_path'=> "https://image.tmdb.org/t/p/w500/".$movie['poster_path'],
                'vote_average'=> $movie['vote_average']* 10 . '%',
                'release_date'=> Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres'=>$genresFormatted
            ])->only([
                'poster_path', 'vote_average', 'release_date', 'genres', 'genre_ids',
                'title', 'overview', 'id'
            ]);
        });
    }
}
