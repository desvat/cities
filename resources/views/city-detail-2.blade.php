@include('head')

@section('title', 'Detaily mesta')

@include('navigation')

    <main class="city-details">
        
        <div class="container">

            <div class="row">

              <table> 

                  @foreach ($paragraphs as $paragraph)

                  @if (array_key_exists('primator', $paragraph))
                      <tr>
                        <td>
                          {{ $paragraph['primator'] }}
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('starosta', $paragraph))
                      <tr>
                        <td>
                          {{ $paragraph['starosta'] }}
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('prednosta', $paragraph))
                      <tr>
                        <td>
                          {{ $paragraph['prednosta'] }}
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('region', $paragraph))
                      <tr>
                        <td>
                          {{ $paragraph['region'] }}
                        </td>
                      </tr>
                    @endif



                    @if (array_key_exists('emails', $paragraph))
                      <tr>
                        <td >
                          {{ $paragraph['emails'] }}
                        </td>
                      </tr>
                    @endif



                    @if (array_key_exists('district', $paragraph))
                      <tr>
                        <td >district: 
                          {{ $paragraph['district'] }}
                        </td>
                      </tr>
                    @endif



                    @if (array_key_exists('erb', $paragraph))
                      <tr>
                        <td style="background-color: #65ff31;">
                          {{ $paragraph['erb'] }}
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('phones', $paragraph))
                      <tr>
                        <td style="background-color: #c1c1c1;">
                          @foreach ($paragraph['phones'] as $phone)
                            {{ $phone }}
                          @endforeach
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('faxs', $paragraph))
                      <tr>
                        <td style="background-color: #q1q1q1;">
                          {{ $paragraph['faxs'] }}
                        </td>
                      </tr>
                    @endif

                    @if (array_key_exists('web', $paragraph))
                      <tr>
                        <td style="background-color: #ff0000;">
                          {{ $paragraph['web'] }}
                        </td>
                      </tr>
                    @endif




                    @if (array_key_exists('typ', $paragraph))
                      <tr>
                        <td style="background-color: #adfcff;">
                          {{ $paragraph['typ'] }}
                        </td>
                      </tr>
                    @endif



                  @endforeach

              </table>

            </div>

        </div>

    </main>

@include('footer')
