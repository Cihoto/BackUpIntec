<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intec - Log In</title>
    <link
      rel="shortcut icon"
      href="./assets/images/logo/intech_logo.png"
      type="image/png"
    />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <link rel="stylesheet" href="./assets/css/main/login.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"
    integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
</head>
<body>
    <!-- partial:index.partial.html -->
    <div class="screen-1">
        <div class="login-logo">
            <img src="./assets/images/logo/intech_horizontal.png" alt="Logo" class="logo" srcset="" width="50%" />
        </div>
        <div class="email">
            <label for="email">Correo electrónico</label>
            <div class="sec-2">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" class="" name="email" id="emailInput" placeholder="correo@gmail.com"/>
                <p id="emailMessage"></p>
            </div>
        </div>
        <div class="password">
            <label for="password">Constraseña</label>
            <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input class="pas" type="password" name="password" id="passInput" placeholder="************" />
                <p id="passMessage"></p>
                <!-- <ion-icon class="show-hide" name="eye-outline"></ion-icon> -->
            </div>
        </div>
        <button class="login" id="login">Ingresar </button>
        <div class="footer"><span>Signup</span><span>Forgot Password?</span></div>
    </div>
    <!-- partial -->

    <?php  require_once('./includes/footerScriptsJs.php')?>
</body>
<script>

    function validateEmail(email) {
        var regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        return regex.test(email);
    }
    function RemoveClassFromEmailInput(){
        if($('#emailInput').hasClass('success')){
            $('#emailInput').removeClass('success');
            $('#emailMessage').text('');
        }
        if($('#emailInput').hasClass('err')){
            $('#emailInput').removeClass('err');
            $('#emailMessage').text('');
        }
        if($('#emailInput').hasClass('warning')){
            $('#emailInput').removeClass('warning');
            $('#emailMessage').text('');
        }

    }
    function RemoveClassFromPassInput(){
        if($('#passInput').hasClass('err')){
            $('#passInput').removeClass('err')
            $('#passMessage').text('')
        }
    }

    $('#emailInput').on('click',function(){
        RemoveClassFromEmailInput()
    })
    $('#passInput').on('click',function(){
        RemoveClassFromPassInput()
    })

    function SetEmailClass(classNameInput){
        console.log("CLASS TO CHANGE",classNameInput);
        if(classNameInput !== ""){
            RemoveClassFromEmailInput();
            $('#emailInput').addClass(classNameInput);

            // if(classNameInput === "warning"){
                $('#emailMessage').text("Ingrese un correo")
            // }
        }
    }

    function SetPassClass(pass){
        if(pass === ""){
            $('#passInput').addClass('err');
            $('#passMessage').text('Ingrese una Contraseña')
        }else{
            RemoveClassFromPassInput();
        }
    }
    $('#passInput').on('blur',function(){
        console.log($(this).val());
        SetPassClass($(this).val());
    })

    $('#emailInput').on('blur',function(){
        const isEmail = validateEmail($(this).val());
        if(isEmail){
            const email = $(this).val();
            $('#emailMessage').text("");
            $.ajax({
                type: "POST",
                url: "ws/Usuario/usuario.php",
                data: JSON.stringify(
                {
                    action:'GetUsuario',
                    email: email
                }),
                dataType: 'json',
                success: async function(data) {
                    console.log(data);
                    RemoveClassFromEmailInput();
                   if(data){
                    $('#emailInput').addClass('success')
                    $('#emailMessage').text("Correo Registrado");
                   }else{
                    $('#emailInput').addClass('err')
                    $('#emailMessage').text("Correo no Registrado");
                   }
                }
            })
        }else{
            RemoveClassFromEmailInput()
            $('#emailMessage').text("Ingrese un correo valido");
            $('#emailInput').addClass('warning');
        }
    })

    function checkPass(pass){
        if($('#passInput').hasClass('err')){
            return false;
        }else{
            if(pass !== ""){
                return true;
            }else{
                SetPassClass(pass)
                return false;
            }
        }
    }
    function checkEmail(email){
        if($('#emailInput').hasClass('err') ||$('#emailInput').hasClass('warning') ){
            return false;
        }else{
            if(validateEmail(email)){   
                return true
            }else{
                SetEmailClass('warning');
                return false;
            }
        }
    }
    $('#login').on('click', function() {
        let email = $('#emailInput').val();
        let pass = $('#passInput').val();
        console.log(checkEmail(email));

        if(checkPass(pass) && checkEmail(email)){
            $.ajax({
                type: "POST",
                url: "ws/Usuario/usuario.php",
                data: JSON.stringify(
                {
                    action:'LogUser',
                    request:{
                        email: email,
                        pass: pass 
                    }
                }),
                dataType: 'json',
                success: async function(response){
                    console.log(response);
                    if(response.success){
                        if(response.ref){
                            Swal.fire({
                                icon:"success",
                                text:response.message,
                                showConfirmButton:false,
                                timer:2000
                            }).then(()=>{
                                window.location = "index.php"
                            })
                        }else{
                            Swal.fire({
                                icon:"error",
                                text:response.message,
                                showConfirmButton:false,
                                timer:2000
                            })
                        }
                    }
                }
            })
        }
    })


    // TRIGGER LOGIN ON ENTER PRESS
    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $('#login').trigger('click')
        }
    });
</script>

</html>