$(document).ready(function () {
  const productSection = document.querySelector(".productSection");
  $(".addProductSectionForm").submit(function (e) {
    e.preventDefault();

    // Get form data
    let formData = new FormData(this);

    // Make AJAX call
    $.ajax({
      url: $(this).attr("action"),
      type: $(this).attr("method"),
      data: formData,
      processData: false,
      contentType: false,
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    })
      .done(function () {
        // First AJAX call completed successfully
        // Make the second AJAX call
        $.ajax({
          url: "./db/read.php",
          type: "GET",
          success: function (response) {
            // Handle the response from the server
            console.log(response);
            productSection.innerHTML = response;
          },
          error: function (xhr, status, error) {
            // Handle any errors
            console.error(error);
          },
        });
      })
      .done(function () {
        // Reset the form
        $(".addProductSectionForm").trigger("reset");
      });
  });
});
