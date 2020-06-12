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
