@extends('admin.home')

@section('content')
    <a href="{{ route('classes.create') }}" class="btn btn-primary">Add Class</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kelas</th>
                <th>Nama Siswa</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->id }}</td>
                    <td>{{ $class->class_name }}</td>
                    <td>{{ $class->students->name }}</td>
                    <td>
                        <a href="{{ route('classes.edit', $class) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
