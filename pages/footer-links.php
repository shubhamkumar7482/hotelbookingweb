<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script>
    function setActive() {
        let navbar = document.getElementById('nav_bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();

    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show " role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom-alert');
        } else {
            document.getElementById(position).appendChild(element);
        }

        setTimeout(remAlert, 8000);

    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }

    // this script for the registration form
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('number', register_form.elements['number'].value);
        data.append('dob', register_form.elements['dob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('register', '')

        var myModal = document.getElementById('register')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            console.log(this.responseText);
            if (this.responseText == 1) {
                alert('error', "Email is already registered!");
            } else if (this.responseText == 2) {
                alert('error', "image upload failed!");
            } else if (this.responseText == 4) {
                alert('error', "Register is failed! Server down!");
            } else {
                alert('success', "you have successfully registered!");
                register_form.reset();

            } 

        }
        xhr.send(data);


    });

    // this script for the login form

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData();

        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);
        data.append('login', '')

        var myModal = document.getElementById('LoginModal')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            console.log(this.responseText);

            if(this.responseText == 3)
            {
                 alert('error', "Email is not verified!");
            }else if(this.responseText == 4){
                alert('error', "Email not Verified!");
            }
            else if(this.responseText == 2){
                alert('error', "incorrect password!");
                login_form.reset();
            }
            else{
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if(fileurl == 'room_details.php'){
                    window.location = window.location.href;
                }else{
                    window.location = window.location.pathname;
                     login_form.reset();
                }

            }
        }
        xhr.send(data);


    });

    function checkLoginToBooking(status,room_id){
        if(status){
            window.location.href='confirm_booking.php?id='+room_id;
        }else{
            alert('error','Please login to book room!');
        }
    }
</script>

</body>

</html>









<!-- 




if (this.responseText === 1) {
                alert('error', "invalid or not email and mobile number!");
            // } else if (this.responseText == 'not_varified') {
            //     alert('error', "Email is not verified!");
            // } else if (this.responseText == 'inactive') {
            //     alert('error', "Account Suspended! Please contact admin");
            } else if (this.responseText === 2) {
                alert('error', "Invalid password!");
            } else {
                // window.location = window.location.pathname;
                alert('success', "successfull password!");                
            } -->