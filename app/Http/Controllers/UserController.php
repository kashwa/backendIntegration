<?php

namespace App\Http\Controllers;

use App\Helpers\RestApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RestApi;

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
     *
     * @param UserRepository $userRepository
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
        return $this->sendJson($this->userRepository->findAll(), 200);
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

        if ($user)
            return $this->sendJson($user, 200);
        else
            return $this->sendError(['message' => 'User Not Found!'], 404);
    }

    /**
     * Create new User.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateUserData($request->all(), $this->rule);
        if($validator->fails()){
            return $this->sendError($validator->messages(), 400);
        }

        $user_data = $request->only(['name', 'email', 'password']);
        $user = $this->userRepository->create($user_data);
        return $this->sendJson(['message' => 'User Created Successfully!', 'user' => $user], 200);
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
            return $this->sendError($validator->messages(), 400);
        }

        // Check User Auth.
        if (!(auth()->user()->_id == $id)){
            return $this->sendError(['message' => 'You can\'t modify other user\'s data'], 403);
        }

        $user_data = $request->only(['name', 'email', 'password']);
        $user_updated = $this->userRepository->update($id, $user_data);
        if ($user_updated) {
            return $this->sendJson(['message' => 'User Updated Successfully!', 'user' => $this->userRepository->find($id)], 200);
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
        $user = $this->userRepository->delete($user_id);
        if($user == 1 )
            return $this->sendMessage(['message' => 'User Deleted Successfully'], 200);

        return $this->sendMessage(['message' => 'User Not Found'], 404);
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
