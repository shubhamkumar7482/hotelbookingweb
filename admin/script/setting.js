
let general_data;
let general_s_form = document.getElementById('general_s_form');

let site_email_inp = document.getElementById('site_email_inp');
let site_no_inp = document.getElementById('site_no_inp');
let site_address_inp = document.getElementById('site_address_inp');

let contacts_s_form = document.getElementById('contacts_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

function get_general() {
    let site_email = document.getElementById('site_email');
    let site_no = document.getElementById('site_no');
    let site_address = document.getElementById('site_address');

    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        general_data = JSON.parse(this.responseText);
       

        site_email.innerText = general_data.site_email;
        site_no.innerText = general_data.site_no;
        site_address.innerText = general_data.site_address;

        site_email_inp.value = general_data.site_email;
        site_no_inp.value = general_data.site_no;
        site_address_inp.value = general_data.site_address;

        if (general_data.shutdown == 0) {
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        } else {
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
        }
    }

    xhr.send('get_general');
}

general_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    upd_general(site_email_inp.value, site_no_inp.value, site_address_inp.value);
});


function upd_general(site_email_val, site_no_val, site_address_val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        var myModal = document.getElementById('general-s')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'changes saved!');
            get_general();
        } else {
            alert('error', 'No change made!');
        }
        // console.log(this.responseText);

        // general_data = JSON.parse(this.responseText);

        // site_email.innerText = general_data.site_email;
        // site_no.innerText = general_data.site_no;
        // site_address.innerText = general_data.site_address;

        // site_email_inp.value = general_data.site_email;
        // site_no_inp.value = general_data.site_no;
        // site_address_inp.value = general_data.site_address;
    }

    xhr.send('site_email=' + site_email_val + '&site_no=' + site_no_val + '&site_address=' + site_address_val + '&upd_general');
}

function upd_shutdown(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        if (this.responseText == 1 && general_data.shutdown == 0) {
            alert('success', 'Site has been shutdown!');
            get_general();
        } else {
            alert('error', 'shutdown mode is off!');
        }
        // console.log(this.responseText);

        // general_data = JSON.parse(this.responseText);

        // site_email.innerText = general_data.site_email;
        // site_no.innerText = general_data.site_no;
        // site_address.innerText = general_data.site_address;

        // site_email_inp.value = general_data.site_email;
        // site_no_inp.value = general_data.site_no;
        // site_address_inp.value = general_data.site_address;
    }

    xhr.send('upd_shutdown=' + val);
}

function get_contacts() {
    let contacts_P_id = ['address', 'pn1', 'pn2', 'email', 'lkd', 'gth', 'insta', 'fb', 'gmap'];
    let iframe = document.getElementById('iframe');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        contacts_data = JSON.parse(this.responseText);
        contacts_data = Object.values(contacts_data);
        console.log(contacts_data);

        for (i = 0; i < contacts_P_id.length; i++) {
            document.getElementById(contacts_P_id[i]).innerText = contacts_data[i + 1];
        }
        iframe.src = contacts_data[10];

        contacts_inp(contacts_data);

    }

    xhr.send('get_contacts');
}

function contacts_inp(data) {
    let contacts_inp_id = ['address_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'lkd_inp', 'gth_inp', 'insta_inp', 'fb_inp', 'gmap_inp', 'iframe_inp'];

    for (i = 0; i < contacts_inp_id.length; i++) {
        document.getElementById(contacts_inp_id[i]).value = data[i + 1];
    }
}

contacts_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    upd_contacts();
});

function upd_contacts() {
    let index = ['address', 'pn1', 'pn2', 'email', 'lkd', 'gth', 'insta', 'fb', 'gmap', 'iframe'];
    let contacts_inp_id = ['address_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'lkd_inp', 'gth_inp', 'insta_inp', 'fb_inp', 'gmap_inp', 'iframe_inp'];

    let data_str = "";

    for (i = 0; i < index.length; i++) {
        data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
    }
    data_str += "upd_contacts";
    console.log(data_str);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        var myModal = document.getElementById('contacts-s')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'change has been saved!');
            get_contacts();
        } else {
            alert('error', 'change has been not saved!');
        }

    }

    xhr.send(data_str);

}

team_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_member();
});

function add_member() {
    let data = new FormData();
    data.append('name', member_name_inp.value);
    data.append('picture', member_picture_inp.files[0]);
    data.append('add_member', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('team-s')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPEG , PNG and WEBP images are allowed!');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2MB!');
        } else if (this.responseText == 'upd_faild') {
            alert('error', 'Image upload failed. Server Down!');
        } else {
            alert('success', 'New member added');
            member_name_inp.value = '';
            member_picture_inp.value = '';
            get_member();
        }

    }

    xhr.send(data);
}

function get_member() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send(' get_member');
}

function rem_member(val) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        if (this.responseText == 1) {
            alert('success', 'Member removed!');
            get_member();
        } else {
            alert('error', 'Server Down!');
        }


    }

    xhr.send('rem_member=' + val);
}

window.onload = function () {
    get_general();
    get_contacts();
    get_member()
}
