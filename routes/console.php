<?php

use App\Models\Api;
use App\Models\Game;
use App\GameMonetize;
use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();*/

Schedule::call(function(){
$api_info = Api::find(1);

    $game_monetize = new GameMonetize();
    $game_list = $game_monetize->get_games($api_info->page);

    if (@sizeof($game_list) > 0) {
        //page function
        $list_count = sizeof($game_list);
        //echo $list_count."<br />";
        if ($list_count > 499) {
            //$page = 1;
            //update API Page
        $table = Api::find(1);
        $table->page = $table->page + 1;
        $table->save();
        } else {
            //$page = 0;
            //update API Page
        $table = Api::find(1);
        $table->page = 1;
        $table->save();
        }
        //echo $page;

        foreach ($game_list as $item) {
            //check game ID
            $game_id = (int)$item['id'];
            $game_id_check = Game::where('game_id', $game_id)->count();
            if ($game_id_check < 1) {
                //check Category
                $category_check = Category::where('name', $item['category'])->count();
                if ($category_check < 1) {
                    $table = new Category();
                    $table->name = $item['category'];
                    $table->save();
                    $category_info = $table;
                } else {
                    $category_info = Category::where('name', $item['category'])->first();
                }
                //enter game
                $table = new Game();
                $table->game_id = $game_id;
                $table->title = $item['title'];
                $table->description = $item['description'];
                $table->instructions = $item['instructions'];
                $table->url = $item['url'];
                $table->category_id = $category_info->id;
                $table->tags = $item['tags'];
                $table->thumb = $item['thumb'];
                $table->width = $item['width'];
                $table->height = $item['height'];
                $table->api_id = 1;
                $table->save();

                //update API
                $table = Api::find(1);
                $table->games = $table->games + 1;
                $table->save();
            }
        }
        
    }
    else
    {
        //update API Page
        $table = Api::find(1);
        $table->page = 1;
        $table->save();
    }
})->everyFifteenMinutes();
