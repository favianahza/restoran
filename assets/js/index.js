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
  if(order.length == 0){
      Swal.fire({
        icon: "error",
        title: "Gagal",
        text: "Anda tidak memesan apapun!",
        timer: 1500,
        showCancelButton: false,
        showConfirmButton: false
    })
    $('#checkout').fadeOut('fast')
    return false
  } else {
    $('#underlay').css('visibility','visible')
  }

  

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



function review(id, nama_menu, foto){ 
    $('[id^="star"]').attr('class', 'fa fa-star-o')
    $('#rate_underlay').css('visibility','visible')
    $('#title').text("Beri Ulasan "+nama_menu)
    $('#kode_menu').val(id)
    $('#ulasan').val('')

    src="assets/img/menu/"+foto
    $('#thumbnail').attr("src", src)
    
    return true
}


function starRating(rating){
  let i = 0
  $('[id^="star"]').attr('class', 'fa fa-star-o')

  while(i <= rating){
    id='#star'+i
    $(id).attr('class', 'fa fa-star')
    i++
  }
  $("input.rating-value").val(rating)
  return true
}

function submitRate(){
  rating = $("#rating").val()
  ulasan = $("#ulasan").val()
  kode_menu = $("#kode_menu").val()

  if(rating == 0 || ulasan == ''){
    Swal.fire({
        icon: "error",
        title: "Gagal!",
        text: "Rating Bintang dan Ulasan harus diisi !",
        timer: 2000,
        scrollbarPadding: false,
        showCancelButton: false,
        showConfirmButton: false
    })
    return false
  }

  $.post("rate.php", {kode_menu: kode_menu, rating: rating, ulasan: ulasan, submit: "submit"}, function(data){
    console.log(data)
    if(data == "UPDATED"){
      Swal.fire({
          icon: "success",
          title: "Berhasil!",
          text: "Rating dan Ulasan berhasil diupdate !",
          timer: 2000,
          scrollbarPadding: false,
          showCancelButton: false,
          showConfirmButton: false
      })
      $('div#rate_underlay').css('visibility','hidden');
    } else if (data == "CREATED") {
      Swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "Rating dan Ulasan berhasil dibuat !",
        timer: 2000,
        scrollbarPadding: false,
        showCancelButton: false,
        showConfirmButton: false
      })
      $('div#rate_underlay').css('visibility','hidden');
    } else {
      Swal.fire({
        icon: "error",
        title: "Gagal!",
        timer: 2000,
        scrollbarPadding: false,
        showCancelButton: false,
        showConfirmButton: false
      })
      $('div#rate_underlay').css('visibility','hidden');
    }

  })


}