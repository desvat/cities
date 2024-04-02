@include('head')

@section('title', 'Detaily mesta')

@include('navigation')

    <main class="city-details">
        
        <div class="container">

            @if(isset($city))

                @if($city->city_type === 'mesto')
                    <h1>Detaily mesta <strong>{{ $city->city_name }}</strong></h1>
                @endif
                @if($city->city_type === 'obec')
                    <h1>Detaily obce <strong>{{ $city->city_name }}</strong></h1>
                @endif

                <div class="row">

                    <div class="col-md-6 col-info">

                        @if(!empty($city->city_mayor)) <!-- Starosta -->
                            <div class="row">
                                <div class="col-md-6 bold">Meno Starostu:</div>
                                <div class="col-md-6">{{ $city->city_mayor }}</div>
                            </div>
                        @endif

                        @if(!empty($city->city_address)) <!-- Adresa obecneho uradu -->
                            <div class="row">
                                <div class="col-md-6 bold">
                                    @if($city->city_type === 'mesto')
                                        Adresa mestského úradu:
                                    @endif
                                    @if($city->city_type === 'obec')
                                        Adresa obecného úradu:
                                    @endif
                            </div>
                                <div class="col-md-6">{{ $city->city_address }}</div>
                            </div>
                        @endif

                        @if (!empty($city->city_phone)) <!-- Telefón -->
                            @php
                                $phones = explode(', ', $city->city_phone);
                            @endphp

                            @foreach ($phones as $phone)
                                <div class="row">
                                    <div class="col-md-6 bold">Telefón:</div>
                                    <div class="col-md-6"><a href="mailto:{{ $phone }}" title="">{{ $phone }}</a></div>
                                </div>
                            @endforeach
                        @endif

                        @if(!empty($city->city_fax)) <!-- Fax -->
                            <div class="row">
                                <div class="col-md-6 bold">Fax:</div>
                                <div class="col-md-6">{{ $city->city_fax }}</div>
                            </div>
                        @endif

                        @if (!empty($city->city_email)) <!-- Email -->
                            @php
                                $emails = explode(', ', $city->city_email);
                            @endphp

                            @foreach ($emails as $email)
                                <div class="row">
                                    <div class="col-md-6 bold">Email:</div>
                                    <div class="col-md-6"><a href="mailto:{{ $email }}" title="">{{ $email }}</a></div>
                                </div>
                            @endforeach
                        @endif

                        @if(!empty($city->city_web)) <!-- Web -->
                            <div class="row">
                                <div class="col-md-6 bold">Web:</div>
                                <div class="col-md-6"><a href="https://{{ $city->city_web }}" title="" target="_blank">{{ $city->city_web }}</a></div>
                            </div>
                        @endif

                        <!-- @if(!empty($city->city_web)) Zemepisné súradnice -->
                            <div class="row">
                                <div class="col-md-6 bold">Zemepisné súradnice:</div>
                                <div class="col-md-6"><a href="https://" title="" target="_blank">mapa</a></div>
                            </div>
                        <!-- @endif -->

                    </div>

                    <div class="col-md-6 col-erb">
                        <img src="{{ asset('assets/img/krupina.png') }}" alt="">
                        @if(!empty($city->city_web)) <!-- Web -->
                            <h2><a href="https://{{ $city->city_web }}" title="" target="_blank">{{ $city->city_name }}</a></h2>
                        @endif
                    </div>

                </div>

            @else
                <h1>{{ $message }}</h1>
            @endif

        </div>

    </main>

@include('footer')
