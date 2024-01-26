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

function daftar(e){
  e.preventDefault();
  jQuery.post()
  return 0;
}