// function openlogin() {
//   let loginform = document.getElementById("login-popup");
//   document.getElementById("login-popup").style.display = "flex";
//   document.getElementById("login-popup").style.transition = "all 500ms ease-in-out;";
//   loginform.style.top = "-20vh";

//   let overlay = loginform.querySelector(".overlay");
//   overlay.style.display = 'block'
// }

// function closelogin() {
//   document.getElementById("login-popup").style.display = "none";
//   let loginform = document.getElementById("login-popup");
//   loginform.style.top = "-100vh";
// }

function openregister() {
  let registerform = document.getElementById("register-popup");
  registerform.style.display = "block";
  registerform.style.marginLeft = "40%";
}

function closeregister() {
  document.getElementById("register-popup").style.display = "none";
}



function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}
function scrollToBottom() {
  const documentHeight = document.documentElement.scrollHeight;
  window.scrollTo({ top: documentHeight, behavior: "smooth" });
}

var btn = $("#backtotopbutton");

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass("show");
  } else {
    btn.removeClass("show");
  }
});

btn.on("click", function (e) {
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "300");
});

function redirectToMovie() {
  // Get the selected movie ID
  var selectedMovieId = document.getElementById("movieselect").value;

  // Redirect to movie.php with the selected movie ID
  window.location.href = "movie.php?id=" + selectedMovieId;
}

function performSearch() {
  var searchTerm = $("#searchInput").val();

  // Check if the search term is empty
  if (!searchTerm.trim()) {
    return;
  }

  // Perform AJAX request to search.php
  $.ajax({
    type: "GET",
    url: "search.php",
    data: { term: searchTerm },
    dataType: "json",
    success: function (data) {
      displaySearchResults(data);
    },
    error: function (error) {
      console.log("Error:", error);
    },
  });
}

function displaySearchResults(results) {
  var resultsContainer = $("#searchResults");
  resultsContainer.empty();

  // Display each result
  results.forEach(function (result) {
    var resultHtml = "<div>";
    resultHtml +=
      '<a href="movie.php?id=' + result.id + '">' + result.title + "</a>";
    resultHtml += "</div>";
    resultsContainer.append(resultHtml);
  });

  // Show the results container
  resultsContainer.show();
}

// Hide results when clicking outside the input and results
$(document).mouseup(function (e) {
  var container = $("#searchResults");

  // If the target of the click isn't the container nor a descendant of the container, hide the results
  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.hide();
  }
});

function generateCode() {
  document.getElementById("testCodeButton").disabled = false;
  // Check if the button is disabled (prevent multiple clicks)
  if ($("#generateButton").prop("disabled")) {
    alert("Code generation is disabled. Please wait for 12 hours.");
    return;
  }

  // Generate a random 4-letter code
  const generatedCode = generateRandomCode(4);

  // Insert the code into the input field
  $("#codeInput").val(generatedCode);

  // Disable the button for the next 12 hours
  $("#generateButton").prop("disabled", true);

  // Enable the button after 12 hours (12 hours = 12 * 60 * 60 * 1000 milliseconds)
  setTimeout(function () {
    $("#generateButton").prop("disabled", false);
  }, 12 * 60 * 60 * 1000);
}

function generateRandomCode(length) {
  const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  let randomCode = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    randomCode += characters.charAt(randomIndex);
  }

  return randomCode;
}

function startTimer() {
  const generateButton = document.getElementById("generateButton");
  if (generateButton) {
    generateButton.parentNode.removeChild(generateButton);
    document.getElementById("testCodeButton").style.display="";
  }
}


function testCode() {
  const enteredCode = document.getElementById("codeInput").value;
  const resultLabel = document.getElementById("discount_info");

  validateCodeOnServer(enteredCode)
    .then((response) => {
      if (response.valid) {
        const discountAmount = response.discountAmount || 0; // Default to 0 if not provided
        resultLabel.innerHTML = `🎉Намаление: ${discountAmount}%🎉`;
        resultLabel.style.color = "rgb(0, 184, 68)";
        document.getElementById("codeInput").style.border = "2px solid green";
        document.getElementById("win").style.display = "inline";
//         var bubbles = document.getElementsByClassName("bubbles");
// for (var i = 0; i < bubbles.length; i++) {
//     bubbles[i].style.display = "none";
// }

      } else {
        resultLabel.innerHTML = "Опитай пак следваща поръчка.";
        resultLabel.style.color = "rgb(171, 19, 19)";
        document.getElementById("codeInput").style.border = "2px solid rgb(171, 19, 19)";
      }
    })
    .catch((error) => {
      console.error("Error validating code:", error);
      resultLabel.innerHTML = "Error validating code. Please try again.";
      resultLabel.style.color = "rgb(151, 17, 17)";
      document.getElementById("codeInput").style.border = "2px solid rgb(171, 19, 19)";
    });
    document.getElementById("testCodeButton").parentNode.removeChild(document.getElementById("testCodeButton"));
}

function validateCodeOnServer(enteredCode) {
  const endpoint = "codecheck.php"; // Update with the correct path to your PHP file

  return fetch(endpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ code: enteredCode }),
  }).then((response) => response.json());
}

$(document).ready(function () {
  // Initial load
  loadMovies("all");

  // Button click events
  $("#btnAll").click(function () {
    loadMovies("all");
  });
  $("#btnAllAdmin").click(function () {
    loadMovies("admin");
  });

  $("#btnAnimations").click(function () {
    loadMovies("animations");
  });

  $("#btnPremieres").click(function () {
    loadMovies("action");
  });

  $("#btnHorror").click(function () {
    loadMovies("horror");
  });
  $("#btnComedy").click(function () {
    loadMovies("comedy");
  });

  $("#btnFav").click(function () {
    loadMovies("fav");
  });
  $("#btnAZ").click(function () {
    loadMovies("a-z");
  });
  $("#btnDate").click(function () {
    loadMovies("date");
  });

  $("#btnComingSoon").click(function () {
    loadMovies("coming_soon");
  });

  function loadMovies(category) {
    $.ajax({
      type: "POST",
      url: "load_movies.php", // Create this PHP file to handle database queries
      data: { category: category },
      success: function (response) {
        // Update the movies container with the new data
        $("#menu").html(response);
      },
      error: function () {
        alert("Error loading movies.");
      },
    });
  }
});
function toggleButton(buttonId) {
  // Remove selected class from all buttons
  var buttons = document.querySelectorAll('button[id^="btn"]');
  buttons.forEach(function(btn) {
    btn.classList.remove('selected');
  });

  // Add selected class to the clicked button
  var clickedButton = document.getElementById(buttonId);
  clickedButton.classList.add('selected');


 
}


   
