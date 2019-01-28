function validateForm() {
    var x = document.forms["searchB"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}