jQuery(document).ready(function ($) {
  // Function to parse hash parameters from the URL into a key-value pair object
  function getHashParams() {
    return new URLSearchParams(window.location.hash.substr(1));
  }

  // Function to set filter selections based on the hash parameters in the URL
  function setFilterSelectionsFromHash() {
    var params = getHashParams();

    $('#resource_type').val(params.get('resource_type') || '').change();
    $('#industry').val(params.get('industry') || '').change();
    $('#role').val(params.get('role') || '').change();
  }

  // Function to update the URL hash with the selected filter values
  function updateUrl(resourceType, industry, role) {
    var params = new URLSearchParams();
    if (resourceType) params.set("resource_type", resourceType);
    if (industry) params.set("industry", industry);
    if (role) params.set("role", role);

    window.location.hash = params.toString();
  }

  // Function to handle the AJAX request for filtering resources
  function loadFilteredResources(pageNumber = 1) {
    var params = getHashParams();

    // Including nonce verification for added security
    var nonce = $('#_wpnonce').val();

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "load_filtered_resources",
        resource_type: params.get('resource_type') || '',
        industry: params.get('industry') || '',
        role: params.get('role') || '',
        paged: pageNumber,
        nonce: nonce // Sending nonce for verification
      },
      beforeSend: function () {
        $("#ajax-results-container").html("<div class='loading'>Loading...</div>"); // Loading animation
      },
      success: function (response) {
        // Assuming the server-side script properly escapes the response
        $("#ajax-results-container").html(response);
      },
      error: function () {
        $("#ajax-results-container").html("<div class='error'>Error loading the results. Please try again.</div>");
      },
    });
  }

  // Event listeners for the filter select elements to update content via AJAX
  $("#resource_type, #industry, #role").change(debounce(function () {
    var resourceType = $("#resource_type").val();
    var industry = $("#industry").val();
    var role = $("#role").val();

    updateUrl(resourceType, industry, role);
    loadFilteredResources();
  }, 250)); // Debounced to limit the number of AJAX calls

  // Pagination click event handling
  $(document).on("click", ".blog-pagination a", function (e) {
    e.preventDefault();
    var pageNumber = $(this).data("page-number");
    loadFilteredResources(pageNumber);
  });

  // Hash change event to handle browser navigation
  $(window).on('hashchange', setFilterSelectionsFromHash);

  // Initial setup of filter selections and content load on page ready
  setFilterSelectionsFromHash();
  loadFilteredResources();

  // Function to debounce AJAX calls
  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this, args = arguments;
      var later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  }

  // Remove query parameters from all appropriate links on the page
  $("a:not(.blog-pagination a)").each(function () {
    var link = $(this);
    var href = link.attr("href");
    if (href) {
      var url = new URL(href, window.location.origin);
      url.search = ""; // Clear query parameters
      link.attr("href", url.toString());
    }
  });
});

