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
