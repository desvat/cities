@include('head')

@section('title', 'Detaily mesta')

@include('navigation')

    <main class="city-details">
        
        <div class="container">

            <h1>Detaily obce - {{ $id }}</h1>

            <div class="row">

                <div class="col-md-6 col-info">
                
                    <div class="row">
                        <div class="col-md-6 bold">Meno Starostu:</div>
                        <div class="col-md-6">Ing. Ivan Potoprsty</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Adresa obecneho uradu:</div>
                        <div class="col-md-6">a</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Telefon:</div>
                        <div class="col-md-6">a</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Fax:</div>
                        <div class="col-md-6">a</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Email:</div>
                        <div class="col-md-6">a</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Web:</div>
                        <div class="col-md-6"><a href="#" title="">www.krupina.sk</a></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bold">Zemepisne suradnice:</div>
                        <div class="col-md-6">a</div>
                    </div>

                </div>

                <div class="col-md-6 col-erb">
                <img src="{{ asset('assets/img/krupina.png') }}" alt="">
                    <h2><a href="#" title="">Krupina</a></h2>
                </div>

            </div>

        </div>

    </main>

@include('footer')
