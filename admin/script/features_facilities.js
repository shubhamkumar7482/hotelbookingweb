
let features_s_form = document.getElementById('features_s_form');
let facilities_s_form = document.getElementById('facilities_s_form');

features_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_features();
});

function add_features() {
    let data = new FormData();
    data.append('name', features_s_form.elements['features_name'].value);
    data.append('add_features', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('features-s')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New features added');
            features_s_form.elements['features_name'].value = '';
            get_features();

        } else {
            alert('error', 'featues upload failed. Server Down!');
        }


    }

    xhr.send(data);
}


// now thid request will to ajax features and facilities page 'get_featues' 
function get_features() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('features-data').innerHTML = this.responseText;
    }

    xhr.send('get_features');
}

// now thid request will to ajax features and facilities page 'get_featues' 
function rem_feature(val) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        if (this.responseText == 1) {
            alert('success', 'featue removed!');
            get_features();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Features is added in room!')
        } else {
            alert('error', 'Server Down!Features has been added in room!');
        }


    }

    xhr.send('rem_feature=' + val);
}

// this is facilities code 
facilities_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_facilities();
});

function add_facilities() {
    let data = new FormData();
    data.append('name', facilities_s_form.elements['facilities_name'].value);
    data.append('icon', facilities_s_form.elements['facilities_icon'].files[0]);
    data.append('desc', facilities_s_form.elements['facilities_desc'].value);
    data.append('add_facilities', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('facilities-s')
        var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'Only svg images are allowed!');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 1MB!');
        } else if (this.responseText == 'upd_faild') {
            alert('error', 'Image upload failed. Server Down!');
        } else {
            alert('success', 'New facilities added');
            facilities_s_form.reset();
            get_facilities();
        }


    }

    xhr.send(data);
}

function get_facilities() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }

    xhr.send('get_facilities');
}

function rem_facilities(val) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        if (this.responseText == 1) {
            alert('success', 'Facilities removed!');
            get_facilities();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Facilities is added in room!')
        } else {
            alert('error', 'Server Down! facilities');
        }


    }

    xhr.send('rem_facilities=' + val);
}




window.onload = function () {
    get_features();
    get_facilities()
}
