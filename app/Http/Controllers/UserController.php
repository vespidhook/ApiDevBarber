<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserFavorite;
use App\Models\Barber;

class UserController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function read()
    {
        $array = ['error' => ''];

        $info = $this->loggedUser;
        $info['avatar'] = url('media/avatars/' . $info['avatar']);

        $array['data'] = $info;

        return $array;
    }

    public function addFavorite(Request $request)
    {
        $array = ['error' => ''];

        $id_barber = $request->input('barber');

        $barber = Barber::find($id_barber);

        if($barber) {
            $hasFav = UserFavorite::select()
                ->where('id_user', $this->loggedUser->id)
                ->where('id_barber', $barber)
            ->count();

            if($hasfav === 0) {
                //adicionar
                $newFav = new UserFavorite();
                $newFav->id_user = $this->loggedUser->id;
                $newFav->id_barber = $barber;
                $newFav->save();
            } else {
                // remover
                $fav = UserFavorite::select()
                    ->where('id_user', $this->loggedUser->id)
                    ->where('id_barber', $barber)
                ->first();

                $fav->remove();
            }
        } else {
            $array['error'] = 'Barbeiro não encontrado';
        }

        return $array;
    }
}
