<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    // Muestra el formulario de olvido de contraseña
    public function showForgotForm()
    {
        return view('auth.passwords.email'); // Vista del formulario
    }

    // Envía el enlace de restablecimiento
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    // Dominios permitidos
                    $allowedDomains = ['gmail.com', 'huetamo.tecnm.mx'];
                    // Extraer el dominio del correo
                    $emailDomain = substr(strrchr($value, "@"), 1);

                    if (!in_array($emailDomain, $allowedDomains)) {
                        $fail('El correo debe ser de Gmail o del dominio huetamo.tecnm.mx.');
                    }
                },
            ],
        ]);

        // Intentar enviar el enlace de restablecimiento
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Muestra el formulario para restablecer la contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Realiza el restablecimiento de la contraseña
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
