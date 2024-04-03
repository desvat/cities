@include('head')

@include('navigation')
    
    <main class="all-cities d-flex">
        <div class="container">

        <div class="row list">
          <ul>
            @foreach ($paragraphs as $paragraph)
              <li><a href="{{ $paragraph['href'] }}">{{ $paragraph['text'] }}</a></li>
            @endforeach
          </ul>
        </div>

      </div>
    </main>
    
@include('footer')