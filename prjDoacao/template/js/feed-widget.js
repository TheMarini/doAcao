
/* --- VARIABLES --- */
publicacaoList = [];
/* --- FUNCTIONS --- */

function loadFeed(){
    $.ajax({
       dataType: 'json',
       url: '/publicacao/listar',
       success: function(result){
           publicacaoList = result;
       },
       error: function(){
           alert('Ajax Request Error');
       },
       complete: function(){
           $('#posts').empty();
           var index = 0;
           if(publicacaoList.length > 0){
               publicacaoList.forEach(function(pub){
                   var tipo = 'txt';
                   switch(pub.tipo){
                       case '2': tipo = 'img';
                                 break;
                       case '3': tipo = 'progress'
                                 break;
                       default: tipo = 'txt'; 
                   }

                   var item = '<section class="post post-'+tipo+'">';
                       item += '<p class="time"></p>';
                       item += '<div class="autor">';
                       item +=    '<img src="'+BASE_URL+pub.photo+'" alt="">';
                    item +=              '<div class="titulo">';
                    item +=              '<h1><span class="nome"><a href="">'+pub.nm_usuario+'</a></span></h1>';
                    item +=            '</div>';
                    item +=            '</div>';
                        item +=     '<section class="cont">'
                        item +=            '<p>'+pub.conteudo+'</p>';
                        item +=            '</section>';
                        item +=        '</section>';
                   $('#posts').append(item);
               });
           }else{
               $('#posts').append('<p>Não há publicações!');
           }
       }
    });
}

/* -- EVENTS -- */
$('document').ready(function () {
    /*Opacity post-img*/
    $('.post-img').mouseover(function () {
        $(this).find('.autor').css('opacity', 1);
        $(this).find('.time').css('opacity', 1);
    });

    $('.post-img').mouseout(function () {
        $(this).find('.autor').css('opacity', 0.2);
        $(this).find('.time').css('opacity', 0.2);
    });
    
    loadFeed();
});
