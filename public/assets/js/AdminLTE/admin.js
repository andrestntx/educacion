function deleteModel(button_id) 
{
   var button = $('#'+button_id);
   var id = button.data('id');
   button.parents('tr').fadeOut(1000);
   var form = $('#form-delete');
   var action = form.attr('action').replace('USER_ID', id);
   var row =  button.parents('tr');
   
   row.fadeOut(1000);
   
   $.post(action, form.serialize(), function(result) {
      if (result.success) 
      {
         setTimeout (function () {
            row.delay(1000).remove();
            var result_html = '<div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div>';
            $('.box-footer').append(result_html);
         }, 1000);                
      } else 
      {
         row.show();
         var result_html = '<div class="alert alert-danger alert-dismissable"> <i class="fa fa-frown-o"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+result.msg+'</div>';
         $('.box-footer').append(result_html);
      }
   }, 'json');
}