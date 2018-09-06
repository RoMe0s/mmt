@extends("layouts.app")

@section("content")
    <posts-form :category_id="{{ $category_id }}"></posts-form>
@endsection
