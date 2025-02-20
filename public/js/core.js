/**
 * Hiding alerts
 */
const TOAST_TIMEOUT = 4e3

const alertElem = document.querySelector(".alert")
if (alertElem) {
    // appear
    alertElem.classList.add("in");

    // allow dismissal
    alertElem?.addEventListener("click", (event) => {
        alertElem.classList.remove("in")
    })

    // disappear
    setTimeout(() => {
        alertElem.classList.remove("in");
    }, TOAST_TIMEOUT);
}

/**
 * Dangerous actions
 */
document.querySelectorAll("button.danger, .button.danger")
    .forEach(btn => {
        btn.addEventListener("click", (ev) => {
            if (!confirm("Ostrożnie! Czy na pewno chcesz to zrobić?")) {
                ev.preventDefault();
            }
        })
    })


function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
    alert("Skopiowano do schowka.")
}

//* theme management *//

if (localStorage.getItem("theme") == "dark") toggleTheme()

function toggleTheme() {
    const bodyClass = document.body.classList
    bodyClass.toggle("dark")
    localStorage.setItem("theme", bodyClass.contains("dark") ? "dark" : "light")
}
