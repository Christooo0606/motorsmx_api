<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->avatar = Storage::url($user->avatar);
        }
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function store(UserRequest $request)
    {
        try {
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'El correo electrónico ya existe'
                ]);
            }

            $user = new User();
            $user->fill($request->validated());
            
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $path = $avatar->store('avatars', 'public');
                $user->avatar = $path;
            }
            
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado exitosamente'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }
    }
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            $user->fill($request->validated());

            // Handle image update
            if ($request->hasFile('avatar')) {
                // Delete previous avatar if exists
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $avatar = $request->file('avatar');
                $path = $avatar->store('avatars', 'public');
                $user->avatar = $path;
            }
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado exitosamente'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }
}
