
        let add_room_form = document.getElementById('add_room_form');

        add_room_form.addEventListener('submit', function(e) {
            e.preventDefault();

            add_rooms();
        });

        function add_rooms() {
            let data = new FormData();

            data.append('name', add_room_form.elements['name'].value);
            data.append('area', add_room_form.elements['area'].value);
            data.append('price', add_room_form.elements['price'].value);
            data.append('quantity', add_room_form.elements['quantity'].value);
            data.append('adult', add_room_form.elements['adult'].value);
            data.append('children', add_room_form.elements['children'].value);
            data.append('desc', add_room_form.elements['desc'].value);
            data.append('add_rooms', '');

            let features = [];
            add_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    features.push(el.value);

                }
            });

            let facilities = [];
            add_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    facilities.push(el.value);

                }
            });
            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('add-rooms-m')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'New room has added!');
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Sorry! New room has not added');
                }

            }

            xhr.send(data);

        }

        function get_all_rooms() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('rooms-data').innerHTML = this.responseText;
            }

            xhr.send('get_all_rooms');

        }

        function edit_details(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                let data = JSON.parse(this.responseText)
                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc'].value = data.roomdata.discription;
                edit_room_form.elements['room_id'].value = data.roomdata.id;

                edit_room_form.elements['features'].forEach(el => {
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;

                    }
                });

                edit_room_form.elements['facilities'].forEach(el => {
                    if (data.facilities.includes(Number(el.value))) {
                        el.checked = true;

                    }
                });

            }

            xhr.send('get_room=' + id);
        }

        edit_room_form.addEventListener('submit', function(e) {
            e.preventDefault();

            submit_edit_rooms();
        });

        function submit_edit_rooms() {
            let data = new FormData();

            data.append('room_id', edit_room_form.elements['room_id'].value);
            data.append('name', edit_room_form.elements['name'].value);
            data.append('area', edit_room_form.elements['area'].value);
            data.append('price', edit_room_form.elements['price'].value);
            data.append('quantity', edit_room_form.elements['quantity'].value);
            data.append('adult', edit_room_form.elements['adult'].value);
            data.append('children', edit_room_form.elements['children'].value);
            data.append('desc', edit_room_form.elements['desc'].value);
            data.append('edit_rooms', '');

            let features = [];
            edit_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    features.push(el.value);

                }
            });

            let facilities = [];
            edit_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    facilities.push(el.value);

                }
            });
            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('edit-room')
                var modal = bootstrap.Modal.getInstance(myModal) // Returns a Bootstrap modal instance
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'New room data has updated!');
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Sorry! room data has not updated');
                }

            }

            xhr.send(data);

        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Status toggled!');
                    get_all_rooms();
                } else {
                    alert('error', 'server down!')
                }
            }

            xhr.send('toggle_status=' + id + '&value=' + val);
        }

        let add_image_form = document.getElementById('add_image_form');

        add_image_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_image();
        });

        function add_image() {
            let data = new FormData();
            data.append('image', add_image_form.elements['image'].files[0]);
            data.append('room_id', add_image_form.elements['room_id'].value);
            data.append('add_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                if (this.responseText == 'inv_img') {
                    alert('error', 'Only JPEG , PNG and WEBP images are allowed!');
                } else if (this.responseText == 'inv_size') {
                    alert('error', 'Image should be less than 2MB!');
                } else if (this.responseText == 'upd_faild') {
                    alert('error', 'Image upload failed. Server Down!');
                } else {
                    alert('success', 'New image added ', 'image-alert');
                    room_images(add_image_form.elements['room_id'].value, document.getElementById('room_name').innerText);
                    add_image_form.reset();
                }

            }

            xhr.send(data);
        }

        function room_images(id, rname) {
            console.log(id);
            document.getElementById('room_name').innerText = rname;
            add_image_form.elements['room_id'].value = id;
            add_image_form.elements['image'].value = '';

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('rooms-image-data').innerHTML = this.responseText;
            }

            xhr.send('get_room_images=' + id);
        }

        function rem_image(img_id, room_id) {

            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('rem_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                console.log(this.responseText);

                if (this.responseText == 1) {
                    alert('success', 'Image removed!');
                    room_images(room_id, document.getElementById('room_name').innerText);
                } else {
                    alert('error', 'Image removal failed!');
                }
            }

            xhr.send(data);
        }

        function thumb_image(img_id, room_id) {

            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('thumb_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                // console.log(this.responseText);

                if (this.responseText == 1) {
                    alert('success', 'Thumbnail changed!');
                    room_images(room_id, document.getElementById('room_name').innerText);
                } else {
                    alert('error', 'Thumbnail changed failed!');
                }
            }

            xhr.send(data);
        }

        function remove_room(room_id) {

            if (confirm("Are you sure, you want to delete this room")) {
                let data = new FormData();
                data.append('room_id', room_id);
                data.append('remove_room', '');

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);

                xhr.onload = function() {
                    console.log(this.responseText);

                    if (this.responseText == 1) {
                        alert('success', 'Room Removed!');
                        get_all_rooms();
                    } else {
                        alert('error', 'Room removal failed!');
                    }
                }
                xhr.send(data);
            }
        }

        window.onload = function() {
            get_all_rooms();
        }
