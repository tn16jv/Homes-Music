function postSong(user, song) {
    $.ajax({
        url: "PHP/playerModal.php",
        data:'playSong='+song+'&userName='+user,
        type: "POST",
        success:function(data){
            $("#anArea").html(data);
        },
        error:function (){alert("failure");}
    });
}