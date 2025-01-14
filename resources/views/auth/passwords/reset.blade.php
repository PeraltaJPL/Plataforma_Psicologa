<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Contraseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-6">
        <div class="card p-4 shadow-lg">
          <div class="card-body text-center">
            <h1 class="h1 mb-4">Recuperar Contraseña</h1>
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control text-center" id="email" value="{{ old('email') }}" required placeholder="Escriba su correo">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control text-center" id="password" required placeholder="Escriba su nueva contraseña">
                @error('password')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control text-center" id="password_confirmation" required placeholder="Confirme su nueva contraseña">
              </div>

              <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
            </form>

            <a href="{{ route('login') }}" class="btn btn-link mt-3">Volver al inicio de sesión</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
