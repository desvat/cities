@include('head')

@include('navigation')
    
    <main class="all-cities d-flex">

        <div class="container">

            <div class="row buttons">
                <ul>
                    <li><a href="/parse/cities/komarno" title="Komárno">Komárno</a></li>
                    <li><a href="/parse/cities/levice" title="Levice">Levice</a></li>
                    <li><a href="/parse/cities/nitra" title="Nitra">Nitra</a></li>
                    <li><a href="/parse/cities/nove_zamky" title="Nové Zámky">Nové Zámky</a></li>
                    <li><a href="/parse/cities/sala" title="Šaľa">Šaľa</a></li>
                    <li><a href="/parse/cities/topolcany" title="Topoľčany">Topoľčany</a></li>
                    <li><a href="/parse/cities/zlate_moravce" title="Zlaté Moravce">Zlaté Moravce</a></li>
                </ul>
            </div>

            <div class="row list">

                @if (!empty($paragraphs))
                    <ul>
                        @foreach ($paragraphs as $paragraph)
                            <li><a href="https://{{ $paragraph['href'] }}" target="_blank">{{ $paragraph['text'] }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $message }}</p>
                @endif

            </div>
        </div>
    </main>
    
@include('footer')