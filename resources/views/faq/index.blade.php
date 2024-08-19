@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQs</h1>

    @foreach ($categories as $category)
        <h2>{{ $category->name }}</h2>
        @foreach ($category->faqs as $faq)
            <h3>{{ $faq->question }}</h3>
            <p>{{ $faq->answer }}</p>
        @endforeach
    @endforeach
</div>
@endsection
