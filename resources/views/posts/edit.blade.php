@extends("layouts.app")

@section("content")
    <posts-form :category_id="{{ $object->category_id }}" :object="{{ $object }}"></posts-form>
@endsection
