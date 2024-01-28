// For Loading Screen
$(function(){
  $('#loading').fadeOut('slow', function(){
    $("body").prop("style","overflow: auto")
});
})

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


function success(text, url){
  Swal.fire({
      icon: "success",
      title: "Sukses",
      text: text,
      timer: 1500,
      showCancelButton: false,
      showConfirmButton: false
  }).then(function(){
    window.location.href=url;
  });
  return 0;
}


function failed(text, url){
  Swal.fire({
      icon: "error",
      title: "Gagal",
      text: text,
      timer: 1500,
      showCancelButton: false,
      showConfirmButton: false        
  }).then(function(){
      window.location.href=url;
  });
return 0;
}

function confirm(ev, url, id){
  ev.preventDefault();
  id = "#ID_"+id
  Swal.fire({
      title: "Yakin ingin dihapus?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((result) => {
      if (result.isConfirmed) {
          Swal.fire({
              title: "Sukses",
              text: "Data berhasil dihapus!",
              icon: "success",
              timer: 1200,
              showCancelButton: false,
              showConfirmButton: false                
          }).then(function(){
              fetch(url);
              document.querySelector(id).remove()
          });
      }
    });
  return 0;
}

function prohibited(text, url){
  Swal.fire({
      icon: "error",
      title: "Akses Dilarang!",
      background: '#fff',
      text: text,
      timer: 2000,
      showCancelButton: false,
      showConfirmButton: false        
  }).then(function(){
      window.location.href=url;
  });
return 0;
}


function formatRupiah(money) {
  return new Intl.NumberFormat('id-ID',
    { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 } // diletakkan dalam object
  ).format(money);
}


function increment(id){
  $('#checkout').fadeIn('fast')
  id = "#ID_"+id
  counter = Number($(id).val())
  counter += 1
  $(id).val(counter)  
}


function decrement(id){
  id = "#ID_"+id
  counter = Number($(id).val())
  if(counter <= 0){
    return false
  }
  counter -= 1
  $(id).val(counter)  
}


function checkout(){
  order = []
  postData = []
  total = 0
  $('.order').each(function(){
      value = $(this).val()
      id = $(this).attr('id')
      id = id.split("_")[1]
      data = $(this).attr('aria-data')
      postKey = id + '_' + data
      if(value != 0){
        order.push({[data]: value})
      }
      if(value != 0){
        postData.push({[postKey]: value})
      }      
  });
  $('#underlay').css('visibility','visible')

  order.forEach(function (item, index) {
    for (const [key, value] of Object.entries(item)) {
      // console.log(key, value)
      menu = key.split('_')[0]
      price = key.split('_')[1]
      var content = `<tr class='dynamic'><td>${menu}</td><td>${value} X</td><td>${formatRupiah(price * value)},00</td></tr>`
      $('#table_order').append(content)
      total += price * value
      
    }     
  });
  $('#table_order').after(`<p class='dynamic'>Total: ${formatRupiah(total)},00</p>`)
  values = JSON.stringify(postData)
  $('#submit').after("<input type='hidden' name='values' value='"+values+"'>")
  $('#submit').after("<input type='hidden' name='total' value='"+total+"'>")
}


function close(event){
  $(this).parents('div#underlay').css('visibility','hidden');
}