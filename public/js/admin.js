function showSection(id) {
  const sections = document.querySelectorAll(".content-section");
  sections.forEach(section => {
    section.classList.remove("active");
    section.classList.add("hidden");
  });

  document.getElementById(id).classList.add("active");
  document.getElementById(id).classList.remove("hidden");
}
