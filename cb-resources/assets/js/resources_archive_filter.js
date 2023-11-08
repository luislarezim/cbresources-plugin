jQuery(document).ready(function ($) {

  // Function to parse hash parameters from the URL
  function getHashParams() {
    var hashParams = {};
    window.location.hash.substr(1).split('&').forEach(function (item) {
      if (item) {
        var parts = item.split('=');
        hashParams[parts[0]] = decodeURIComponent(parts[1]);
      }
    });
    return hashParams;
  }

  // Function to set filter selections from the hash parameters
  function setFilterSelectionsFromHash() {
    var params = getHashParams();

    // Set the value of each select if the corresponding hash parameter is found
    $('#resource_type').val(params.resource_type || '').change();
    $('#industry').val(params.industry || '').change();
    $('#role').val(params.role || '').change();
  }

  // Function to update the URL hash based on filter selections
  function updateUrl(resourceType, industry, role) {
    var hashParams = [];
    if (resourceType) hashParams.push("resource_type=" + encodeURIComponent(resourceType));
    if (industry) hashParams.push("industry=" + encodeURIComponent(industry));
    if (role) hashParams.push("role=" + encodeURIComponent(role));

    window.location.hash = hashParams.join('&');
  }

  // Function to handle the AJAX request for filtered resources
  function loadFilteredResources(pageNumber = 1) {
    var params = getHashParams();

    // Update the URL with the current filter selections
    updateUrl(params.resource_type, params.industry, params.role);

    // AJAX call to update the content based on filters
    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "load_filtered_resources",
        resource_type: params.resource_type || '',
        industry: params.industry || '',
        role: params.role || '',
        paged: pageNumber
      },
      beforeSend: function () {
        $("#ajax-results-container").html("Loading...");
      },
      success: function (response) {
        $("#ajax-results-container").html(response);
      },
      error: function () {
        $("#ajax-results-container").html("There was an error loading the results.");
      },
    });
  }

  // Event listeners for the filter select elements
  $("#resource_type, #industry, #role").change(function () {
    var resourceType = $("#resource_type").val();
    var industry = $("#industry").val();
    var role = $("#role").val();

    updateUrl(resourceType, industry, role);
    loadFilteredResources();
  });

  // Event listener for pagination clicks
  $(document).on("click", ".blog-pagination a", function (e) {
    e.preventDefault();
    var pageNumber = $(this).data("page-number");
    loadFilteredResources(pageNumber);
  });

  // Event listener for hash changes
  $(window).on('hashchange', function () {
    setFilterSelectionsFromHash();
    loadFilteredResources();
  });

  // Initial setting of filter selections and content load
  setFilterSelectionsFromHash();
  loadFilteredResources();

  // Function to remove query parameters from links
  function removeQueryParamsFromLinks() {
    $("a:not(.blog-pagination a)").each(function () {
      var link = $(this);
      var href = link.attr("href");
      if (href) {
        var url = new URL(href, window.location.origin);
        url.search = ""; // Removes the query parameters
        link.attr("href", url.toString());
      }
    });
  }

  // Clean up all links on the page
  removeQueryParamsFromLinks();
});
