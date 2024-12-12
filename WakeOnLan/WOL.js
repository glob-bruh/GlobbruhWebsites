function fillMac() {
    y = document.getElementsByName("targMac")[0];
    y.value = document.getElementById("compSel").value;
}

async function generateDropdown(json) {
    for (let i =0 ; i < json["hosts"].length ; i++) {
        var t = json["hosts"][i]
        var x = document.createElement("option");
        x.text = t["name"];
        x.value = t["mac"];
        document.getElementById("compSel").append(x)
    }
}

async function getJson(url) {
    const response = await fetch(url);
    const json = await response.json();
    return json;
}

async function main() {
    const jsonOut = await getJson("hosts.json");
    generateDropdown(jsonOut)
}

main()