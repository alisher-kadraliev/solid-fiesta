
function openLangMenu() {
    document.getElementById("dropdown").classList.toggle("show");
}
window.onclick = function (event) {
    if (!event.target.matches(".dropdown-button")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};

let dropdown2 = document.getElementById('dropdown2')
let dropdown2Toggle = document.getElementById('dropdown2Toggle')

dropdown2Toggle.addEventListener('click', () => {
    dropdown2.classList.toggle('show')
})