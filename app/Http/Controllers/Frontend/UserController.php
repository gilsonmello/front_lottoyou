<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\CreateUserRequest;
use App\Http\Requests\Frontend\User\UpdateUserRequest;
use App\User;
use App\Order;
use App\OrderItem;
use App\SoccerExpertRound;
use App\Repositories\Frontend\User\UserContract;

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
     * Recebe o post para ativar a conta do usuário
     *
     * @param $hash
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($hash, Request $request)
    {
        if($this->repository->activate($hash)) {
            return redirect('/#/?toastr_title=Conta ativada com sucesso&toastr_desc=teste');
        }

        return redirect('/');
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
    public function items($id, Request $request)
    {
        $items = OrderItem::with([
            'order' => function($query) use($id, $request) {
                $query->where('user_id', '=', $id);
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
            'lotteryGame' => function($query) {

            },
            'lotteryGame.sweepstake' => function($query) {

            },
            'lotteryGame.numbers' => function($query) {
                
            },
            'lotteryGame.numbersExtras' => function($query) {
                
            }
        ])
        ->whereHas('order', function($query) use($id, $request) {
            $query->where('user_id', '=', $id);
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
        if($user = $this->repository->createFromFacebook($request->all()) != false) {
            dd($user);
            return response()->json($user, 200);
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
        $user->username = $request->get('username');
        $user->state = $request->get('state');
        $user->tell_phone = $request->get('tell_phone');
        $user->nickname = $request->get('nickname');

        if ($request->hasFile('photo')) {
            if($request->file('photo')->isValid()) {
                try {
                    $file = $request->file('photo');
                    $name = $user->id. '.' .$file->getClientOriginalExtension();
                    $request->file('photo')->move(public_path('files/profile'), $name);
                    $user->photo = request()->root() . '/files/profile/' . $name;
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
