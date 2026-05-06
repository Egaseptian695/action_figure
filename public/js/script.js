document.querySelectorAll('.btn-wishlist').forEach(btn => {
    btn.addEventListener('click', function () {

        let productId = this.dataset.id;
        let button = this;

        fetch(BASEURL + '/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id_product=' + productId
        })
        .then(res => res.json())
        .then(data => {

            if (data.status === 'not_login') {
                alert('Silakan login dulu!');
                window.location.href = BASEURL + '/auth/login';
                return;
            }

            if (data.status === 'added') {
                button.innerHTML = '❤️';
            } else {
                button.innerHTML = '🤍';
            }

        });
    });
});