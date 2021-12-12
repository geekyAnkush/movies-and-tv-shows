<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class SearchViewModel extends ViewModel
{
    public $searchResults;
    public function __construct($searchResults)
    {
        $this->searchResults=$searchResults;
    }
    public function searchResults(){

        return collect($this->searchResults)->map(function($res){
            $flag=0;
            if($res['media_type'] === 'movie'){
                $link = url('movies',$res['id']);
                $title = $res['title'];
                $image = "https://image.tmdb.org/t/p/w500/".$res['poster_path'];
                if ($res['poster_path']){$flag=1;}
            }
            elseif ($res['media_type'] === 'tv'){
                $link=url('tv',$res['id']);
                $title = $res['name'];
                $image = "https://image.tmdb.org/t/p/w500/".$res['poster_path'];
                if ($res['poster_path']){$flag=1;}
            }
            else{
                $link=url('actors',$res['id']);
                $title = $res['name'];
                $image = "https://image.tmdb.org/t/p/w500/".$res['profile_path'];
                if ($res['profile_path']){$flag=1;}
            }

            return collect($res)->merge([
                'link'=> $link,
                'title'=>$title,
                'img'=>($flag===1) ? $image: "https://via.placeholder.com/50x75",
            ]);
        })->take(7);
    }
}
