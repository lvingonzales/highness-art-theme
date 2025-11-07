const dropdown = document.querySelector(".dropdown-btn");

// Woof specific

const woofBody = document.querySelector(".woof");

dropdown.addEventListener("click", function() {
    woofBody.classList.toggle('active');
});
