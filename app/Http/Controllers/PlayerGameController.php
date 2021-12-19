<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\PlayerGame;
use Illuminate\Http\Request;
use Validator;

class PlayerGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playerGames = PlayerGame::all();

        return response([
            "playerGames" => $playerGames,
            "message" => "Uspesno",
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = Player::find($request->player_id);
        $game = Game::find($request->game_id);

        if (!$player || !$game) {
            return response([
                'playerGame' => null,
                'message' => 'player / game nisu pronadjeni.',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'player_id' => 'required|integer',
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response([
                'playerGame' => null,
                'message' => 'Validacija neuspesna.',
                'errors' => $validator->messages(),
            ], 400);
        }

        $playerGame = new PlayerGame();

        $playerGame->player_id = $request->player_id;
        $playerGame->game_id = $request->game_id;

        $playerGame->save();

        return response([
            "playerGame" => $playerGame,
            "message" => "Uspeh.",
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playerGame = PlayerGame::find($id);

        if (!$playerGame) {
            return response([
                'playerGame' => null,
                'message' => 'Nije pronadjen resurs.',
            ], 404);
        }

        return response([
            "playerGame" => $playerGame,
            "message" => "Uspesno",
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $playerGame = PlayerGame::find($id);

        if (!$playerGame) {
            return response([
                'playerGame' => null,
                'message' => 'playerGame not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'player_id' => 'required|integer',
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response([
                'playerGame' => $playerGame,
                'message' => 'Validacija neuspesna.',
                'errors' => $validator->messages(),
            ], 400);
        }

        $playerGame->player_id = $request->player_id;
        $playerGame->game_id = $request->game_id;
        $playerGame->save();

        return response([
            "playerGame" => $playerGame,
            "message" => "Uspesno azuriranje.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playerGame = PlayerGame::find($id);

        if (!$playerGame) {
            return response([
                'playerGame' => null,
                'message' => 'Nije pronadjeno.',
            ], 404);
        }

        $playerGame->delete();

        return response([
            "playerGame" => $playerGame,
            "message" => "Uspeno izbrisano.",
        ], 200);
    }
}
