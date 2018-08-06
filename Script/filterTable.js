$(document).ready(function(){
    $("#searchInput").on("input", function() {
        var value = $(this).val().toLowerCase();
        $("#searchTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});