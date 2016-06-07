function paginacaoPrateleiras(pagina, pessoa) {
    //Deixa em destaque a página atual
    $(".active_pagina").click(function () {
        $(".active_pagina").removeClass("active");
        $(this).addClass("active");
    });
    $.ajax({
        url: "../controles/prateleira.php",
        type: 'POST',
        dataType: 'xml',
        data: {pagina: pagina, pessoa: pessoa},
        success: function (dados) {
            console.log(dados);

            var html = "";
            var prateleiras = $(dados).find("prateleiras").find("prateleira");
            for (i = 0; i < prateleiras.length; i++) {
                html += "<tr data-cod=" + $(prateleiras[i]).find('id').text() + ">";
                html += "<td>" + $(prateleiras[i]).find("nome").text() + "</td>";
                html += "<td>" + $(prateleiras[i]).find("estante").text() + "</td>";
                html += '<td><div class="btn-group">\n\
                                                    <a class="btn btn-primary tooltips" data-original-title="Editar" data-placement="bottom" href="editarprateleira.php?id=' + $(prateleiras[i]).find("id").text() + '"><i class="icon_pencil"></i></a>\n\
                                                    <a class="btn btn-danger tooltips" data-original-title="Excluir" data-placement="bottom" onclick="excluirPrateleira(' + $(prateleiras[i]).find("id").text() + ')" href="#"><i class="icon_close_alt2"></i></a>\n\
                                                    </div></td>';
                html += "</tr>";
            }
            $(".paginacao_ajax").html(html);
        },
        error: function (requisicao, erro) {
            alert(erro);
        }
    });
}
function excluirPrateleira(id) {
    var v = confirm("Excluir");
    if (!v) {
        return false;
    }
    //alert(id);
    $.ajax({
        url: "../controles/prateleira.php",
        dataType: 'text',
        type: 'POST',
        data: {id: id},
        success: function (dado) {
            console.log();
            if (dado != 0) {
                $("tr[data-cod=" + dado + "]").hide(3000);
                alert("Excluído com sucesso!");
            }else{
                alert("Erro ao excluir");
            }
        },
        error: function (req, erro) {
            alert(erro);
        }
    });
}

function listarEstantes(pagina, pessoa) {
    //Deixa em destaque a página atual
    $(".active_pagina").click(function () {
        $(".active_pagina").removeClass("active");
        $(this).addClass("active");
    });
    $.ajax({
        url: '../controles/estante.php',
        dataType: 'xml',
        type: 'POST',
        data: {pagina: pagina, pessoa: pessoa},
        success: function (dados) {
            var estantes = $(dados).find("estantes").find("estante");
            var html = "";
            for (i = 0; i < estantes.length; i++) {
                html += "<tr data-cod=" + $(estantes[i]).find('id').text() + ">";
                html += "<td>" + $(estantes[i]).find("nome").text() + "</td>";
                html += '<td style="text-align: center"><div class="btn-group">\n\
                                                    <a class="btn btn-primary tooltips" data-original-title="Editar" data-placement="bottom" href="editarestante.php?id=' + $(estantes[i]).find("id").text() + '"><i class="icon_pencil"></i></a>\n\
                                                    <a class="btn btn-danger tooltips" data-original-title="Excluir" data-placement="bottom" onclick="excluirEstante(' + $(estantes[i]).find("id").text() + ')" href="#"><i class="icon_close_alt2"></i></a>\n\
                                                    </div></td>';
                html += "</tr>";
            }
            var paginas = "";
            paginas +='<ul class="pagination ">\n\
            <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
            var qtdPaginas = $(dados).find("estantes").find("qtdPaginas").text(); 
            for (i = 0; i < qtdPaginas; i++) {
                 if(i==pagina){
                   paginas +=  '<li class="active active_pagina"><a onclick="listarEstantes('+i+','+pessoa+')" href="#">'+(i + 1)+' </a></li>';
                 }else{
                   paginas +=  '<li class="active_pagina"><a onclick="listarEstantes('+i+','+pessoa+')" href="#">'+(i + 1)+' </a></li>';
                 }
             }
            paginas += ' <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li></ul>';
            $(".paginacao_ajax").html(html);
            $(".paginas").html(paginas);
           //console.log();
           //alert($(dados).find("estantes").find("qtdPaginas").text());
        },
        error: function (req, erro) {
            alert(erro);
        }
    });
}
function excluirEstante(id) {
    var v = confirm("Excluir");
    if (!v) {
        return false;
    }
    //alert(id);
    $.ajax({
        url: "../controles/estante.php",
        dataType: 'text',
        type: 'POST',
        data: {id: id},
        success: function (dado) {
            if (dado != 0) {
                $("tr[data-cod=" + dado + "]").hide(3000);
                alert("Excluído com sucesso!");
            }else{
                alert("Erro ao excluir!");
            }
        },
        error: function (req, erro) {
            alert(erro);
        }
    });
}

function listarLivros(pagina, pessoa){   
    var quantidade = $("#quantidade_titulos").val();
    var titulo = $("#pesquisar_titulo").val();
    //alert(titulo);
    //Deixa em destaque a página atual
    $(".active_pagina").click(function () {
        $(".active_pagina").removeClass("active");
        $(this).addClass("active");
    });
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {pagina: pagina, pessoa: pessoa, titulo:titulo, quantidade:quantidade},
        success: function (dados) {
            var livros = $(dados).find("livros").find("livro");
            var html = "";
            var online = false;
            for (i = 0; i < livros.length; i++) {
                html += "<tr data-cod=" + $(livros[i]).find('id').text() + ">";
                html += "<td>" + $(livros[i]).find("titulo").text() + "</td>";
                html += "<td>" + $(livros[i]).find("autor").text() + "</td>";
                html += "<td>" + $(livros[i]).find("area_do_conhecimento").text() + "</td>";
                html += "<td>" + $(livros[i]).find("prateleira").text() + "</td>";
                online = $(livros[i]).find("online").text() ;
                html += '<td style="text-align: left"><div class="btn-group">\n\
                                                    <a class="btn btn-primary tooltips" title="Editar" data-placement="bottom" href="editarlivro.php?id=' + $(livros[i]).find("id").text() + '"><i class="icon_pencil"></i></a>\n\
                                                    <a class="btn btn-danger tooltips" title="Excluir" data-placement="bottom" onclick="excluirLivro(' + $(livros[i]).find("id").text() + ')" href="#"><i class="icon_close_alt2"></i></a>';
                
                if(online==true){
                 html += '<a class="tooltips btn btn-success" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() +',' + pessoa +',' + pagina + ')" href="#"><i class="icon_check_alt"></i></a>';   
                }else{
                   html += '<a class="tooltips btn btn-warning" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() +',' + pessoa +',' + pagina + ')" href="#"><i class="icon_error-circle"></i></a>'; 
                }                                                                    
                html += "</div></td></tr>";
            }
            var paginas = "";
            paginas +='<ul class="pagination ">\n\
            <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
            var qtdPaginas = $(dados).find("livros").find("qtdPaginas").text(); 
            for (i = 0; i < qtdPaginas; i++) {
                 if(i==pagina){
                   paginas +=  '<li class="active active_pagina"><a onclick="listarLivros('+i+','+pessoa+','+0+','+0+')" href="#">'+(i + 1)+' </a></li>';
                 }else{
                   paginas +=  '<li class="active_pagina"><a onclick="listarLivros('+i+','+pessoa+','+0+','+0+')" href="#">'+(i + 1)+' </a></li>';
                 }
             }
            paginas += ' <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li></ul>';
            $(".paginacao_ajax").html(html);
            $(".paginas").html(paginas);
           //console.log();
           //alert($(dados).find("estantes").find("qtdPaginas").text());
        },
        error: function (req, erro) {
            alert("Erro: "+erro);
        }
    });
}
function excluirLivro(id) {
    var v = confirm("Excluir");
    if (!v) {
        return false;
    }
    $.ajax({
        url: "../controles/livro.php",
        dataType: 'text',
        type: 'POST',
        data: {id: id},
        success: function (dado) {
            //console.log();
            if (dado != 0) {
                $("tr[data-cod=" + dado + "]").hide(3000);
                alert("Excluído com sucesso!");
            }
        },
        error: function (req, erro) {
            alert(erro);
        }
    });
}
function onlineLivro(id, pessoa, pagina){
    $.ajax({
        url: "../controles/livro.php",
        type: 'POST',
        dataType: 'text',
        data: {id_online:id, pessoa:pessoa},
        success: function (dado) {
            //Recarrega os registros para mudar a situação do botão que indica livro online
            listarLivros(pagina, pessoa);
        },
        error: function (req, error) {
            alert(erro);
        }
    });
}
//function pesquisarTitulo(){
//    alert($("#pesquisar_titulo").val());
//}
//function quantidadeTitulos(){
//    var quantidade = $("#quantidade_titulos").val();
//    var titulo = $("#pesquisar_titulo").val();
//    $.ajax({
//        url: "../controles/livro.php",
//        type: 'POST',
//        dataType: 'text',
//        data: {qtdTitulos:quantidade},
//        success: function (data, textStatus, jqXHR) {
//            listarLivros(pagina,pessoa,titulo,quantidade);
//        },
//        error: function (jqXHR, textStatus, errorThrown) {
//            
//        }
//    });
//}
