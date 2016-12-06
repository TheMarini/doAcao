/* --- VARIABLES --- */

rankingList = [];

/* --- FUNCTIONS ---*/

function loadRanking(){
    $.ajax({
        dataType: 'json',
        url: '/ranking/listar',
        success: function(result){
            rankingList = result;
        },
        error: function(){
            alert('Ajax Request Error');
        },
        complete: function(){
            $('#ranking').empty();
            var index = 0;
            rankingList.forEach(function(rank){
                var item = '<li class="pos-'+ (index+ 1) +'">';
                   item += '<p class="number">' + (index+ 1) + 'º</p>';
                   item += '<div>';
                   item += '<img src="'+ BASE_URL + rank.photo+ '" alt="" class="avatar">';
                   item += '<a href=""><p class="nome">'+rank.nome+'</p></a>';
                   item += '<p class="pontuacao">'+ rank.pontos + ' pts.</p>';
                   item += '</div>';
                   item += '</li>';
                $('#ranking').append(item);
            });
        }
    })
}

/* --- EVENTS --- */
$(document).ready(function(){
    loadRanking();
});