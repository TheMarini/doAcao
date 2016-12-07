/* --- VARIABLES --- */

rankingList = [];

/* --- FUNCTIONS ---*/

function loadRanking() {
    $.ajax({
        url: '/ranking/listar',
        success: function (result) {
            try {
                rankingList = JSON.parse(result);
            } catch (e) {
                rankingList = result;
            }
        },
        error: function () {
            alert('Ajax Request Error');
        },
        complete: function () {
            $('#ranking').empty();
            if ($.isArray(rankingList) || rankingList != "") {
                var index = 0;
                rankingList.forEach(function (rank) {
                    var item = '<li class="pos-' + (index + 1) + '">';
                    item += '<p class="number">' + (index + 1) + 'º</p>';
                    item += '<div>';
                    item += '<img src="' + BASE_URL + rank.photo + '" alt="" class="avatar">';
                    item += '<a href=""><p class="nome">' + rank.nome + '</p></a>';
                    item += '<p class="pontuacao">' + rank.pontos + ' pts.</p>';
                    item += '</div>';
                    item += '</li>';
                    $('#ranking').append(item);
                });
            }else{
                $('#ranking').append("<p>Não há usuários o suficiente para gerar ranking</p>");
            }
        }
    })
}

/* --- EVENTS --- */
$(document).ready(function () {
    loadRanking();
});
