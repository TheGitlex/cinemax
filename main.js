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

  var selectedMovieId = document.getElementById("movieselect").value;

  window.location.href = "movie.php?id=" + selectedMovieId;
}

$("#searchInput").on("input", function () {
  performSearch();
});

function performSearch() {
  var searchTerm = $("#searchInput").val();

  if (!searchTerm.trim()) {
    $("#searchResults").hide(); 
    return;
  }

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

  results.forEach(function(result) {
    var resultHtml = '<div style="display:flex; padding:5px; border-radius:5px">';
    resultHtml += '<a href="movie.php?id=' + result.id + '" style="text-decoration: none; display: flex; align-items: center;width:100%">'; 
    resultHtml += '<img src="icons/' + result.icon + '" alt="" style="height:80px; margin-right: 10px;">'; 
    resultHtml += result.title; 
    resultHtml += '</a>'; 
    resultHtml += '</div>';

    resultsContainer.append(resultHtml);
  });

  resultsContainer.show();
}

$(document).mouseup(function (e) {
  var container = $("#searchResults");

  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.hide();
  }
});

function generateCode() {
  document.getElementById("testCodeButton").disabled = false;

  if ($("#generateButton").prop("disabled")) {
    alert("Code generation is disabled. Please wait for 12 hours.");
    return;
  }

  const generatedCode = generateRandomCode(4);

  $("#codeInput").val(generatedCode);

  $("#generateButton").prop("disabled", true);

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
        const discountAmount = response.discountAmount || 0; 
        resultLabel.innerHTML = `🎉Намаление: ${discountAmount}%🎉`;
        resultLabel.style.color = "rgb(0, 184, 68)";
        document.getElementById("codeInput").style.border = "2px solid green";
        document.getElementById("win").style.display = "inline";

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
  const endpoint = "codecheck.php"; 

  return fetch(endpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ code: enteredCode }),
  }).then((response) => response.json());
}

$(document).ready(function () {

  loadMovies("all");

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
      url: "load_movies.php", 
      data: { category: category },
      success: function (response) {

        $("#menu").html(response);
      },
      error: function () {
        alert("Error loading movies.");
      },
    });
  }
});
function toggleButton(buttonId) {

  var buttons = document.querySelectorAll('button[id^="btn"]');
  buttons.forEach(function(btn) {
    btn.classList.remove('selected');
  });

  var clickedButton = document.getElementById(buttonId);
  clickedButton.classList.add('selected');

}