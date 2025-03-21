// #region theme management
function toggleTheme() {
    const bodyClass = document.body.classList
    bodyClass.toggle("dark")
    localStorage.setItem("theme", bodyClass.contains("dark") ? "dark" : "light")
}
// #endregion
