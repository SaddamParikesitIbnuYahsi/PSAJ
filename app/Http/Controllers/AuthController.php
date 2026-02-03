<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ];

        // Validasi role disesuaikan (Admin, Staf Registrasi, User)
        if ($request->has('role')) {
            $rules['role'] = 'required|in:Admin,Staf Registrasi,User';
        }

        $validated = $request->validate($rules);

        // Default role untuk pendaftar baru adalah User
        if (!isset($validated['role'])) {
            $validated['role'] = 'User';
        }

        try {
            $user = $this->auth->register($validated);

            $loginData = [
                'email'    => $validated['email'],
                'password' => $validated['password'],
            ];

            $token = $this->auth->login($loginData);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil!',
                'data' => [
                    'user' => [
                        'id'         => $user->id,
                        'name'       => $user->name,
                        'email'      => $user->email,
                        'role'       => $user->role,
                        'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                    ],
                    'access_token' => $token,
                    'token_type'   => 'Bearer',
                    'redirect_to'  => $this->getRedirectUrlByRole($user->role),
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registrasi gagal.',
                'error'   => 'REGISTRATION_FAILED',
            ], 500);
        }
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        Auth::login($user, $validated['remember'] ?? false);
        $request->session()->regenerate();
        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'data' => [
                'user' => [
                    'id'         => $user->id,
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'role'       => $user->role,
                ],
                'redirect_to' => $this->getRedirectUrlByRole($user->role),
            ]
        ]);
    }

    public function simpleLogin(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal!',
            ], 401);
        }

        Auth::login($user, $validated['remember'] ?? false);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'data' => [
                'user' => [
                    'id'    => $user->id,
                    'role'  => $user->role,
                ],
                'redirect_to'  => $this->getRedirectUrlByRole($user->role),
            ]
        ], 200);
    }

    /**
     * Redirect Path Berdasarkan Role (PENTING: Harus sinkron dengan web.php)
     */
// Cari fungsi ini di AuthController dan ganti isinya:
protected function getRedirectUrlByRole($role)
{
    return match ($role) {
        'Admin'           => '/admin/dashboard',
        'Staf Registrasi' => '/staff/dashboard',
        'User'            => '/user/dashboard',
        default           => '/',
    };
}

    public function me(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['success' => false], 401);

        return response()->json([
            'success' => true,
            'data' => ['user' => $user]
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect('/login');
    }
}