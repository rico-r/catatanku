document.getElementById("nav-button").addEventListener("click", () => {
  document.getElementById("menu").classList.toggle("max-md:hidden");
  //   document.getElementById("navigation").classList.toggle("max-md:hidden");
});

document.getElementById("search").addEventListener("input", () => search());

function logout() {
  formLogout.submit();
}

function search() {
  const keyword = new RegExp(document.getElementById("search").value, "i");

  const list = document.querySelectorAll("#navigation > [class^=lastmod-]");
  list.forEach((el) => {
    if (el.children[0].textContent.search(keyword) == -1) {
      el.classList.add("hidden");
    } else {
      el.classList.remove("hidden");
    }
  });
}
