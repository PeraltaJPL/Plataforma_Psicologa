<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilo cuando el campo es válido (verde) */
        .is-valid {
            border-color: green;
        }

        /* Estilo cuando el campo es inválido (rojo) */
        .is-invalid {
            border-color: red;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid justify-content-center">
            <span class="navbar-brand mb-0 h1">AREA DE PSICOLOGÍA</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 mt-4">
                <div class="card p-4 shadow-lg">
                    <div class="card-body text-center">
                        <h1 class="h1 mb-4">Registro de Usuario</h1>

                        <!-- Formulario -->
                        <form method="POST" action="{{ route('InicioSesion.register') }}">
                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" name="name" class="form-control text-center" id="name"
                                    placeholder="Escriba su nombre completo" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Correo -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control text-center" id="email"
                                    placeholder="Escriba su correo" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control text-center" id="password"
                                    placeholder="Escriba su contraseña" value="{{ old('password') }}"required>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control text-center"
                                    id="password_confirmation" placeholder="Escriba su contraseña"
                                    value="{{ old('password_confirmation') }}"required>
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Botón de envío -->
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>

                        <!-- Enlace para volver al inicio de sesión -->
                        <div class="mt-3">
                            <a href="{{ route('login') }}" class="text-muted">¿Ya tienes cuenta? Inicia sesión</a>
                        </div>
                    </div>
                </div>

                <!-- Logos en el footer -->
                <div class="text-center mt-4 logosFooter">
                    <img src="{{ asset('assets/images/logoSEP.png') }}" alt="SEP" class="img-fluid" width="300em"
                        height="70em">
                    <img src="{{ asset('assets/images/logoTecNM.png') }}" alt="TecNM" class="img-fluid"
                        width="150em" height="70em">
                    <img src="{{ asset('assets/images/logoEstado.png') }}" alt="Estado de Michoácan" class="img-fluid"
                        width="55em" height="70em">
                    <img src="{{ asset('assets/images/logoITSH.png') }}" alt="ITSH" class="img-fluid"
                        width="70em" height="70em">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación en tiempo real para la contraseña
        document.getElementById('password').addEventListener('input', function() {
            const passwordField = document.getElementById('password');

            // Verifica que la contraseña tenga al menos 6 caracteres
            if (passwordField.value.length >= 8) {
                passwordField.classList.remove('is-invalid');
                passwordField.classList.add('is-valid');
            } else {
                passwordField.classList.remove('is-valid');
                passwordField.classList.add('is-invalid');
            }
        });

        // Validación en tiempo real para la confirmación de la contraseña
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');

            // Verifica que las contraseñas coincidan y tengan al menos 6 caracteres
            if (confirmPasswordField.value === passwordField.value && confirmPasswordField.value.length >= 8) {
                confirmPasswordField.classList.remove('is-invalid');
                confirmPasswordField.classList.add('is-valid');
            } else {
                confirmPasswordField.classList.remove('is-valid');
                confirmPasswordField.classList.add('is-invalid');
            }
        });
    </script>

</body>

</html>
