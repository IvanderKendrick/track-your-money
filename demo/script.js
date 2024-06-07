// Hamburger Menu
const menuBtn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");

menuBtn.addEventListener("click", () => {
  menu.classList.toggle("active");
});

document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector("header");
  const firstSectionHeight = document.querySelector("section").offsetHeight;

  // Tambahkan sedikit nilai, misalnya 50 piksel
  const threshold = firstSectionHeight - 50;

  window.addEventListener("scroll", function () {
    if (window.scrollY > threshold) {
      header.classList.add("bg-blue");
    } else {
      header.classList.remove("bg-blue");
    }
  });
});
