$(document).ready(function () {
  $("#submit").on("click", function (e) {
    e.preventDefault();
    let username = $("#username").val();
    if (username == "") {
      $("#message").text("*All fields are required");
    } else {
      $.ajax({
        url: "http://localhost/LandT/php/login.php",
        type: "POST",
        data: { username: username },
        async: true,
        success: function (response) {
          try {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.status == 1) {
              $("#message").text("User found");
            } else {
              $("#message").text("Failed to insert user");
            }
          } catch (e) {
            console.error("Error parsing JSON:", e);
            $("#message").text("Invalid response from the server");
          }
        },
        error: function (xhr, status, error) {
          console.error("Error:", error);
          $("#message").text("An error occurred. Please try again.");
        },
      });
    }
  });
});