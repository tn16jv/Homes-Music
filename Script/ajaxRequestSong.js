function postSong(user, song) {
    $.ajax({
        url: "PHP/playerModal.php",
        data:'playSong='+song+'&userName='+user,
        type: "POST",
        success:function(data){
            $("#anArea").html(data);
            $("#player").on("ended", function() {
               next();
            });
        },
        error:function (){alert("failure");},
        async: true
    });
}