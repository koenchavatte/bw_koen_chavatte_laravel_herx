@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQ Categories</h1>

    <!-- Bericht voor succesvolle acties zoals toevoegen, bewerken of verwijderen -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Knop om een nieuwe categorie toe te voegen -->
    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>

    <!-- Lijst van bestaande categorieën -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- Bewerk-knop -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <!-- Verwijder-knop -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
