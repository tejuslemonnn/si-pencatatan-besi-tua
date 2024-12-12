// hidden 1
function option1() {
    $("#option1-form").hide();
    $("#option2-form").hide();
}
function option2() {
    $("#option1-form").hide();
    $("#option2-form").show();
}
function option3() {
    $("#option1-form").show();
    $("#option2-form").show();
}

// hidden 2
function handleSelectChange() {
    var selectedValue = $("#producttype").val();

    if (selectedValue == "service") {
        $("#text2-form").hide();
        $("#text1-form").show();
    } else if (selectedValue == "asset") {
        $("#text1-form").hide();
        $("#text2-form").show();
    } else {
        $("#text1-form").hide();
        $("#text2-form").hide();
    }
}

// Bind change event to "producttype" select element
$(document).ready(function () {
    $("#producttype").on("change", handleSelectChange);
});
