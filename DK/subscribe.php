    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="bg-light border rounded border-0 border-light d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
                <div class="text-center text-lg-start py-3 py-lg-1">
                    <h2 class="fw-bold mb-2" style="border-color: rgb(31,64,55);">Haber Bültenimize abone olun</h2>
                    <p class="mb-0">En yeni haberler için takipte kalın</p>
                </div>
                <div class="d-flex justify-content-center flex-wrap my-2" method="post">
                    <div class="my-2"><input class="form-control" type="email" id="email" name="email" placeholder="E posta adresiniz.."></div>
                    <div class="my-2"><button id="send_sub" class="btn btn-primary ms-sm-2" data-bss-hover-animate="bounce" type="send" style="color: rgb(255,255,255);background: rgb(31,64,55);">Abone Ol</button></div>
  </div>
            </div>
        </div>

        <script>
        $(document).on('click', '#send_sub', function(e) {
    

              var email = document.getElementById('email').value;

              var dataPost = {
                "email": email,
              };
              var dataString = JSON.stringify(dataPost);
              $.ajax({
                url: 'subscribePost.php',
                data: {
                  myData: dataString
                },
                type: 'POST',
                success: function(response) {
                  const obj = JSON.parse(response);
                  console.warn(obj);
                  if (obj.success == true) {
                    swal('Başarılı!', obj.posted, 'success')
                  } else {
                    var errors = obj.errors;
                    swal('Hata!', errors, 'error')
                  }
                }
              });
            }
        );
      </script>
