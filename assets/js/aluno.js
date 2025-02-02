$(document).ready(function () {
    $(document).off("submit", "#formAluno");
    $(document).on("submit", "#formAluno", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controllers/aluno_controller.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#msgStatus").html("<span class='text-success'>Aluno cadastrado com sucesso!</span>");
                    $("#formAluno")[0].reset();

                    var modal = bootstrap.Modal.getInstance(document.getElementById('modalCadastroAluno'));
                    if (modal) {
                        modal.hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                    carregarAlunos();
                } else {
                    $("#msgStatus").html("<span class='text-danger'>Erro ao cadastrar aluno.</span>");
                    if (modal) {
                        modal.hide();
                    }
                    carregarAlunos();
                }
            },
            error: function (xhr, status, error) {
                console.log("Erro na requisição:", xhr.responseText);
            }
        });

    });

    function formatarTelefone(telefone) {
        return telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
    }

    function formatarData(data) {
        let partes = data.split("-");
        return partes.length === 3 ? `${partes[2]}/${partes[1]}/${partes[0]}` : data;
    }

    function carregarAlunos(filtro = "") {
        $.ajax({
            type: "GET",
            url: "../controllers/aluno_controller.php",
            data: { action: "list", search: filtro },
            dataType: "json",
            success: function (response) {
                let tabela = $("#tabelaAlunos tbody");
                tabela.empty();
                
                if (response.data && response.data.length === 0) {
                    tabela.append('<tr><td colspan="6" class="text-center text-muted">Ainda não há alunos cadastrados. Que tal começar agora?</td></tr>');
                } else {
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function (aluno) {
                            let telefoneFormatado = formatarTelefone(aluno.telefone);
                            let dataFormatada = formatarData(aluno.data_nascimento);
           
                            let linha = ` 
                                <tr class="text-center" id="linha-${aluno.id}">
                                    <td>${aluno.nome}</td>
                                    <td>${aluno.email}</td>
                                    <td>${telefoneFormatado}</td>
                                    <td>${dataFormatada}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btnEditar" data-id="${aluno.id}"><i class="fas fa-edit"></i> Editar</button>
                                        <button class="btn btn-danger btn-sm btnExcluir" data-id="${aluno.id}"><i class="fas fa-trash"></i> Excluir</button>
                                    </td>
                                </tr>`;
                            tabela.append(linha);
                        });
                    } else {
                        tabela.append('<tr><td colspan="6" class="text-center text-muted">Nenhum aluno encontrado.</td></tr>');
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log("Status da requisição:", status);

            }
        });
    }
    

    $("#searchInput").on("input", function () {
        let filtro = $(this).val(); 
        carregarAlunos(filtro); 
    });

    carregarAlunos();

    $(document).off("click", ".btnExcluir");
    $(document).on("click", ".btnExcluir", function () {
        let id = $(this).data("id");
        if (confirm("Tem certeza que deseja excluir este aluno?")) {
            $.ajax({
                type: "GET",
                url: "../controllers/aluno_controller.php",
                data: {
                    action: "delete",
                    id: id
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        $("#linha-" + id).fadeOut();
                        carregarAlunos();
                    } else {
                        carregarAlunos();
                        alert("Erro ao excluir aluno.");
                    }
                }
            });
        }
    });

    $(document).off("click", ".btnEditar");
    $(document).on("click", ".btnEditar", function () {
        let alunoId = $(this).data("id");
        if (alunoId) {
            $.ajax({
                type: "GET",
                url: "../controllers/editar_aluno_controller.php",
                data: { id: alunoId },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('#alunoId').val(response.id);
                        $('#nome').val(response.nome);
                        $('#email').val(response.email);
                        $('#telefone').val(response.telefone);
                        $('#data_nascimento').val(response.data_nascimento);
                        $('#ativo').val(response.ativo);
                        var modal = new bootstrap.Modal(document.getElementById('modalEditarAluno'));
                        modal.show();

                        carregarAlunos();
                    } else {
                        alert("Aluno não encontrado!");
                    }
                },
                error: function () {
                    alert("Erro ao buscar os dados do aluno.");
                }
            });
        } else {
            alert("Erro: ID do aluno não encontrado.");
        }
    });


    $("#formEditarAluno").off("submit");
    $("#formEditarAluno").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controllers/editar_aluno_controller.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    const modalElement = document.getElementById('modalEditarAluno');
                    if (!modalElement) {
                        console.error("Modal não encontrado!");
                        return;
                    }

                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (!modal) {
                        console.error("Instância do modal não encontrada!");
                        return;
                    }
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    modal.hide();
                    carregarAlunos();
                } else {
                    console.log("Erro na atualização:", response);
                }
            },
        });
    });

    function formatarTelefoneInput(input) {
        let telefone = input.value.replace(/\D/g, "");

        if (telefone.length > 10) {
            telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (telefone.length > 6) {
            telefone = telefone.replace(/^(\d{2})(\d{4})(\d+).*/, "($1) $2-$3");
        } else if (telefone.length > 2) {
            telefone = telefone.replace(/^(\d{2})(\d+).*/, "($1) $2");
        }

        input.value = telefone;
    }

    $(document).on("input", "input[name='telefone']", function () {
        formatarTelefoneInput(this);
    });

});

