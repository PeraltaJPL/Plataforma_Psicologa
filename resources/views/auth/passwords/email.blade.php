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
            <form action="{{ route('password.email') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control text-center" id="email" placeholder="Escriba su correo">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Enviar Enlace</button>
            </form>
            <a href="{{ route('login') }}" class="btn btn-link mt-3">Volver al inicio de sesión</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
