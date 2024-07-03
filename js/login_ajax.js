            function showpass(){
                if(this.checked){
                    // alert("check");
                    document.getElementById('inputPassword').setAttribute('type','text')
                }
                else{
                        // alert("ubcheck");
                        document.getElementById('inputPassword').setAttribute('type','password')
                    }
            }
            document.getElementById('showPass').addEventListener('click' , showpass);

            $(document).on('submit','#login',function(e){
                e.preventDefault(e);
              ;  var formData = new FormData(this);
                formData.append("acc_login", true);
                // alert(formData);
                $("#login_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div></div>");
                document.getElementById("login_btn").disabled = true;
                $.ajax({
                    method: "POST",
                    url: "inputConfig.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success:function(response){
                        var res = jQuery.parseJSON(response);

                        if(res.status == 200){
                            $("#login").css("display","none");
                            $("#verify_otp").removeClass("d-none");
                            $("#user_id").val(res.data.acc_rand_id);
                            $("#email").text(res.data.acc_email);
                            const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                            });
                            Toast.fire({
                              icon: res.icon,
                              title: res.message,
                            })
                        }
                        if(res.status == 404){
                            const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                            });
                            Toast.fire({
                              icon: res.icon,
                              title: res.message,
                            })
                            $("#login_btn").text("Login");
                            document.getElementById("login_btn").disabled = false;
                        }
                        if(res.status == 302){
                            const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                            });
                            Toast.fire({
                              icon: res.icon,
                              title: res.message,
                            })
                            $("#login_btn").text("Login");
                            document.getElementById("login_btn").disabled = false;
                        }
                    }
                })
            });

            $(document).on("submit","#verify_otp",function(e){
                e.preventDefault();
                var formData = new FormData(this);
                formData.append("verify_otp",true);
                $("#otp_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'>Loading...</span></div></div>");
                document.getElementById("otp_btn").disabled = true;
                $.ajax({
                     method: "POST",
                    url: "inputConfig.php",
                    data: formData,
                    processData: false,
                    contentType:false,
                    success:function(response){
                        var res = jQuery.parseJSON(response);
                        if(res.status == 200){
                            const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                              timerProgressBar: true,
                            });
                            Toast.fire({
                              icon: res.icon,
                              title: "Log in Successfully",
                            }).then(()=>{
                                window.location.href=res.redirect;
                            });
                        }
                        if(res.status == 302){
                            const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                            });
                            Toast.fire({
                              icon: res.icon,
                              title: res.message,
                            })
                            $("#otp_btn").text("Submit OTP Code");
                            document.getElementById("otp_btn").disabled = false;
                        }
                    }
                });
            });

