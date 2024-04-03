@include('head')

@include('navigation')
    
    <main class="all-cities d-flex">

        <div class="container">

            <div class="row buttons">
                <ul>
                    <li><a href="/parse/komarno" title="Komárno">Komárno</a></li>
                    <li><a href="/parse/levice" title="Levice">Levice</a></li>
                    <li><a href="/parse/nitra" title="Nitra">Nitra</a></li>
                    <li><a href="/parse/nove_zamky" title="Nové Zámky">Nové Zámky</a></li>
                    <li><a href="/parse/sala" title="Šaľa">Šaľa</a></li>
                    <li><a href="/parse/topolcany" title="Topoľčany">Topoľčany</a></li>
                    <li><a href="/parse/zlate_moravce" title="Zlaté Moravce">Zlaté Moravce</a></li>
                </ul>
            </div>

            <div class="row list">

                @if (!empty($cities))
                    <ul>
                        @foreach($cities as $city)
                            <li>
                                <a href="/city/{{ $city['city_id'] }}" title="Zobraziť detail {{ trim($city['city_type'] === 'mesto' ? 'mesta' : 'obce') }}">
                                    {{ htmlspecialchars_decode($city['city_name']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else

                <div class="msg-empty">
                    <p>{{ $message }}</p>
                </div>

                @endif

            </div>
        </div>
    </main>
    
@include('footer')