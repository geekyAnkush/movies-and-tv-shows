<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $poptv;
    public $toptv;
    public $genres;
    public function __construct($poptv, $toptv, $genres)
    {
        $this->poptv=$poptv;
        $this->toptv=$toptv;
        $this->genres=$genres;
    }

    public function poptv(){
        return $this->formatMovies($this->poptv);
    }
    public function toptv(){
        return $this->formatMovies($this->toptv);
    }
    public function genres(){

        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id']=>$genre['name']];
        });
    }
    private function formatMovies($tv){

        return collect($tv)->map(function($tv){
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tv)->merge([
                'poster_path'=> "https://image.tmdb.org/t/p/w500/".$tv['poster_path'],
                'vote_average'=> $tv['vote_average']* 10 . '%',
                'first_air_date'=> Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres'=>$genresFormatted
            ])->only([
                'poster_path', 'vote_average', 'first_air_date', 'genres', 'genre_ids',
                'name', 'overview', 'id'
            ]);
        });
    }
}
