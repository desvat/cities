  var resultWrapper = $('#search-result');
  var resultWrapperInner = $('#search-result-inner');

  $('#search-input').on('keyup', function() {

    var query = $(this).val();
    var url = "/city-search";

          $.ajax({
            url: url,
            method: 'GET',
            data: { query: query, },
            dataType: 'JSON',
            success: function(response) {

            //   console.log("AJAX Success: " + JSON.stringify(response));
              resultWrapper.css('display', 'block');

              var htmlContent = '';

              if (Array.isArray(response)) {
                response.forEach(function(city) {

                  if (city.city_type === 'mesto') {
                    city_typ = 'mesta';
                  } 
                            
                  if (city.city_type === 'obec') {
                    city_typ = 'obce';
                  }

                  htmlContent += '<div class="search-result-item"><a href="/city/' + city.city_id + '" title="Zobraziť detail ' + city_typ + '">' + city.city_name + '</a></div>';

                });
              } else {
                    htmlContent = '<div class="search-result-item">' + response.message + '</div>';
                }

              resultWrapperInner.html(htmlContent);

              },
              error: function(xhr, status, error) {
                // console.error("AJAX Error:", status, error, xhr.responseText); 
            }
          });

      
  });
