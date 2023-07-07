$(document).ready(function(){
    // Cargar usuarios existentes
    loadUsers();
    
    // Agregar usuario
    $('#addForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_user.php',
            data: $(this).serialize(),
            success: function(response){
                $('#message').html(response);
                $('#addForm')[0].reset();
                loadUsers();
            }
        });
    });
    
    // Eliminar usuario
    $(document).on('click', '.delete-btn', function(){
        if (confirm('¿Estás seguro de eliminar este usuario?')){
            var id = $(this).data('id');
            var element = this;
            $.ajax({
                type: 'POST',
                url: 'delete_user.php',
                data: {id: id},
                success: function(response){
                    $(element).closest('tr').fadeOut();
                    $('#message').html(response);
                    loadUsers();
                }
            });
        }
    });
});

// Cargar usuarios desde la base de datos
function loadUsers(){
    $.ajax({
        type: 'POST',
        url: 'get_users.php',
        success: function(response){
            $('#userTable').html(response);
        }
    });
}
