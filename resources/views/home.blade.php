@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                Categories list
                <a href="{{ route("categories.create") }}" class="btn btn-success float-right">
                    Add
                </a>
            </h2>
        </div>
        <div class="card-body">
            <categories-list></categories-list>
        </div>
    </div>
@endsection
