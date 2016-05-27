$(document).ready(function () {

    var base = "http://localhost:2222/api/";

    function getAusbilder() {
        $.getJSON(uri)
          .done(function (data) {
              // On success, 'data' contains a list of products.
              $.each(data, function (key, item) {
                  // Add a list item for the product.
                  $('<li>', { text: formatItem(item) }).appendTo($('#test'));
              });
          });
    }

    function formatItem(item) {
        return item.Name + ': $' + item.Price;
    }
})