@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2>
                    {{ $object->name }}
                    <div class="btn-group float-right">
                        <a href="{{ route("categories.show", $object->category_id) }}" class="btn btn-secondary" role="button">
                            Back
                        </a>
                        @if($object->file)
                            <a download href="/{{ $object->file }}" class="btn btn-info" role="button">
                                Download file
                            </a>
                        @endif
                    </div>
                </h2>
            </div>
        </div>
        <div class="card-body">
            {{ $object->content }}
        </div>
        <div class="card-footer">
            <comments-form type="{{ get_class($object) }}" :id="{{ $object->id }}" />
        </div>
    </div>
@endsection
