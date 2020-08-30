$(document).on("click", ".getinfo", function(e){
    e.preventDefault();
    $.get("https://jsonplaceholder.typicode.com/users/"+$(this).attr('id')+"",function(response){
        $(".render-area").html('<p><b>ID: </b>'+response.id+'</p><p><b>Name: </b>'+response.name+'</p><p><b>Username: </b>'+response.username+'</p><p><b>Email: </b>'+response.email+'</p><p><b>Phone: </b>'+response.phone+'</p><p><b>Website: </b>'+response.website+'</p>');
    });
});