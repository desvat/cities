@include('head')

@section('title', 'Error 404')

@include('navigation')
    
    <main class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">

<style>
    li {
        background-color: #f1f1f1;
        margin: 0 0 2px 0;
        padding: 5px 0;
    }
</style>

            <ul>
    @foreach ($paragraphs as $paragraph)
        <li><a href="{{ $paragraph['href'] }}">{{ $paragraph['text'] }}</a></li>
    @endforeach
</ul>

            </div>
        </div>
    </main>
    
@include('footer')