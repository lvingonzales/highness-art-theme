const navButtons = document.querySelectorAll(".nav-button");
const navContainer = document.querySelector(".nav-container");

navButtons.forEach(button => {
    button.addEventListener("click", function () {
        navContainer.classList.toggle("active");
    })
});
