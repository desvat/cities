@include('head')

<style>
    .xxx li {
        background-color: #f1f1f1;
        margin: 0 0 2px 0;
        padding: 7px 0;
    }
</style>

@include('navigation')
    
    <main class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row xxx">



            <ul>
                @foreach ($paragraphs as $paragraph)
                    <li><a href="{{ $paragraph['href'] }}">{{ $paragraph['text'] }}</a></li>
                @endforeach
            </ul>



            

            </div>
        </div>
    </main>
    
@include('footer')