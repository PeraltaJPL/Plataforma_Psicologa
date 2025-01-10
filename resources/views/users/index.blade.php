<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-5 shadow-lg">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <h1>
                    Gestión de Usuarios
                    <a href="{{route('Inicio.home')}}" class="btn btn-primary">
                        Regresar
                    </a>
                </h1>
            </span>
        </div>
        {{-- <h1>Gestión de Usuarios</h1> --}}
       
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @if($user->role !== 'patient')
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="form-select" onchange="this.form.submit()">
                                    {{-- <option value="patient" {{ $user->role === 'patient' ? 'selected' : '' }}>Paciente</option> --}}
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-success' : 'btn-danger' }}">
                                    {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        </div>
    </div>    
</body>
</html>
