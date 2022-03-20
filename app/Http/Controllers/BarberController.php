<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Barber;
use App\Models\BarberPhotos;
use App\Models\BarberServices;
use App\Models\BarberTestimonial;
use App\Models\BarberAvailability;

class BarberController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    // public function random()
    // {
    //     $array = ['error'=>''];

    //     for($q=0; $q<15; $q++) {
    //         $names = ['Boniek', 'Paulo', 'Pedro', 'Amanda', 'Leticia', 'Gabriel', 'Gabriela', 'Thais', 'Luiz', 'Diogo', 'José', 'Jeremias', 'Francisco', 'Dirce', 'Marcelo' ];
    //         $lastnames = ['Santos', 'Silva', 'Santos', 'Silva', 'Alvaro', 'Sousa', 'Diniz', 'Josefa', 'Luiz', 'Diogo', 'Limoeiro', 'Santos', 'Limiro', 'Nazare', 'Mimoza' ];

    //         $servicos = ['Corte', 'Pintura', 'Aparação', 'Unha', 'Progressiva', 'Limpeza de Pele', 'Corte Feminino'];
    //         $servicos2 = ['Cabelo', 'Unha', 'Pernas', 'Pernas', 'Progressiva', 'Limpeza de Pele', 'Corte Feminino'];

    //         $depos = [
    //             'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate consequatur tenetur facere voluptatibus iusto accusantium vero sunt, itaque nisi esse ad temporibus a rerum aperiam cum quaerat quae quasi unde.',
    //             'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate consequatur tenetur facere voluptatibus iusto accusantium vero sunt, itaque nisi esse ad temporibus a rerum aperiam cum quaerat quae quasi unde.',
    //             'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate consequatur tenetur facere voluptatibus iusto accusantium vero sunt, itaque nisi esse ad temporibus a rerum aperiam cum quaerat quae quasi unde.',
    //             'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate consequatur tenetur facere voluptatibus iusto accusantium vero sunt, itaque nisi esse ad temporibus a rerum aperiam cum quaerat quae quasi unde.',
    //             'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate consequatur tenetur facere voluptatibus iusto accusantium vero sunt, itaque nisi esse ad temporibus a rerum aperiam cum quaerat quae quasi unde.'
    //         ];

    //         $newBarber = new Barber();
    //         $newBarber->name = $names[rand(0, count($names)-1)].' '.$lastnames[rand(0, count($lastnames)-1)];
    //         $newBarber->avatar = rand(1, 4).'.png';
    //         $newBarber->stars = rand(2, 4).'.'.rand(0, 9);
    //         $newBarber->latitude = '-23.5'.rand(0, 9).'30907';
    //         $newBarber->longitude = '-46.6'.rand(0,9).'82759';
    //         $newBarber->save();

    //         $ns = rand(3, 6);

    //         for($w=0;$w<4;$w++) {
    //             $newBarberPhoto = new BarberPhotos();
    //             $newBarberPhoto->id_barber = $newBarber->id;
    //             $newBarberPhoto->url = rand(1, 5).'.png';
    //             $newBarberPhoto->save();
    //         }

    //         for($w=0;$w<$ns;$w++) {
    //             $newBarberService = new BarberServices();
    //             $newBarberService->id_barber = $newBarber->id;
    //             $newBarberService->name = $servicos[rand(0, count($servicos)-1)].' de '.$servicos2[rand(0, count($servicos2)-1)];
    //             $newBarberService->price = rand(1, 99).'.'.rand(0, 100);
    //             $newBarberService->save();
    //         }

    //         for($w=0;$w<3;$w++) {
    //             $newBarberTestimonial = new BarberTestimonial();
    //             $newBarberTestimonial->id_barber = $newBarber->id;
    //             $newBarberTestimonial->name = $names[rand(0, count($names)-1)];
    //             $newBarberTestimonial->rate = rand(2, 4).'.'.rand(0, 9);
    //             $newBarberTestimonial->body = $depos[rand(0, count($depos)-1)];
    //             $newBarberTestimonial->save();
    //         }


    //         }
    //     return $array;
    // }

    public function list(Request $request)
    {
        $array = ['error' => ''];

        $barbers = Barber::all();

        foreach ($barbers as $bkey => $bvalue) {
            $barbers[$bkey]['avatar'] = url('media/avatars/'.$barbers[$bkey]['avatar']);
        }

        $array['data'] = $barbers;
        $array['loc'] = 'São Paulo';

        return $array;
    }
}
