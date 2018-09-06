@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    {{ $object->name }}
                    <div class="btn-group float-right">
                        <a href="{{ route("home") }}" class="btn btn-secondary" role="button">
                            Back
                        </a>
                        <a href="{{ route("posts.create", $object->id) }}" class="btn btn-success">
                            Add new post
                        </a>
                    </div>
                </h2>
                <hr />
                <p>
                    {{ $object->description }}
                </p>
            </div>
        </div>
        <div class="card-body">
            <posts-list :category_id="{{ $object->id }}"></posts-list>
        </div>
        <div class="card-footer">
            <comments-form type="{{ get_class($object) }}" :id="{{ $object->id }}" />
        </div>
    </div>
@endsection
