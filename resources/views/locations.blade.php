@include('head')

@section('title', 'All Locations')

@include('navigation')


    <main class="all-locations">
        
        <div class="container d-flex flex-wrap justify-content-between justify-content-center">

            @foreach($regions as $region)
                <div class="group">

                    <h4>{{ $region->location_name }}</h4>
                    <ul>
                        @foreach($region->children as $district)
                            <li><h5>{{ $district->location_name }}</h5></li>
                            <ul>
                                @foreach($district->children as $cityOrTown)
                                    <li>
                                        <a href="city/{{ $cityOrTown->location_id }}" title="Zobraziť detail {{ trim($cityOrTown->location_type == 'mesto' ? 'mesta' : 'obce') }}">
                                            <h6><b>{{ $cityOrTown->location_name }}</b> {{ $cityOrTown->location_type }}</h6>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>
    </main>
    
@include('footer')
