/*------------------------------------------------------
    Author : www.webthemez.com
    License: Commons Attribution 3.0
    http://creativecommons.org/licenses/by/3.0/
---------------------------------------------------------  */

(function ($) {
    "use strict";
    var mainApp = {

        initFunction: function () {
            /*MENU
            ------------------------------------*/
            $('#main-menu').metisMenu();

            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        },

        initialization: function () {
            mainApp.initFunction();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.initFunction();
        $(document).bind('keydown', 'ctrl+c', function(){
                    $('#caribarang').focus();
                 });

        $(document).bind('keydown', 'ctrl+u', function(){
                    $('#uangditerima').focus();
                 });

    });

    $('#caribarang').on('input', function() {
      var value = $(this).val() ;
      if( value.length > 2 && value != "" ){
        $.post(
        "./transaksi/apicaribarang",
        { barang : value },
        function(response) {

            var dthtml = '';
            for(var i = 0; i < response.length; i++) {
              dthtml += '<tr class="gradeU">';
              dthtml += '<td>'+response[i].nama_barang+'</td>';
              dthtml += '<td>Rp. '+addCommas(response[i].harga)+'</td>';
              dthtml += '<td><input name="qty" id="br_'+response[i].barang_id+'"type="number" value="1" /></td>';
              dthtml += '<td><button id="addbrangbtn" onclick="addbuton('+response[i].barang_id+')" type="button" name="submit" class="btn btn-primary btn-sm">Tambahkan</button></td>';
              dthtml += '</tr>' ;
            }

            $('#barangadd').html(dthtml);




        }, 'json');
      }


    });

  $('#uangditerima').on('input', function() {
    //var va = addCommas($(this).val());
    //console.log(va);
    //$(this).val(va);
    var total = parseInt($('#totalbarang').html().replace(',',''));
    var bayar = parseInt($(this).val());
    console.log(total+" "+bayar);
    if(bayar > total ){
      $('#kembalian').html(addCommas(bayar - total));
    }else{
      $('#kembalian').html('0');
    }

  });

  $('#caribarang').focus();


}(jQuery));

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function addbuton(id){
      var qty = $('#br_'+id).val();
      if(qty > 0 ){




        $.post(
        "./transaksi/apiaddbarang",
        { id : id  , qty : qty  },
        function(response) {
              var baranjumlah = parseInt($('#baranjumlah').val()) + 1;
              var inhtml = $('#orderdetail').html();
              var dthtml = '';
              dthtml += '<tr class="gradeU" id="rowid_'+baranjumlah+'">';
              dthtml += '<td>'+response.nama_barang+'</td>';
              dthtml += '<td>'+response.qty+'</td>';
              dthtml += '<td>Rp. '+addCommas(response.harga)+'</td>';
              dthtml += '<td >Rp. <span id="harga_'+baranjumlah+'">'+addCommas(response.sub_total)+'</span> </td>';
              dthtml += '<td><button onclick="removebuton('+baranjumlah+')" type="button" name="submit" class="btn btn-worning btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
              dthtml += '</tr>' ;


              $('#orderdetail').html(dthtml+inhtml);
              $('#baranjumlah').val(baranjumlah);

              var total = $('#totalbarang').html().replace(',','');

              var dtbarangadd = $('#boxbaranghidden').html();
              var addinput = '<input type="hidden" id="rowbaranadd_'+baranjumlah+'" value="'+id+'" name="barangadd[]" />' +
                             '<input type="hidden" id="rowqtyadd_'+baranjumlah+'" value="'+qty+'" name="qtybarang[]" />' +
                             '<input type="hidden" id="rowhargaadd_'+baranjumlah+'" value="'+response.harga+'" name="hargabarangadd[]" />' +
                             dtbarangadd

              $('#boxbaranghidden').html(addinput);

              var to  = parseInt(total) + parseInt(response.sub_total) ;
              $('#totalbarang').html(addCommas(to));
              $('#inputtoalbayar').val(to);


        }, 'json');
      }else{
        alert('Qty Tidak boleh kosong !');
      }
}


function removebuton(id){
    var subharga = parseInt($('#harga_'+id).html().replace(',',''));
    var to  = parseInt($('#inputtoalbayar').val()) - subharga ;
    $('#totalbarang').html(addCommas(to));
    $('#inputtoalbayar').val(to);

    $('#rowid_'+id).remove();
    $('#rowbaranadd_'+id).remove();
    $('#rowqtyadd_'+id).remove();
    $('#rowhargaadd_'+id).remove();
}
