$(document).ready(() => {
    ajax = (url) => {
        console.log('botao pressionado')
        $.ajax({
                url: url,
                method: 'get',
                success: function (data) {
                    document.getElementById('main').innerHTML = data
                },
            }
        )
    }
})


