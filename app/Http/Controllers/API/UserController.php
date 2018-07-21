<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\CreateUserRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\User;
use App\Order;
use App\OrderItem;
use App\SoccerExpertRound;
use App\Repositories\API\User\UserContract;
use Illuminate\Support\Facades\Cookie;

/**
 * Class UserController
 * @package App\Http\Controllers\Frontend
 */
class UserController extends Controller
{
    /**
     * @var UserContract
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserContract $repository
     */
    public function __construct(UserContract $repository) {
        $this->repository = $repository;
    }

    public function exists(Request $request) 
    {
        $accessToken = $this->repository->exists($request);
        if($accessToken != false) {
            return response()->json($accessToken, 200);
        }
        return response()->json([
            'message' => ''
        ], 422);
    }

    /**
     * Recebe o post para ativar a conta do usuário
     *
     * @param $hash
     * @param Request $request
     */
    public function disable(Request $request)
    {
        //Verifica se o token ainda é válido
        if($this->repository->disable($request)) {
            return response()->json([
                'message' => trans('alerts.users.disable.success')
            ], 200);
        }
        return response()->json([
            'message' => trans('alerts.users.disable.error')
        ], 422);
    }

    /**
     * Recebe o post para ativar a conta do usuário
     *
     * @param $hash
     * @param Request $request
     */
    public function activated($hash, Request $request)
    {
        
    }

    /**
     * Verifica se o token ainda é válido
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTokenActivation(Request $request, $token) 
    {
        //Verifica se o token ainda é válido
        if($this->repository->checkTokenActivation($token)) {
            return response()->json([
                'message' => 'valid'
            ], 200);
        }
        return response()->json([
            'message' => 'invalid'
        ], 422);
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTokenPasswordRecovery(Request $request, $token) 
    {
        if($this->repository->checkTokenPasswordRecovery($token)) {
            return response()->json([
                'message' => 'valid'
            ], 200);
        }
        return response()->json([
            'message' => 'invalid'
        ], 422);
    }

    /**
     * Trocar a senha do usuário
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordRecovery(Request $request, $token) 
    {
        if($this->repository->passwordRecovery($token, $request->all())) {
            return response()->json([
                'message' => trans('alerts.users.change_password.success')
            ], 200);
        }

        return response()->json([
            'message' => trans('alerts.users.change_password.error')
        ], 422);
    }

    /**
     * Esquecer a senha, Envia e-mail para o usuário com um link de recuperação
     * 
     */
    public function forgotPassword(Request $request) 
    {
        if($this->repository->forgotPassword($request->all())) {
            return response()->json([
                'message' => trans('alerts.users.forgot_password.success')
            ], 200);
        }

        return response()->json([
            'message' => trans('alerts.users.forgot_password.error')
        ], 422);
    }

    /**
     * Recebe o post para ativar a conta do usuário
     *
     * @param $hash
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($hash, Request $request)
    {
        $user = $this->repository->activate($hash);
        if($user != false) {
            return response()->json($user, 200);
        } else if($user == false) {
            return response()->json([], 422);
        }
        return response()->json([], 422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('group_id', '=', 3)->get();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function items(Request $request)
    {
        $items = OrderItem::with([
            'order' => function($query) use($request) {
                $query->where('user_id', '=', $request->owner_id);
            },
            'soccerExpert',
            'scratchCard',
            'lottery',
            'scratchCardGame' => function($query) {

            },
            'soccerExpertGame' => function($query) {

            },
            'soccerExpertGame.round' => function($query) {

            },
            'soccerExpertGame.games' => function($query) {
                
            },
            'soccerExpertGame.games.game.houseClub' => function($query) {
                
            },
            'soccerExpertGame.games.game.outClub' => function($query) {
                
            },
            'lotteryGames' => function($query) {

            },
            'lotteryGames.sweepstake' => function($query) {

            },
            'lotteryGames.numbers' => function($query) {
                
            },
            'lotteryGames.numbersExtras' => function($query) {
                
            }
        ])
        ->whereHas('order', function($query) use($request) {
            $query->where('user_id', '=', $request->owner_id);
        });

        //$user = User::find($request->get('user_id'));
        //Gate::forUser($user)->allows('frontend.orders.show', $order);

        if($request->id && !empty($request->id)) {
            $items->where('id', '=', $request->id);
        }
        
        if($request->column) {
            $items->orderBy($request->column, $request->direction);
        }
        
        $items = $items->paginate();

        return response()->json($items, 200);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function soccerExperts($id, Request $request) 
    {
        return SoccerExpertRound::whereHas('bets', function($query) use ($id) {
            $query->where('owner_id', '=', $id);
        })
        ->paginate(15);
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function scratchCards($id, Request $request) 
    {

    }

    public function lotteries($id, Request $request) 
    {
        
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function games($id, Request $request) 
    {
        return Order::where('user_id', '=', $id)->with('item');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orders($id, Request $request) 
    {
        $orders = Order::where('user_id', '=', $id);
        
        if($request->get('column')) {
            $orders->orderBy($request->get('column'), $request->get('direction'));
        }
        
        $orders = $orders->paginate(20);

        return response()->json($orders, 200);
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function transactions($id, Request $request) 
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFromFacebook(Request $request)
    {
        $accessToken = $this->repository->createFromFacebook($request->all());
        if($accessToken != false) {
            return response()->json($accessToken, 200);
        }
        return response()->json(['message' => trans('alerts.users.create.error')], 422);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        if($this->repository->create($request->all())) {
            return response()->json(['message' => trans('alerts.users.create.success')], 200);
        }
        return response()->json(['message' => trans('alerts.users.create.error')], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        
        if($request->get('password') != null && !empty($request->get('password'))) {
            $user->laravel_password = bcrypt($request->get('password'));
        }
        $user->street = $request->get('street');
        $user->number = $request->get('number');
        $user->cep = $request->get('cep');
        $user->city = $request->get('city');
        $user->complement = $request->get('complement');
        $user->state = $request->get('state');
        $user->tell_phone = $request->get('tell_phone');
        $user->nickname = $request->get('nickname');
        $user->photo_domain = request()->root();
        $user->country_id = $request->country;
        $user->gender = $request->gender;
        $locale = Cookie::get('locale');
        $birth_date = format($request->birth_date, 'd-m-Y', $locale);
        $birth_date = explode('-', $birth_date);
        $user->birth_day = $birth_date[2];
        $user->birth_month = $birth_date[1];
        $user->birth_year = $birth_date[0];

        if ($request->hasFile('photo')) {
            if($request->file('photo')->isValid()) {
                try {
                    $file = $request->file('photo');
                    $name = $user->id. '.' .$file->getClientOriginalExtension();
                    $request->file('photo')->move(public_path('files/profile'), $name);
                    $user->photo = '/files/profile/' . $name;
                } catch (\Illuminate\Filesystem\FileNotFoundException $e) {

                }
            } 
        }


        if($user->save()){
            return response()->json(['message' => trans('alerts.users.update.success')], 200);
        }
        return response()->json(['message' => trans('alerts.users.update.error')], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
