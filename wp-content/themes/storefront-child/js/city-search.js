jQuery(document).ready(function ($) {
    $('#city-search').on('input', function () {
        var search = $(this).val();

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'city_search',
                search: search,
            },
            success: function (response) {
                if (response.success) {
                    var results = response.data;
                    var tableBody = $('#city-table tbody');
                    tableBody.empty(); // Clear existing results

                    $.each(results, function (index, city) {
                        tableBody.append('<tr><td>' + city.post_title + '</td></tr>');
                    });
                } else {
                    alert(response.data);
                }
            },
            error: function () {
                alert('An error occurred while searching for cities.');
            },
        });
    });
});