@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <!-- Formulario para editar el usuario -->
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo para el nombre -->
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <!-- Campo para el correo electrónico -->
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <!-- Campo para el rol (opcional, si deseas permitir cambiar el rol del usuario) -->
        <div class="form-group">
            <label for="role">Rol:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="psychologist" {{ $usuario->role == 'psychologist' ? 'selected' : '' }}>Psicólogo</option>
                <option value="patient" {{ $usuario->role == 'patient' ? 'selected' : '' }}>Paciente</option>
                <option value="admin" {{ $usuario->role == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>

        <!-- Botones para guardar o cancelar -->
        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
