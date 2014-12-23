//binds to onchange event of your input field
$('.file').bind('change', function() {
  var maxSizeFile = 2000000;
  var sizeFile = this.files[0].size;
  
  if(sizeFile > maxSizeFile)
  {
    alert('El archivo es muy pesado. Debe ser menor a 2MB');
    $('button').prop("disabled", true);
  }
  else
  {
    $('button').prop("disabled", false);
  }
  
});