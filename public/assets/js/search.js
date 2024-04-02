$(document).ready(function() {
  $('#search-input').on('keyup', function() {
      var query = $(this).val();

      console.log("Query: " + query);

      if (query.length >= 1) {

          $.ajax({
              url: "{{ route('search.cities') }}",
              method: 'GET',
              data: {
                  query: query,
              },
              dataType: 'JSON',
              contentType: false,
              cache: false,
              processData: false,
              success: function(response) {
                  console.log("AJAX Success: " + response); // Kontrola, či prišla úspešná odpoveď
              },
              error: function(xhr, status, error) {
                  console.error("AJAX Error:", status, error); // Kontrola chybových stavov
              }
          });
      }
      
  });
});
