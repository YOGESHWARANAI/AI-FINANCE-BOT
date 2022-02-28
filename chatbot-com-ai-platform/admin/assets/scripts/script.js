(function (utils) {
    function submitFormData(url, data) {
        var form = document.createElement('form');
        document.body.appendChild(form);
        form.method = 'post';
        form.action = url;

        Object.entries(data).forEach(function (entry) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = entry[0];
            input.value = entry[1];
            form.appendChild(input);
        });

        form.submit();
    }
    function connectScreen () {
        var button = document.querySelector('#connect_account_button');

        if (!button) {
            return
        }

        button.addEventListener('click', function () {
            button.classList.add('disabled');

            loginSDK.login(function (data) {
                if (data) {
                    submitFormData(
                        utils.adminPageUrl + '&nonce=' + utils.nonce + '&action=log-in',
                        { access_token: data.access_token, email: data.email }
                    );
                }

                button.classList.remove('disabled');
            });
        })
    }

    document.addEventListener('DOMContentLoaded', function () {
        connectScreen();
    });

})(window.wpUtils);
