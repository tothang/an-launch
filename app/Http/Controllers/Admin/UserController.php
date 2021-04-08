<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use App\EnvX\User\UserCreator;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private $creator;
    protected $brand;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
        $this->brand = $this->getBrandFromRoute();
    }

    /**
     * @return string
     */
    private function getBrandFromRoute(): string
    {
        $path = Request::capture()->path();
        $group = '';

        if (isset(explode("/", $path)[2])) {
            $group = strtolower(explode("/", $path)[2]);
        }

        return $group === 'yale' ? User::BRAND_YALE : User::BRAND_HYSTER;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $delegate = User::find($request->get('id') ?? '');
        $brand = $delegate->brand ?? $this->getBrandFromRoute();

        if ($delegate && $delegate->status === User::STATUS_DECLINED) {
            $delegate->update(['status' => User::STATUS_INVITED]);
        }

        return redirect()->route('admin.'.strtolower($brand).'.index')
            ->with('success', 'The status has been changed');
    }

    public function index(): View
    {
        $users = User::where('brand', $this->brand);

        return view('admin.users.index', [
            'users' => $users,
            'brand' => $this->brand
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'brand' => $this->brand,
            'brands' => User::BRANDS,
            'roles' => User::ROLES,
            'titles' => User::TITLES,
            'languages' => User::LANGUAGES
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->input();
        $role = $data['role'] ?? null;
        if ($role === User::ROLE_DEALER) {
            $data['employee_function'] = null;
        } else if ($role === User::ROLE_EMPLOYEE) {
            $data['dealership_name'] = null;
        }

        $user = $this->creator->create($data);
        $user->save();

        return redirect()->route('admin.'.strtolower($this->brand).'.index')
            ->with('success', 'New delegate was added.');
    }

    public function edit(string $userId): view
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('admin.'.strtolower($this->brand).'.index')
                ->with('error', 'Delegate is not found!');
        }

        return view('admin.users.edit', [
            'brand' => $this->brand,
            'user' => $user,
            'brands' => User::BRANDS,
            'roles' => User::ROLES,
            'titles' => User::TITLES,
            'languages' => User::LANGUAGES
        ]);
    }

    public function update(UserRequest $request, string $userId): RedirectResponse
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('admin.'.strtolower($this->brand).'.index')
                ->with('error', 'Delegate is not found!');
        }

        $data = $request->input();
        $role = $data['role'] ?? null;

        if ($role === User::ROLE_DEALER) {
            $data['employee_function'] = null;
        } else if ($role === User::ROLE_EMPLOYEE) {
            $data['dealership_name'] = null;
        }

        $user->update($data);

        return redirect()->route('admin.'.strtolower($this->brand).'.index')
            ->with('success', 'Delegate updated!');
    }

    public function destroy(string $userId): RedirectResponse
    {
        if ($user = User::find($userId)) {
            $user->delete();
        }

        return redirect()->route('admin.'.strtolower($this->brand).'.index')
            ->with('success', 'The delegate is removed from system!');
    }
}
