$(function(){

function getUserByID(id){
    (id)?id = "?id="+id: id = '';
    $.ajax({
        type: "GET",
        // data: {id: id}, 
        dataType: 'JSON',
        url: 'services/getUser.php/'+id, // backend URL
        // on success 
        success: function (data) {
            // console.log(data);
            PopulateUsertable(data)
        } // success function end
    }) // Ajax end  

}

function PopulateUsertable(data){
    var table = $('#usertable').DataTable({
        data: data,
        "columns": [
            { "data": "id" },
            { "data": "uname" },
            { "data": "email" },
            { "data": "message" },                
        ],
        searching: true,
        paging: false,
        info: true,
    });
}


getUserByID()
})