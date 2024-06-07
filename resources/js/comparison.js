$(document).ready(function () {
    function addToComparison(productId) {
        $.ajax({
            url: "/comparison/" + productId,
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                alert("Product added to comparison list");
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var errorMessage = xhr.responseJSON.error;
                    alert(errorMessage);
                } else {
                    alert("Failed to add product to comparison list");
                }
            },
        });
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Load the comparison list when the offcanvas is opened
    $("#offcanvasComparison").on("show.bs.offcanvas", function () {
        loadComparisonList();
    });

    // Function to load the comparison list
    function loadComparisonList() {
        $.ajax({
            url: "/comparison",
            method: "GET",
            success: function (response) {
                console.log(response); // Log the response to check the data
                $("#comparison-list").empty();
                response.forEach((item) => {
                    $("#comparison-list").append(`
                          <li class="list-group-item pt-0 pb-5 list-group-activity d-flex align-items-start" id="comparisonItem_${item.id}">
                              <div class="avatar avatar-xs me-3 flex-shrink-0">
                                  <picture>
                                      <img class="f-w-10 rounded-circle" src="/assets/images/product/${item.image}" alt="Product Image">
                                  </picture>
                              </div>
                              <div class="d-flex flex-column flex-grow-1">
                                  <div class="d-flex justify-content-between align-items-center mb-1">
                                      <p class="fw-semibold mb-0 me-3">${item.name}</p>
                                  </div>
                                  <span class="small d-block text-muted">${item.category_name}</span>
                                  <span class="small d-block text-muted">${item.spec_name}</span>
                                  <button onclick="removeFromComparison(${item.id})" class="btn btn-danger btn-sm">Remove</button>
                              </div>
                          </li>
                      `);
                });
            },
            error: function (response) {
                alert("Failed to load comparison list");
            },
        });
    }

    $("a.btn-outline-secondary").click(function (e) {
        e.preventDefault();
        checkCompatibility();
    });

    function checkCompatibility() {
        var productIds = [];
        $("#comparison-list .list-group-item").each(function () {
            productIds.push($(this).attr("id").split("_")[1]);
        });

        $.ajax({
            url: "/check-compatibility",
            method: "POST",
            data: {
                comparison: productIds,
            },
            success: function (response) {
                alert(response.message);
            },
            error: function (response) {
                var message =
                    "Failed to check compatibility: " +
                    response.responseJSON.message;
                if (response.responseJSON.incompatible_spec_name) {
                    message +=
                        "\n\nIncompatible Spec: " +
                        response.responseJSON.incompatible_spec_name;
                }
                alert(message);
            },
        });
    }

    window.removeFromComparison = function (productId) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: `/comparison/${productId}`,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                $("#comparisonItem_" + productId).remove();
                $(`li[data-id="${productId}"]`).remove();
            },
            error: function (xhr, status, error) {
                alert("Failed to remove product from comparison list");
            },
        });
    };
});
