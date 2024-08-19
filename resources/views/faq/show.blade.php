@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>

    @foreach ($category->faqs as $faq)
        <div class="faq-item">
            <h3>{{ $faq->question }}</h3>
            <p>{{ $faq->answer }}</p>
        </div>
    @endforeach
</div>
@endsection
