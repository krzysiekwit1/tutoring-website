const navSlide = () => {
  const navButton = document.querySelector(".nav-button");
  const nav = document.querySelector(".nav-links");
  const navLinks = document.querySelectorAll(".nav-links li");
  //Apearing/Disapearing effect
  navButton.addEventListener("click", () => {
    nav.classList.toggle("nav-active");
    //navlink show method
    navLinks.forEach((link, index) => {
      if (link.style.animation) {
        link.style.animation = "";
      } else {
        link.style.animation = `navLinkFade 0.5s ease forwards ${
          index / 7 + 0.2
        }s`;
        console.log(index);
      }
    });
    //button animation
    navButton.classList.toggle("toggle");
  });
};
navSlide();

document.getElementById("SignIn").addEventListener("click", function () {
  document.querySelector(".bg-modal").style.display = "flex";
});
document
  .querySelector(".login-close-button")
  .addEventListener("click", function () {
    document.querySelector(".bg-modal").style.display = "none";
  });

document.getElementById("SignUp").addEventListener("click", function () {
  document.querySelector(".bg-modal1").style.display = "flex";
});
document
  .querySelector(".login-close-button1")
  .addEventListener("click", function () {
    document.querySelector(".bg-modal1").style.display = "none";
  });
function reload(element) {
  var container = document.getElementById("'" + element + "'");
  var content = container.innerHTML;
  container.innerHTML = content;

  //this line is to watch the result in console , you can remove it later
  console.log("Refreshed");
}

function clickOnElement(element) {
  var container = document.getElementById("'" + element + "'");
  container.click();

  //this line is to watch the result in console , you can remove it later
  console.log("Refreshed");
}
document.getElementById("");

function datalistValidator(modelname) {
  var obj = $("#languageList").find("option[value='" + modelname + "']");
  if (obj != null && obj.length > 0) {
    return true;
  }
  return false;
}

$(document).ready(function () {
  $("#addAdvertForm").submit(function () {
    var modelname = $("#language5AdvertCreate").val();
    var existingModelName = $("#language5AdvertCreate").text();
    //alert("Submitted: " + modelname);
    if (datalistValidator(modelname)) {
      return true;
    }
    document.querySelector("#language5AdvertCreate").style.borderBottomColor =
      "red";
    $("#language5AdvertCreate").effect("shake", {
      distance: 5,
      times: 2,
    });

    return false;
  });
});

$("#nameAdvertCreate").change(function () {
  $("#nameAdvertView").empty();
  var change = $("#nameAdvertCreate").val();
  $("#nameAdvertView").append(change);
});
$("#lastnameAdvertCreate").change(function () {
  $("#lastnameAdvertView").empty();
  var change = $("#lastnameAdvertCreate").val();
  $("#lastnameAdvertView").append(change);
});
$("#nativLanguage1AdvertCreate").change(function () {
  $("#nativLanguage1View").empty();
  var change = $("#nativLanguage1AdvertCreate").val();
  $("#nativLanguage1View").append(change);
});
$("#nativLanguage2AdvertCreate").change(function () {
  $("#nativLanguage2View").empty();
  var change = $("#nativLanguage2AdvertCreate").val();
  $("#nativLanguage2View").append(change);
});
