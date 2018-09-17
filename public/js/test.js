function soxdqrzyhcunemfptgvlkiwbj_create(data) {
    soxdqrzyhcunemfptgvlkiwbj_rendered = true;
    var loader_element = document.getElementById("soxdqrzyhcunemfptgvlkiwbj_loader");
    loader_element.parentNode.removeChild(loader_element);
    document.getElementById("soxdqrzyhcunemfptgvlkiwbj").style.display = 'block';
    window.soxdqrzyhcunemfptgvlkiwbj = new Chart(document.getElementById("soxdqrzyhcunemfptgvlkiwbj").getContext("2d"), {
        type: data[0].type,
        data: {
            labels: ["One", "Two", "Three", "Four"],
            datasets: data
        },
        options: {"maintainAspectRatio": false, "scales": {"xAxes": [], "yAxes": [{"ticks": {"beginAtZero": true}}]}}
    });
}

let soxdqrzyhcunemfptgvlkiwbj_rendered = false;
let soxdqrzyhcunemfptgvlkiwbj_load = function () {
    if (document.getElementById("soxdqrzyhcunemfptgvlkiwbj") && !soxdqrzyhcunemfptgvlkiwbj_rendered) {
        soxdqrzyhcunemfptgvlkiwbj_create([{
            "borderWidth": 2,
            "data": [1, 2, 3, 4],
            "label": "My dataset",
            "type": "line"
        }, {"borderWidth": 2, "data": [4, 3, 2, 1], "label": "My dataset 2", "type": "line"}])
    }
};
window.addEventListener("load", soxdqrzyhcunemfptgvlkiwbj_load);
document.addEventListener("turbolinks:load", soxdqrzyhcunemfptgvlkiwbj_load);