@include('head')

@section('title', 'Vyhľadávanie v databáze obcí')

@include('navigation')

    <header class="search">

        <div class="h-100 d-flex gap-4 flex-column justify-content-center align-items-center">

            <div class="row">
                <h1>Vyhľadávanie v databáze obcí</h1>
            </div>

            <div class="row search-wrapper">
                <input type="text" id="search-input" class="search-input" placeholder="Zadajte názov...">

                <div class="search-result-wrapper" id="search-result">
                    <div class="search-result-wrapper-inner" id="search-result-inner">
                        <div class="search-result-item kraj">kraj</div>
                        <div class="search-result-item okres">okres</div>
                        <div class="search-result-item mesto">mesto</div>
                        <div class="search-result-item mesto">mesto</div>
                        <div class="search-result-item">item</div>
                        <div class="search-result-item">item</div>
                        <div class="search-result-item">item</div>
                        <div class="search-result-item">item</div>
                        <div class="search-result-item">item</div>
                    </div>
                </div>

                <!-- 
                kraj
                okres
                mesto
                obec 
                -->

            </div>

        </div>

    </header>

@include('footer')