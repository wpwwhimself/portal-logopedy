// #region toast
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
// #endregion

// #region dangerous buttons
document.querySelectorAll("button.danger, .button.danger")
    .forEach(btn => {
        btn.addEventListener("click", (ev) => {
            if (!confirm("Ostrożnie! Czy na pewno chcesz to zrobić?")) {
                ev.preventDefault();
            }
        })
    })
// #endregion

// #region file storage functions
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
    alert("Skopiowano do schowka.")
}

function browseFiles(url) {
    window.open(url, "_blank")
}

function selectFile(url, input_id) {
    if (window.opener) {
        window.opener.document.getElementById(input_id).value = url
        window.close()
    }
}
// #endregion

// #region filters
function resetFilters(btn) {
    btn.parentElement.querySelectorAll("input").forEach(input => input.checked = false)
}
// #endregion

// #region nav
function toggleNav() {
    document.querySelector("nav").classList.toggle("hidden");
}
// #endregion

// #region tiles
function expandTile(expandable_uuid) {
    const expandable = document.querySelector(`.tile[data-expandable="${expandable_uuid}"]`)

    expandable.querySelector(".contents").classList.toggle("hidden")
    expandable.querySelector(".expand-btn").classList.toggle("expanded")
}
// #endregion

// #region theme management
if (localStorage.getItem("theme") == "dark") toggleTheme()

function toggleTheme() {
    const bodyClass = document.body.classList
    bodyClass.toggle("dark")
    localStorage.setItem("theme", bodyClass.contains("dark") ? "dark" : "light")
}
// #endregion

// #region JSON inputs
function JSONInputUpdate(input_name) {
    const input = document.querySelector(`input[name="${input_name}"]`)
    const table = document.querySelector(`table[data-name="${input_name}"]`)
    const cols = parseInt(table.getAttribute("data-columns"))
    let newValue = cols == 2 ? {} : []

    table.querySelectorAll("tbody tr").forEach((row, row_no) => {
        switch (cols) {
            case 2:
                const inputs = row.querySelectorAll("input")
                newValue[inputs[0].value] = inputs[1].value
                break

            case 1:
                newValue[row_no] = row.querySelector("input").value
                break

            default:
                newValue[row_no] = Array.from(row.querySelectorAll("input")).map(input => input.value || null)
        }
    })

    input.value = JSON.stringify(newValue)
}

function JSONInputAddRow(input_name, btn) {
    const table = document.querySelector(`table[data-name="${input_name}"]`)
    const newRow = table.querySelector(`tr[role="new-row"]`)

    const clonedRow = newRow.cloneNode(true)
    clonedRow.removeAttribute("role")
    clonedRow.querySelector("td:last-child .button:first-child").remove()
    clonedRow.querySelector("td:last-child .button:last-child").classList.remove("hidden")
    table.querySelector("tbody").appendChild(clonedRow)

    newRow.querySelectorAll("input").forEach(input => input.value = "")
    JSONInputUpdate(input_name)
}

function JSONInputDeleteRow(input_name, btn) {
    btn.closest("tr").remove()
    JSONInputUpdate(input_name)
}
// #endregion
