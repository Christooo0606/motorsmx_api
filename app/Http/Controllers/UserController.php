<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();
        
        // Retornar una respuesta JSON con los usuarios
        return response()->json(['data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    try {
        // Validar los campos del usuario con mensajes de error personalizados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'Fname' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048', // Asegúrate de aceptar solo imágenes
            'google_id' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', 
            'phoneno' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'role_as' => 'nullable|integer',
        ], [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El formato del email es incorrecto.',
            'email.unique' => 'El email ya está en uso.'
        ]);

        // Manejar la carga de la imagen
        if ($request->hasFile('avatar')) {
            // Obtener el archivo de imagen del request
            $avatar = $request->file('avatar');
            // Renombrar el archivo
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            // Mover el archivo a la carpeta de almacenamiento
            $avatar->move(public_path('avatars'), $filename);
            // Asignar la ruta del archivo al campo avatar en los datos validados
            $validatedData['avatar'] = 'avatars/'.$filename;
        }

        // Crear un nuevo usuario con los datos validados
        $user = User::create($validatedData);

        // Retornar una respuesta JSON con el usuario creado
        return response()->json(['data' => $user], 201);
    } catch (ValidationException $e) {
        // Si hay un error de validación, devolver los errores como respuesta JSON
        return response()->json(['errors' => $e->errors()], 422);
    }
}
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        // Verificar si el usuario existe
        if (!$user) {
            // Retornar una respuesta JSON con un mensaje de error si el usuario no se encuentra
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retornar una respuesta JSON con el usuario encontrado
        return response()->json(['data' => $user], 200);
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
        // Buscar el usuario por su ID
        $user = User::find($id);

        // Verificar si el usuario existe
        if (!$user) {
            // Retornar una respuesta JSON con un mensaje de error si el usuario no se encuentra
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validar los campos del usuario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'Fname' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'google_id' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phoneno' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'role_as' => 'nullable|integer',
        ]);

        // Actualizar el usuario con los datos validados
        $user->update($validatedData);

        // Retornar una respuesta JSON con el usuario actualizado
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);

        // Verificar si el usuario existe
        if (!$user) {
            // Retornar una respuesta JSON con un mensaje de error si el usuario no se encuentra
            return response()->json(['error' => 'User not found'], 404);
        }

        // Eliminar el usuario
        $user->delete();

        // Retornar una respuesta JSON con un mensaje de éxito
        return response()->json(['message' => 'User deleted successfully'], 204);
    }
}
