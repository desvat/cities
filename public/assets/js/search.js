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
                            if (city.city_type !== 'kraj' && city.city_type !== 'okres') {
                                htmlContent += '<div class="search-result-item"><a href="/city/' + city.city_id + '" title="">' + city.city_id + ' - ' + city.city_name + ' - ' + city.city_type + '</a></div>';
                            }
                        });
                    } else {
                        htmlContent = '<div class="search-result-item">' + response.message + '</div>';
                    }

                    resultWrapperInner.html(htmlContent);

              },
              error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error, xhr.responseText); 
            }
          });

      
  });
