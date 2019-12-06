$(document).ready(function() {
  // Activate tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Delete vendor
  $("#deleteModal").on("show.bs.modal", function(e) {
    var vendorDocument = $(e.relatedTarget).attr("data-id");
    document.getElementById("deleteVendorDocument").value = vendorDocument;
  });

  // Select filter
  $("#searchBy").on("change", function(e) {
    var searchBy = document.getElementById("searchBy").value;
    if (searchBy == "created_at") {
      $("#searchFor").mask("0000-00-00");
      document.getElementById("searchFor").placeholder = "YYYY-MM-DD";
    } else {
      $("#searchFor").unmask();
      document.getElementById("searchFor").placeholder = "Search for...";
    }
  });
});
