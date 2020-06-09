<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @var UserRepository instance.
     */
    protected $userRepository;

    protected $rule = [
        'name' => 'required|max:255',
        'email' => 'required|unique:users',
        'password' => 'required'
    ];

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return List of App/User.
     *
     * @return mixed
     */
    public function index()
    {
        $users = $this->userRepository->findAll();

        // TODO: Update to use api response helper.
        return $users;
    }

    /**
     * Return Specific User.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        // TODO: Update to use api response helper.
        if ($user)
            return $user;
        else
            return response()->json(['message' => 'User Not Found!'], 200);
    }

    /**
     * Create new User.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateUserData($request->all(), $this->rule);
        if($validator->fails()){
            return response($validator->messages(), 403);
        }

        $user_data = $request->only(['name', 'email', 'password']);
        $user = $this->userRepository->create($user_data);
        return response()->json(['message' => 'User Created Successfully!', 'user' => $user], 200);
    }

    /**
     * Update Specific User.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateUserData($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return response($validator->messages(), 403);
        }

        // Check User Auth.
        if (!(auth()->user()->_id == $id)){
            return response()->json(['error' => 'You can\'t modify other user\'s data']);
        }

        $user_data = $request->only(['name', 'email', 'password']);
        $user_updated = $this->userRepository->update($id, $user_data);
        if ($user_updated) {
            return response()->json(['message' => 'User Updated Successfully!', 'user' => $this->userRepository->find($id)], 200);
        }
    }

    /**
     * Delete Specific User.
     *
     * @param $user_id
     * @return mixed
     */
    public function destroy($user_id)
    {
        return $this->userRepository->delete($user_id);
    }

    /**
     * Validate User data.
     * using Validator::make()
     *
     * @param $data
     * @param $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateUserData($data, $rules)
    {
        return Validator::make($data, $rules);

    }
}
