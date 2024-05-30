function fillMac() {
    x = document.getElementsByName("compSel")[0].selectedIndex;
    y = document.getElementsByName("targMac")[0];

    // Add Preset MAC's in this case statement.
    switch(x) {
        case 0:
            y.value = "";
            break;
        case 1:
            y.value = "11:22:33:44:55:66";
            break;
    }
}