$(document).ready(function(){
    function filterTable(value) {
        $("#searchTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)    // toggle() hides rows that don't match.
        });
    }

    $("#searchInput").on("input", function() {
        var value = $(this).val().toLowerCase();
        filterTable(value);
    });

    $("#searchClear").on("click", function() {
       $("#searchInput").val("");
       filterTable("");
    });
});