<!-- <?php
$js = "
$(document).ready(function() {
    var keluar = $('#noIC'); 
    
     
    $('#noIC').change(function(e) {
      
        var ic = $('#noIC').val();

        if(ic.match(/^(\d{2})(\d{2})(\d{2})-?\d{2}-?\d{4}$/)) {
            var year = RegExp.$1;
            var month = RegExp.$2;
            var day = RegExp.$3;
            var gender = RegExp.$6;
            
            
            var now = new Date().getFullYear().toString();

            var decade = now.substr(0, 2);
            if (now.substr(2,2) > year) {
                year = parseInt(decade.concat(year.toString()), 10);
            }

            var date = new Date(year, (month - 1), day);

            var g = ( gender & 1 ) ? 'female' : 'male';
            
        }
        
        $('#alamat').val(date);
        $('#alamat2').val(g);


    })
  });
";
$this->registerJs($js);
?> -->