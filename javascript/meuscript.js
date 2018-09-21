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
            //alert(erro);
        }
    });
}
function excluirPrateleira(id, pessoa) {
    var v = confirm("Excluir");
    if (!v) {
        return false;
    }
    //alert(id);
    $.ajax({
        url: "../controles/prateleira.php",
        dataType: 'text',
        type: 'POST',
        data: {id: id, pessoa:pessoa},
        success: function (dado) {
            console.log();
            if (dado != 0) {
                $("tr[data-cod=" + dado + "]").hide(3000);
                alert("Excluído com sucesso!");
            } else {
                alert("Este registro possui dependências e não pode ser excluído!");
            }
        },
        error: function (req, erro) {
            //alert(erro);
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
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            var estantes = $(dados).find("estantes").find("estante");
            var html = "";
            if (estantes.length > 0) {
                for (i = 0; i < estantes.length; i++) {
                    html += "<tr data-cod=" + $(estantes[i]).find('id').text() + ">";
                    html += "<td>" + $(estantes[i]).find("nome").text() + "</td>";
                    html += '<td style="text-align: center"><div class="btn-group">\n\
                                                    <a class="btn btn-primary" title="Editar" href="editarestante.php?id=' + $(estantes[i]).find("id").text() + '"><i class="icon_pencil"></i></a>\n\
                                                    <a class="btn btn-danger" title="Excluir" onclick="excluirEstante(' + $(estantes[i]).find("id").text() + ')" href="#"><i class="icon_close_alt2"></i></a>\n\
                                                    </div></td>';
                    html += "</tr>";
                }
                var paginas = "";
                //paginas += '<ul class="pagination ">\n\
                //<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
                var qtdPaginas = $(dados).find("estantes").find("qtdPaginas").text();
                for (i = 0; i < qtdPaginas; i++) {
                    if (i == pagina) {
                        paginas += '<li class="active active_pagina"><a onclick="listarEstantes(' + i + ',' + pessoa + ')" href="#">' + (i + 1) + ' </a></li>';
                    } else {
                        paginas += '<li class="active_pagina"><a onclick="listarEstantes(' + i + ',' + pessoa + ')" href="#">' + (i + 1) + ' </a></li>';
                    }
                }
                //paginas += ' <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li></ul>';
            } else {
                html += "<h3>Nenhum registro para mostrar!</h3>";
            }
            $(".paginacao_ajax").html(html);
            $(".rodape").css("display", "block");
            //$(".paginas").html(paginas);
            //console.log();
            //alert($(dados).find("estantes").find("qtdPaginas").text());
        },
        error: function (req, erro) {
           // alert(erro);
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
            } else {
                alert("Este registro possui dependências e não pode ser excluído!");
            }
        },
        error: function (req, erro) {
            //alert(erro);
        }
    });
}
function abrirModalLivro(id) {
    $("#myModalDetalhesLivro").modal();
    $.ajax({
        url: '../controles/livro.php',
        dataType: '',
        type: 'POST',
        data: {id_detalhe_livro: id},
        success: function (livro) {
            if ($(livro).find("imagem").text() != "") {
                imagem = $(livro).find("imagem").text();
            } else {
                imagem = "sem_imagem.jpg";
            }
            if ($(livro).find("descricao").text() != "") {
                descricao = $(livro).find("descricao").text();
            } else {
                descricao = "Descrição não cadastrada"
            }
            if ($(livro).find("editora").text() != "") {
                editora = $(livro).find("editora").text();
            } else {
                editora = "Editora não cadastrada"
            }
            if ($(livro).find("edicao").text() != 0) {
                edicao = $(livro).find("edicao").text() + "°";
            } else {
                edicao = "Edição não cadastrada"
            }
            if ($(livro).find("descricao").text() != "") {
                descricao = $(livro).find("descricao").text();
            } else {
                descricao = "Descrição não cadastrada"
            }
            if ($(livro).find("numero_paginas").text() != 0) {
                numero_paginas = $(livro).find("numero_paginas").text();
            } else {
                numero_paginas = "Número de páginas não cadastrado"
            }
            if ($(livro).find("isbn").text() != "") {
                isbn = $(livro).find("isbn").text();
            } else {
                isbn = "ISBN não cadastrado"
            }
            if ($(livro).find("lido").text() == 1) {
                lido = "Sim";
            } else {
                lido = "Não";
            }
            $("#detalhes_imagem").html("<img class='img-responsive img-rounded' style='max-height:400px'  src='../img/livros/" + imagem + "'/>");
            var html = "<h3  style='margin-top:0'>Editora</h3>\n\
            <div style='margin-bottom: 5px;'>" + editora + "</div>    \n\
            <h3><p>Edição</p></h3>\n\
            <div style='margin-bottom: 5px;'>" + edicao + "</div>    \n\
            <h3><p>Numero páginas</p></h3>\n\
            <div style='margin-bottom: 5px;'>" + numero_paginas + "</div>    \n\
            <h3><p>ISBN</p></h3>\n\
            <div style='margin-bottom: 5px;'>" + isbn + "</div>    \n\
            <h3><p>Lido</p></h3>\n\
            <div style='margin-bottom: 5px;'>" + lido + "</div> \n\
            <h3>Descrição</h3>\n\
            <div style='margin-bottom: 10px;'>" + descricao + "</div>";
            html += "";

            $("#detalhes_livro").html(html);
            console.log(dados);
        },
        error: function (req, erro) {
            //alert(erro);
        }
    });
}

function listarLivros(pagina, pessoa) {

    var quantidade = $("#quantidade_titulos").val();
    var titulo = $("#pesquisar_titulo_").val();

    //Deixa em destaque a página atual
    $(".active_pagina").click(function () {
        $(".active_pagina").removeClass("active");
        $(this).addClass("active");
    });
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {pagina: pagina, pessoa: pessoa, titulo: titulo, quantidade: quantidade},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            var livros = $(dados).find("livros").find("livro");
            var html = "";
            var online = false;
            if (livros.length > 0) {
                for (i = 0; i < livros.length; i++) {
                    html += "<tr  data-cod=" + $(livros[i]).find('id').text() + ">";
                    html += "<td style='cursor:pointer' onclick='abrirModalLivro(" + $(livros[i]).find('id').text() + ")'>" + $(livros[i]).find("titulo").text() + "</td>";
                    html += "<td style='cursor:pointer' onclick='abrirModalLivro(" + $(livros[i]).find('id').text() + ")'>" + $(livros[i]).find("autor").text() + "</td>";
                    html += "<td style='cursor:pointer' onclick='abrirModalLivro(" + $(livros[i]).find('id').text() + ")'>" + $(livros[i]).find("area_do_conhecimento").text() + "</td>";
                    html += "<td style='cursor:pointer' onclick='abrirModalLivro(" + $(livros[i]).find('id').text() + ")'>" + $(livros[i]).find("prateleira").text() + "</td>";
                    online = $(livros[i]).find("online").text();
                    html += '<td style="text-align: left"><div class="btn-group">\n\
                                                    <a class="btn btn-primary tooltips" title="Editar" data-placement="bottom" href="editarlivro.php?id=' + $(livros[i]).find("id").text() + '"><i class="icon_pencil"></i></a>\n\
                                                    <a class="btn btn-danger tooltips" title="Excluir" data-placement="bottom" onclick="excluirLivro(' + $(livros[i]).find("id").text() + ')" href="#"><i class="icon_close_alt2"></i></a>';

                    if (online == true) {
                        html += '<a class="tooltips btn btn-success" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() + ',' + pessoa + ',' + pagina + ')" href="#"><i class="icon_check_alt"></i></a>';
                    } else {
                        html += '<a class="tooltips btn btn-warning" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() + ',' + pessoa + ',' + pagina + ')" href="#"><i class="icon_error-circle"></i></a>';
                    }
                    html += "</div></td></tr>";
                }
                var paginas = "";
                paginas += '<ul class="pagination ">';
                var qtdPaginas = $(dados).find("livros").find("qtdPaginas").text();
                for (i = 0; i < qtdPaginas; i++) {
                    if (i == pagina) {
                        paginas += '<li class="active active_pagina"><a onclick="listarLivros(' + i + ',' + pessoa + ')" href="#">' + (i + 1) + ' </a></li>';
                    } else {
                        paginas += '<li class="active_pagina"><a onclick="listarLivros(' + i + ',' + pessoa + ')" href="#">' + (i + 1) + ' </a></li>';
                    }
                }
                paginas += '</ul>';
            } else {
                html = "<tr><td colspan='5'><h3>Nenhum registro para mostrar!</h3></td></tr>";
                paginas = "";
            }
            $(".paginacao_ajax").html(html);
            $(".paginas").html(paginas);
            $(".rodape").css("display", "block");
            //console.log();
        },
        error: function (req, erro) {
            //alert("Erro: " + erro);
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
            //console.log(dado);
            if (dado != 0) {
                $("tr[data-cod=" + dado + "]").hide(3000);
                alert("Excluído com sucesso!");
            }else{
                alert("Este registro possui dependências e não pode ser excluído!");
            }
        },
        error: function (req, erro) {
            //alert(erro);
        }
    });
}
function onlineLivro(id, pessoa, pagina) {
    $.ajax({
        url: "../controles/livro.php",
        type: 'POST',
        dataType: 'text',
        data: {id_online: id, pessoa: pessoa},
        success: function (dado) {
            //Recarrega os registros para mudar a situação do botão que indica livro online
            listarLivros(pagina, pessoa);
        },
        error: function (req, error) {
            //alert(erro);
        }
    });
}
//function buscarLivro(pagina) {
//    var quantidade = $("#quantidade_titulos").val();
//    var string = $("#pesquisar_titulo").val();
//
//    //Deixa em destaque a página atual
//    $(".active_pagina").click(function () {
//        $(".active_pagina").removeClass("active");
//        $(this).addClass("active");
//    });
//    $.ajax({
//        url: '../controles/livro.php',
//        dataType: 'xml',
//        type: 'POST',
//        data: {pagina: pagina, string: string, quantidade: quantidade},
//        success: function (dados) {
//            console.log(dados);
//            var livros = $(dados).find("livros").find("livro");
//            var html = "";
//            var online = false;
//            if (livros.length > 0) {
//                for (i = 0; i < livros.length; i++) {
//                    html += "<tr data-cod=" + $(livros[i]).find('id').text() + ">";
//                    html += "<td>" + $(livros[i]).find("titulo").text() + "</td>";
//                    html += "<td>" + $(livros[i]).find("autor").text() + "</td>";
//                    html += "<td>" + $(livros[i]).find("area_do_conhecimento").text() + "</td>";
//
//                    html += '<td style="text-align: left"><div class="btn-group">\n\
//                                                    <a class="btn btn-primary tooltips" title="Detalhes" data-placement="bottom" href="detalheslivro.php?id=' + $(livros[i]).find("id").text() + '"><i class="icon_plus"></i></a>\n\
//                                                    <a class="btn btn-success tooltips" title="Contatar dono" data-placement="bottom" href="mensagem.php?id_1=' + $(livros[i]).find("dono").text() + '&id_2=' + $(livros[i]).find("id").text() + '"><i class="icon_mail_alt"></i></a>';
//
////                if(online==true){
////                 html += '<a class="tooltips btn btn-success" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() +',' + pessoa +',' + pagina + ')" href="#"><i class="icon_check_alt"></i></a>';   
////                }else{
////                   html += '<a class="tooltips btn btn-warning" title="Online" data-placement="bottom" onclick="onlineLivro(' + $(livros[i]).find("id").text() +',' + pessoa +',' + pagina + ')" href="#"><i class="icon_error-circle"></i></a>'; 
////                }                                                                    
//                    html += "</div></td></tr>";
//                }
//                var paginas = "";
//                paginas += '<ul class="pagination ">\n\
//            <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
//                var qtdPaginas = $(dados).find("livros").find("qtdPaginas").text();
//                for (i = 0; i < qtdPaginas; i++) {
//                    if (i == pagina) {
//                        paginas += '<li class="active active_pagina"><a onclick="buscarLivro(' + i + ')" href="#">' + (i + 1) + ' </a></li>';
//                    } else {
//                        paginas += '<li class="active_pagina"><a onclick="buscarLivro(' + i + ')" href="#">' + (i + 1) + ' </a></li>';
//                    }
//                }
//                paginas += ' <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li></ul>';
//            } else {
//                html = "<tr><td colspan='4'><h3>Nenhum registro para mostrar!</h3></td></tr>";
//                paginas = "";
//            }
//            $(".paginacao_ajax").html(html);
//            $(".paginas").html(paginas);
//            //console.log();
//
//        },
//        error: function (req, erro) {
//            alert("Erro: " + erro);
//        }
//    });
//}

//Lista os dados do livro que foi clicado no autocompletar da barra de pesquisa BUSCA ONLINE
function buscarLivro(id, pessoa) {
    $.ajax({
        url: '../controles/livro.php',
        type: 'POST',
        dataType: 'xml',
        data: {idBuscarLivro: id, pessoa: pessoa},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dado) {
            $("#mosaico").hide();//Esconde a div do mosaico em login.php
            $("#um_livro").css("display", "block");
            var livro = $(dado).find("livro");
            if (livro.find("imagem").text() != "") {
                imagem = livro.find("imagem").text();
            } else {
                imagem = "sem_imagem.jpg";
            }
            $("#tabelaInfLivro").css("display", "block");
            $("#livro_imagem").html("<img style='max-height: 400px;' class='img-responsive img-rounded info-livro' src='../img/livros/" + imagem + "'>");
            $("#l_titulo").html(livro.find('titulo').text());
            $("#l_autor").html(livro.find('autor').text());
            $("#l_distancia").html(livro.find('distancia').text() + " Km");
            $("#l_descricao").html(livro.find('descricao').text());
            $("#l_pessoa").html("<a>" + livro.find("pessoa").text() + "</a>");
            $("#div_form_to_perfilpessoa").html("<form id='form_to_perfilpessoa' method='post' action='perfilpessoa.php'> <input type='hidden' value='" + livro.find('idpessoa').text() + "' name='id_pessoa'></form>");
            if ($(livro).find("idpessoa").text() != pessoa) {
                $("#l_mensagem").html('<div class="btn-group" onclick="abrirModalMsg(' + livro.find('idpessoa').text() + ')"><a class="btn btn-success" title="Contatar dono" data-placement="bottom" ><i class="icon_mail_alt"></i></a></div>');
            } else {
                //$("#dono").css("display", "none");
                $("#msg").css("display", "none");
            }
            $("#varios_livros").hide();//Esconde a div que traz escrito "Resultado para ..."
            $(".rodape").css("display", "block");
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

//function finalizaSetInterval(intervalo){
//    clearInterval(intervalo);
//    alert("Finalizou intervalo");
//}


$(document).ready(function () {
    //Para o envio do id da pessoa à perfilpessoa.php
    $("#l_pessoa").click(function () {
        $("#form_to_perfilpessoa").trigger("submit");
    });
    //Desabilita o envio do campo Busca Online para click Enter
    $('#pesquisar_titulo').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);
        return (code == 13) ? false : true;
    });

});
function carregarLivrosOnline(pagina, pessoa, string) {
    //var qtd_por_pagina = $("#quantidade_titulos").val(); 
    var qtd_por_pagina = 10;
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {string_titulo: string, pessoa: pessoa, qtdRegistros: qtd_por_pagina},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            $("#um_livro").hide();
            var html = "";
            var livros = $(dados).find("livros").find("livro");
            $(livros).each(function () {
                html += "<tr>";
                html += "<td><img class='img-responsive' width='40px' src='../img/livros/" + $(this).find("imagem").text() + "'</td>";
                html += "<td>" + $(this).find("titulo").text() + "</td>";
                html += "<td>" + $(this).find("autor").text() + "</td>";
                html += "<td>" + $(this).find("pessoa").text() + "</td>";
                html += "<td>" + $(this).find("distancia").text() + " Km</td>";
                html += '<td><div class="btn-group">\n\
                                                    <a class="btn btn-primary" onclick="funcao(' + $(this).find("idpessoa").text() + ')" href="#"><i class="icon_mail_alt"></i></a>\n\
                                                    </div></td>';
                qtdPaginas = $(this).find("numpaginas").text();
            });
            var paginas = "";
            paginas += '<ul class="pagination ">\n\
            <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
            for (i = 0; i < qtdPaginas; i++) {
                if (i == pagina) {
                    paginas += '<li class="active active_pagina"><a onclick="carregarLivrosOnline(' + i + ',' + pessoa + ',' + string + ')" href="#">' + (i + 1) + ' </a></li>';
                } else {
                    paginas += '<li class="active_pagina"><a onclick="carregarLivrosOnline(' + i + ',' + pessoa + ',' + string + ')" href="#">' + (i + 1) + ' </a></li>';
                }
            }
            paginas += ' <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li></ul>';
            //alert(paginas);
            $(".paginacao_ajax").html(html);
            $(".paginas").html(paginas);
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

pagi = 1;//A primeira página já carrega na entrada da página index.php
function maisLivrosIndex() {
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {pagi: pagi},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            var livros = $(dados).find("livros").find("livro");
            var html = "";
            var i = 0;
            //var vetor = [120, 130, 120, 130, 120, 130, 120, 110, 130, 120, 120, 110, 120, 110, 130, 120, 110, 130];
            $(livros).each(function () {
                html += '<li class="appendLivros"><a onclick="maisDetalhesLivro(' + $(this).find("id").text() + ', 0)"><img src="../img/livros/' + $(this).find("imagem").text() + '" width="177" height="177"></a><p></p></li>';
                i++;
            });
            //alert(html);
            $(html).appendTo("#wookmark1");
            imagens();//Chama função que faz o plugin Wookmark reorganizar as imagens
            $(".rodape").css("display", "block");
            //$(".appendLivros:last").append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
    pagi++;//A cada chamada da função, acrescenta uma página
}

function buscarLivroOnline(pessoa) {
    var entrada = $("#pesquisar_titulo").val();
    var pessoa = pessoa;
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {string: entrada, pessoa: pessoa},
        beforeSend: function (xhr) {
            $("#pesquisar_titulo").addClass("ui-autocomplete-loading");
        },
        complete: function (jqXHR, textStatus) {
            $("#pesquisar_titulo").removeClass("ui-autocomplete-loading");
        },
        success: function (dados) {
            //Pega todos os registros e mapeia o nome e o id
            var data = $("livro", dados).map(function () {
                return {
                    value: $("titulo", this).text() + " | Distância " + $("distancia", this).text() + "Km",
                    id: $("id", this).text()
                };
            }).get();
            $("#pesquisar_titulo").autocomplete({
                source: function (req, response) {
                    var livros = $.ui.autocomplete.filter(data, req.term);
                    response(livros.slice(0, 10)); //Apresenta no máximo 10 registros
                    response($.grep(livros, function (item) {
                        return matcher.test(item.value);
                    }));
                },
                minLength: 3,
                select: function (event, ui) {
                    $("#hidden_buscar").val(ui.item.id);
                    $("#form_pesquisa").trigger("submit");
                }
            });
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

function buscarLivroOnlineMobile(pessoa) {
    var entrada = $("#pesquisar_titulo_mobile").val();
    var pessoa = pessoa;
    $.ajax({
        url: '../controles/livro.php',
        dataType: 'xml',
        type: 'POST',
        data: {string: entrada, pessoa: pessoa},
        beforeSend: function (xhr) {
            $("#pesquisar_titulo_mobile").addClass("ui-autocomplete-loading");
        },
        complete: function (jqXHR, textStatus) {
            $("#pesquisar_titulo_mobile").removeClass("ui-autocomplete-loading");
        },
        success: function (dados) {
            //Pega todos os registros e mapeia o nome e o id
            var data = $("livro", dados).map(function () {
                return {
                    value: $("titulo", this).text() + " | Distância " + $("distancia", this).text() + "Km",
                    id: $("id", this).text()
                };
            }).get();
            $("#pesquisar_titulo_mobile").autocomplete({
                source: function (req, response) {
                    var livros = $.ui.autocomplete.filter(data, req.term);
                    response(livros.slice(0, 10)); //Apresenta no máximo 10 registros
                    response($.grep(livros, function (item) {
                        return matcher.test(item.value);
                    }));
                },
                minLength: 3,
                select: function (event, ui) {
                    $("#hidden_buscar").val(ui.item.id);
                    $("#form_pesquisa").trigger("submit");
                }
            });
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

function maisDetalhesLivro(idLivro, idPessoa) {
    $("#hidden_buscar").val(idLivro);
    $("#form_pesquisa").trigger("submit");
}

function redirecionar(end) {
    window.location.href = end;
}

//Envio de mensagem com ajax
function enviarMensagem(msg, remetente, destinatario, redireciona) {
    $("#conteudoMsg").val("");
    if (msg != "") {
        $.ajax({
            url: "../controles/mensagem.php",
            type: 'POST',
            dataType: 'text',
            data: {msg: msg, remetente: remetente, destinatario: destinatario},
            success: function (dado) {
                //alert(dado);
                if (redireciona)
                    redirecionar("mensagem.php");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //alert(errorThrown);
            }
        });
    }
}
//Função chamada ao clic na div da conversa
function lerMensagem(remetente, destinatario) {
    $.ajax({
        url: "../controles/mensagem.php",
        type: 'POST',
        dataType: 'text',
        data: {remetente: remetente, destinatario: destinatario},
        success: function (dado) {
            //alert(dado);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert(errorThrown);
        }
    });
}

function atualizarMensagens(remetente, destinatario) {
    //alert(ultimoId);
    $.ajax({
        url: "../controles/mensagem.php",
        type: 'POST',
        dataType: 'xml',
        data: {rem: remetente, dest: destinatario},
        success: function (dados) {
            console.log(dados);
            mensagens = $(dados).find("mensagens").find("mensagem");
            var existe = false;
            var html = "";
            //alert($(".msg:last").attr("data-cod"));
            $(mensagens).each(function () {
                existe = false;
                if ($(this).find("id").text() > $(".msg:last").attr("data-cod")) {
                    existe = true;
                }
                if (existe) {
                    if ($(this).find("idRemetente").text() != remetente) {
                        if ($(this).find("imagemRemetente").text() != '')
                            imagem = $(this).find("imagemRemetente").text();
                        else
                            imagem = "sem_imagem.jpg";
                        html += '<li class="by-me msg" data-cod=' + $(this).find("id").text() + '><div class="avatar pull-left">\n\
                        <img width="50px" height="50px" src="../img/pessoas/' + imagem + '" alt=""/></div>\n\
                         <div class="chat-content">  <div class="chat-meta">' + $(this).find("nomeRemetente").text() + ' <span class="pull-right">' + $(this).find("dataHora").text() + '</span></div>\n\
                         ' + $(this).find("conteudo").text() +
                                ' <div class="clearfix"></div></div></li>';
                        //ultimoId = $(this).find("id").text();                        
                    } else {
                        if ($(this).find("imagemRemetente").text() != '')
                            imagem = $(this).find("imagemRemetente").text();
                        else
                            imagem = "sem_imagem.jpg";
                        html += '<li class="by-other msg" data-cod=' + $(this).find("id").text() + '><div class="avatar pull-right">\n\
                        <img width="50px" height="50px" src="../img/pessoas/' + imagem + '" alt=""/></div>\n\
                         <div class="chat-content">  <div class="chat-meta">' + $(this).find("dataHora").text() + '<span class="pull-right">' + $(this).find("nomeRemetente").text() + '</span></div>\n\
                         ' + $(this).find("conteudo").text() +
                                ' <div class="clearfix"></div></div></li>';
                        //ultimoId = $(this).find("id").text();
                    }
                    //var element = $("#conteudoMsg");
                    //element.scrollTop = element.scrollHeight;
                    //$("#conteudoMsg").scroll();//Atualiza o scrool após receber msg
                }
            });
            //alert(html);
            if (existe) {
                $(html).appendTo("#mensagens");
                $("#teste").scrollTop($("#teste").scrollTop() + $("#teste").outerHeight());
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //alert(errorThrown);
        }
    });
}
//Traz todos usuarios que se comunicaram com o usuario logado
function carregaUsuariosMensagens(usuarioLogado) {
    $.ajax({
        url: "../controles/mensagem.php",
        type: 'POST',
        dataType: 'xml',
        data: {usuarioLogado: usuarioLogado},
        success: function (dados) {
            idUsu1 = usuarioLogado;
            var html = "";
            var usuarios = $(dados).find("usuarios").find("usuario");
            if (usuarios.length > 0) {
                $(usuarios).each(function () {
                    if ($(this).find("imagem").text() != "") {
                        imagem = $(this).find("imagem").text();
                    } else {
                        imagem = "sem_imagem.jpg";
                    }
                    if ($(this).find("lida").text() == 1) {
                        html += '<tr><td style="cursor:pointer" onclick="conversa(idUsu1,' + $(this).find("id").text() + ')"><img width="50px" height="50px" alt="" class="simple"\n\
                         src="../img/pessoas/' + imagem + '">\n\
                        ' + $(this).find("nome").text() + '</td><td></tr>';
                    } else {
                        html += '<tr><td style="cursor:pointer" onclick="conversa(idUsu1,' + $(this).find("id").text() + ')"><img width="50px" height="50px" alt="" class="simple"\n\
                         src="../img/pessoas/' + imagem + '">\n\
                        ' + $(this).find("nome").text() + '</td><td></tr>';
                    }

                });
            } else {
                html = "<h3>Você ainda não possui mensagens</h3>";
            }
            $("#usuariosMensagens").html(html);
            //Ao clique na conversa deixa com a classe active
            $('#usuariosMensagens tr').on('click', function () {
                if ($(document).outerWidth() < 1200) {
                    //Desce a página para mostrar a conversa aberta
                    $(window).scrollTop($(document).outerHeight() - 500);
                }
                //Remove active se existente e adiciona à tr clicada
                $("#usuariosMensagens tr").removeClass("active");
                $(this).addClass("active");
            });
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

function totalMensagensNaoLidas(usuario) {
    $.ajax({
        url: "../controles/mensagem.php",
        type: 'POST',
        dataType: 'text',
        data: {destinatarioTotalMsg: usuario},
        success: function (dado) {
            array = dado.split(",");
            msg = array[0];
            ntf = array[1];
            if (msg > 0) {
                $("#totalMsg").html(msg);
                $("#irMsg").css("display", "block");
                $("#totalMsgMobile").html(msg);
                $("#irMsgMobile").css("display", "block");
            } else {
                $("#totalMsg").html("");
                $("#irMsg").css("display", "none");
                $("#totalMsgMobile").html("");
                $("#irMsgMobile").css("display", "none");
            }
            if (ntf > 0) {
                $("#totalNtf").html(ntf);
                $("#irEmpr").css("display", "block");
                $("#totalNtfMobile").html(ntf);
                $("#irEmprMobile").css("display", "block");
            } else {
                $("#totalNtf").html("");
                $("#irEmpr").css("display", "none");
                $("#totalNtfMobile").html("");
                $("#irEmprMobile").css("display", "none");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

//Ao clicar em uma amostra de conversa, abre a conversa em questão
function conversa(usuLogado, usu2) {
    //Seta usu2 no input hidden para ter o destinatario e usá-lo no envio da msg
    $("#destinatario").val(usu2);
    $.ajax({
        url: "../controles/mensagem.php",
        type: 'POST',
        dataType: 'xml',
        data: {usuLogado: usuLogado, usu2: usu2},
        success: function (dados) {
            //console.log(dados);
            $("#conversa").css("display", "block");
            var html = "";
            var nome = "";
            mensagens = $(dados).find("mensagens").find("mensagem");
            $(mensagens).each(function () {
                if ($(this).find("idRemetente").text() != usuLogado) {
                    if ($(this).find("imagemRemetente").text() != '')
                        imagem = $(this).find("imagemRemetente").text();
                    else
                        imagem = "sem_imagem.jpg";
                    html += '<li class="by-me msg" data-cod=' + $(this).find("id").text() + '><div class="avatar pull-left">\n\
                        <img width="50px" height="50px" src="../img/pessoas/' + imagem + '" alt=""/></div>\n\
                         <div class="chat-content">  <div class="chat-meta">' + $(this).find("nomeRemetente").text() + ' <span class="pull-right">' + $(this).find("dataHora").text() + '</span></div>\n\
                         ' + $(this).find("conteudo").text() +
                            ' <div class="clearfix"></div></div></li>';
                    nome = $(this).find("nomeRemetente").text();
                } else {
                    if ($(this).find("imagemRemetente").text() != '')
                        imagem = $(this).find("imagemRemetente").text();
                    else
                        imagem = "sem_imagem.jpg";
                    html += '<li class="by-other msg" data-cod=' + $(this).find("id").text() + '><div class="avatar pull-right">\n\
                        <img width="50px" height="50px" src="../img/pessoas/' + imagem + '" alt=""/></div>\n\
                         <div class="chat-content">  <div class="chat-meta">' + $(this).find("dataHora").text() + '<span class="pull-right">' + $(this).find("nomeRemetente").text() + '</span></div>\n\
                         ' + $(this).find("conteudo").text() +
                            ' <div class="clearfix"></div></div></li>';
                    nome = $(this).find("nomeDestinatario").text();
                }
            });
            $("#nomeMensagem").html(nome);
            //alert(html);
            $("#mensagens").html(html);
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });

}

//Recebimento de mensagem com ajax
//function recebeMensagem(usuario) {
////alert(usuario);
//    $.ajax({
//        url: "../controles/mensagem.php",
//        type: 'POST',
//        dataType: 'xml',
//        data: {usuario: usuario},
//        success: function (dados) {
//            console.log(dados);
//            //alert($(dados).find("mensagens").find("mensagem").find("conteudo").text());
//            var mensagens = $(dados).find("mensagens").find("mensagem");
//            var html = "";
//            for (i = 0; i < mensagens.length; i++) {
//                alert($(mensagens[i]).find("conteudo").text());
//            }
//            //$("#recebeMensagem").html(html);
//            //document.getElementById("recebeMensagem").innerHTML = html;
//        },
//        error: function (jqXHR, textStatus, errorThrown) {
//            alert(errorThrown);
//        }
//    });
//}

function autoCompletarPessoa() {
    var busca = $("#pessoa").val();
    if (busca.length >= 2) {
        $.ajax({
            url: '../controles/emprestimo.php',
            type: 'POST',
            dataType: 'xml',
            data: {buscarPessoa: busca},
            beforeSend: function (xhr) {
                $("#pessoa").addClass("ui-autocomplete-loading");
            },
            complete: function (jqXHR, textStatus) {
                $("#pessoa").removeClass("ui-autocomplete-loading");
            },
            success: function (dados) {
                //Pega todos os registros e mapeia o nome e o id
                var data = $("pessoa", dados).map(function () {
                    return {
                        value: $("nome", this).text(),
                        id: $("id", this).text()
                    };
                }).get();
                $("#pessoa").autocomplete({
                    source: function (req, response) {
                        var pessoas = $.ui.autocomplete.filter(data, req.term);
                        response(pessoas.slice(0, 10)); //Apresenta no máximo 10 registros
                        response($.grep(pessoas, function (item) {
                            //Caso o usuário digite um nome já existente e não clique no select este if seta o id no campo hidden
                            if (item.value.toUpperCase() === busca.toUpperCase()) {
                                $("#idpessoa").val(item.id);
                            }
                            return matcher.test(item.value);
                        }));
                    },
                    minLength: 3,
                    select: function (event, ui) {
                        $("#idpessoa").val(ui.item.id);
                    }
                });
            },
            error: function (requisicao, erro) {
                //alert(erro);
            }
        });
    }
}
function autoCompletarEditora() {
    var busca = $("#editora").val();
    if (busca.length >= 2) {//Faz requisição somente se string >= 2
        $.ajax({
            url: '../controles/livro.php',
            type: 'POST',
            dataType: 'xml',
            data: {buscarEditora: busca},
            beforeSend: function (xhr) {
                $("#editora").addClass("ui-autocomplete-loading");
            },
            complete: function (jqXHR, textStatus) {
                $("#editora").removeClass("ui-autocomplete-loading");
            },
            success: function (dados) {
                //Pega todos os registros e mapeia o nome e o id
                var data = $("editora", dados).map(function () {
                    return {
                        value: $("nome", this).text(),
                        id: $("id", this).text()
                    };
                }).get();
                //Se não foram encontrados registros correspondentes abre popup de cadastro
                if (data.length == 0) {
                    $("#nomeEditora").val($("#editora").val());
                    //Abre modal de cadastro de Editora em cadastrarlivro.php
                    $('#modalEditora').modal('show');
                }
                $("#editora").autocomplete({
                    source: function (req, response) {
                        var editoras = $.ui.autocomplete.filter(data, req.term);
                        response(editoras.slice(0, 10)); //Apresenta no máximo 10 registros
                        response($.grep(editoras, function (item) {
                            //Caso o usuário digite um nome já existente e não clique no select este if seta o id no campo hidden
                            if (item.value.toUpperCase() === busca.toUpperCase()) {
                                $("#ideditora").val(item.id);
                            }
                            return matcher.test(item.value);
                        }));
                    },
                    minLength: 3,
                    select: function (event, ui) {
                        $("#ideditora").val(ui.item.id);
                    }
                });
            },
            error: function (requisicao, erro) {
                //alert(erro);
            }
        });
    }
}
//Ajax para cadastro de Editora
function cadastrarEditora() {
    var editora = $("#nomeEditora").val();
    $.ajax({
        url: '../controles/editora.php',
        dataType: 'text',
        type: 'POST',
        data: {editora: editora},
        success: function (dados) {
            if (dados != 0) {
                $("#ideditora").val(dados);
                $("#editora").val(editora);
                $('#modalEditora').modal('hide');
            }
            //alert(dados);
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

function autoCompletarAutor() {
    var busca = $("#autor").val();
    if (busca.length >= 2) {
        $.ajax({
            url: '../controles/livro.php',
            type: 'POST',
            dataType: 'xml',
            data: {buscarAutor: busca},
            beforeSend: function (xhr) {
                $("#autor").addClass("ui-autocomplete-loading");
            },
            complete: function (jqXHR, textStatus) {
                $("#autor").removeClass("ui-autocomplete-loading");
            },
            success: function (dados) {
                //Pega todos os registros e mapeia o nome e o id
                var data = $("autor", dados).map(function () {
                    return {
                        value: $("nome", this).text(),
                        id: $("id", this).text()
                    };
                }).get();
                //Se não foram encontrados registros correspondentes abre popup de cadastro
                if (data.length == 0) {
                    $("#nomeAutor").val($("#autor").val());
                    //Abre modal de cadastro de Editora em cadastrarlivro.php
                    $('#modalAutor').modal('show');
                }
                $("#autor").autocomplete({
                    source: function (req, response) {
                        var autores = $.ui.autocomplete.filter(data, req.term);
                        response(autores.slice(0, 10)); //Apresenta no máximo 10 registros
                        response($.grep(autores, function (item) {
                            //Caso o usuário digite um nome já existente e não clique no select este if seta o id no campo hidden
                            if (item.value.toUpperCase() === busca.toUpperCase()) {
                                $("#idautor").val(item.id);
                            }
                            return matcher.test(item.value);
                        }));
                    },
                    minLength: 3,
                    select: function (event, ui) {
                        $("#idautor").val(ui.item.id);
                    }
                });
            },
            error: function (requisicao, erro) {
                //alert(erro);
            }
        });
    }
}

//Ajax para cadastro de Editora
function cadastrarAutor() {
    var autor = $("#nomeAutor").val();
    $.ajax({
        url: '../controles/autor.php',
        dataType: 'text',
        type: 'POST',
        data: {autor: autor},
        success: function (dados) {
            if (dados != 0) {
                $("#idautor").val(dados);
                $("#autor").val(autor);
                $('#modalAutor').modal('hide');
            }
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}
function listarEmprestimos(opcao, pessoa) {
    $.ajax({
        url: "../controles/emprestimo.php",
        dataType: 'xml',
        type: 'POST',
        data: {pessoa: pessoa, opcao: opcao},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {

            var html = "";
            var emprestimos = $(dados).find("emprestimos").find("emprestimo");
            if (emprestimos.length > 0) {
                $(emprestimos).each(function () {
                    html += "<tr>";
                    html += "<td>" + $(this).find("livro").text() + "</td>";
                    html += "<td>" + $(this).find("pessoa_emprestou").text() + "</td>";
                    html += "<td>" + $(this).find("data").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("data_prevista").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("data_devolucao").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("observacao").text() + "</td>";
                    if ($(this).find("data_devolucao").text() == "" || $(this).find("data_devolucao").text() == "0000-00-00") {
                        html += '<td><div class="btn-group devolver" title="Editar devolução">\n\
                                                    <a class="btn btn-warning" data-placement="bottom" onclick="abrirModalDevolver(' + $(this).find("id").text() + ',' + $(this).find("id_pessoa_emprestou").text() + ')" href="#"><i class="fa fa-thumbs-down"></i></a>\n\
                                                    </div>';
                    } else {
                        html += '<td><div class="btn-group">\n\
                                                   <button class="btn btn-success bt-success-inativo" title="Devolvido"><i class="fa fa-thumbs-up"></i></button></div>';
                    }
                    html += '<div class="btn-group" title="Mensagem ao dono">\n\
                            <a class="btn btn-primary" onclick="abrirModalMsg(' + $(this).find("id_pessoa_emprestou").text() + ')"><i class="icon_mail_alt"></i></a>\n\
                            </div></td>';
                    html += "</tr>";
                });
            } else {
                html += "<p>Nenhum registro encontrado!</p>";
            }
            if (opcao == 0) {
                $(".pendentes").html(html);
            } else {
                $(".finalizados").html(html);
            }
            $(".rodape").css("display", "block");
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

function abrirModalMsg(destinatario) {
    $("#destinatario").val(destinatario);
    $("#nome").html("Sua mensagem");
    $('#myModal').modal('show');
}

function abrirModalDevolver(id, pessoa_emprestou) {
    $('#modalDevolver').modal('show');
    $('#id_').val(id); //Seta o id do emprestimo no hidden do modal para ser utilizado pela function devolver    
    $('#pessoa_emprestou').val(pessoa_emprestou);
    //Ajax que traz do banco de dados a descrição do empréstimo e seta no modal devolver
    $.ajax({
        url: '../controles/emprestimo.php',
        type: 'POST',
        dataType: 'text',
        data: {id_emprestimo_descricao: id},
        success: function (dado) {
            $("#descricao").val(dado);
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }

    });
}

//Função chamada no clique do botão salvar, presente no modalDevolver
function devolver() {
    var data = $("#data").val();
    var nota = $("#nota").val();
    var descricao = $("#descricao").val();
    var devolvido = $('input:radio[name=devolvido]:checked').val();
    var livro = $('#id_').val();
    var pessoa = $('#pessoa_id').val();
    var pessoa_emprestou = $('#pessoa_emprestou').val();
    $('#modalDevolver').modal('hide');
    $.ajax({
        url: '../controles/emprestimo.php',
        dataType: 'text',
        type: 'POST',
        data: {livro: livro, data: data, nota: nota, pessoa_emprestou: pessoa_emprestou, descricao: descricao, devolvido: devolvido},
        success: function (dado) {
            if (dado == 1) {//dados foram gravados
                listarEmprestimos(0, pessoa);
            }
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}
function listarEmprestimosObtidos(opcao, pessoa) {
    $.ajax({
        url: "../controles/emprestimo.php",
        dataType: 'xml',
        type: 'POST',
        data: {pessoa2: pessoa, opcao: opcao},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            var html = "";
            var emprestimos = $(dados).find("emprestimos").find("emprestimo");
            if (emprestimos.length > 0) {
                $(emprestimos).each(function () {
                    html += "<tr>";
                    html += "<td>" + $(this).find("livro").text() + "</td>";
                    html += "<td>" + $(this).find("pessoa_emprestou").text() + "</td>";
                    html += "<td>" + $(this).find("data").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("data_prevista").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("data_devolucao").text().split('-').reverse().join('/') + "</td>";
                    html += "<td>" + $(this).find("observacao").text() + "</td>";
                    if ($(this).find("data_devolucao").text() == "") {
                        html += '<td><div class="btn-group devolver" title="Editar devolução">\n\
                                                    <a class="btn btn-warning" onclick="abrirModalDevolver(' + $(this).find("id").text() + ')" href="#"><i class="fa fa-thumbs-down"></i></a>\n\
                                                    </div>';
                    } else {
                        html += '<td><div class="btn-group">\n\
                                                   <button class="btn btn-success bt-success-inativo" title="Devolvido"><i class="fa fa-thumbs-up"></i></button></div>';
                    }
                    html += '<div class="btn-group">\n\
                            <a class="btn btn-primary" title="Mensagem ao dono" onclick="abrirModalMsg(' + $(this).find("id_pessoa_emprestou").text() + ')"><i class="icon_mail_alt"></i></a>\n\
                            </div></td>';
                    html += "</tr>";
                });
            } else {
                html += "<p>Nenhum registro encontrado!</p>";
            }
            if (opcao == 0) {
                $(".pendentes").html(html);
            } else {
                $(".finalizados").html(html);
            }
            $(".rodape").css("display", "block");
        },
        error: function (req, erro) {
            //alert("Erro " + erro);
        }
    });
}

var pagina_comentarios = 0;//Armazena registro atual dos comentários
function listarComentariosPerfilPessoa(pessoa) {
    $.ajax({
        url: '../controles/pessoa.php',
        dataType: 'xml',
        type: 'POST',
        data: {id_pessoa_ajax: pessoa, pagina: pagina_comentarios},
        beforeSend: function (xhr) {
            $("#carregando_ajax").html("<img src='../img/ajax.gif'/>");
        },
        complete: function (jqXHR, textStatus) {
            $("#carregando_ajax").hide();
        },
        success: function (dados) {
            var html = "";
            var container = $(dados).find("comentarios").find("comentario");
            existe_comentario = false;
            if (container.length > 0) {
                existe_comentario = true;
            }
            if (existe_comentario) {
                $(container).each(function () {
                    if ($(this).find("imagem").text() == '') {
                        imagem = 'sem_imagem.jpg';
                    } else {
                        imagem = $(this).find('imagem').text();
                    }
                    if ($(this).find("descricao").text() == '') {
                        descricao = "Usuário não avaliou este empréstimo!";
                    } else {
                        descricao = $(this).find("descricao").text();
                    }
                    html += '<div class="act-time"><div class="activity-body act-in"><span class="arrow"></span><div class="text">';
                    html += ' <a href="#" class="activity-img"><img class="avatar" src="../img/pessoas/' + imagem + '"></a>';
                    html += '<p class="attribution"><a href="#">' + $(this).find("nome").text() + '</a> ' + $(this).find("data").text() + '</p>';
                    html += ' <p>' + descricao + '</p>';
                    html += "</div></div></div>";
                });
            } else {
                html += "<p>Não há comentários para serem mostrados!</p>";
            }

            if (existe_comentario) {
                html += '<a style="cursor:pointer; color:#00A0DF" class="mais" onclick="listarComentariosPerfilPessoa(' + pessoa + ',' + pagina_comentarios + ')" ><p>Mais comentários</p></a>';
            }
            $("#comentarios .mais").hide();
            $("#comentarios").append(html);
            pagina_comentarios++;
        },
        error: function (req, erro) {
           // alert("Erro: " + erro);
        }
    });
}
function recuperaSenha(email){
    $.ajax({
        url: '../controles/pessoa.php',
        dataType: 'text',
        type: 'POST',
        data: {email_recuperar_senha:email},
        success: function (dado) {
            //alert(dado);
            if(dado==1)
                alert("Um link foi enviado para seu email. Entre em seu email e redefina sua senha!");
            else if(dado==2)
                alert("Email informado inexistente no sistema!");
            else    
                alert("Problemas ao enviar. Tente novamente");
        },
        error: function (req, erro) {
            alert("Erro");
        }
        
    });
}

