$(document).ready(function () {
    $("#formAluno").submit(function (e) {
        e.preventDefault();
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
                    console.log(modal);
                    modal.hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    carregarAlunos();
                } else {
                    $("#msgStatus").html("<span class='text-danger'>Erro ao cadastrar aluno.</span>");
                    modal.hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    carregarAlunos();
                }
            }
        });
    });

    function carregarAlunos() {
        $.ajax({
            type: "GET",
            url: "../controllers/aluno_controller.php",
            data: { action: "list" },
            dataType: "json",
            success: function (response) {
                let tabela = $("#tabelaAlunos tbody");
                tabela.empty();
                response.data.forEach(function (aluno) {
                    let linha = `<tr id="linha-${aluno.id}">
                                    <td>${aluno.id}</td>
                                    <td>${aluno.nome}</td>
                                    <td>${aluno.email}</td>
                                    <td>${aluno.telefone}</td>
                                    <td>${aluno.data_nascimento}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btnEditar" data-id="${aluno.id}" data-bs-target="#modalEditarAluno">Editar</button>                                        
                                        <button class="btn btn-danger btn-sm btnExcluir" data-id="${aluno.id}">Excluir</button>
                                    </td>
                                  </tr>`;
                    tabela.append(linha);
                });
            }
        });
    }

    carregarAlunos();

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
                    if (response.status === "deleted") {
                        $("#linha-" + id).fadeOut();
                    } else {
                        alert("Erro ao excluir aluno.");
                    }
                }
            });
        }
    });

    $(document).on("click", ".btnEditar", function () {
        let alunoId = $(this).data("id"); // Pega o ID do aluno ao clicar no botão

        if (alunoId) {
            console.log("ID do aluno:", alunoId); // Verifica se está pegando o ID corretamente

            $.ajax({
                type: "GET",
                url: "../controllers/editar_aluno_controller.php",
                data: { id: alunoId },
                dataType: "json",
                success: function (response) {
                    console.log(response);

                    if (response) {
                        $('#alunoId').val(response.id);
                        $('#nome').val(response.nome);
                        $('#email').val(response.email);
                        $('#telefone').val(response.telefone);
                        $('#data_nascimento').val(response.data_nascimento);
                        $('#ativo').val(response.ativo);
                        var modal = new bootstrap.Modal(document.getElementById('modalEditarAluno'));
                        modal.show();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
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


    $("#formEditarAluno").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controllers/editar_aluno_controller.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("Aluno atualizado com sucesso!");
                    var modal = bootstrap.Modal.getInstance(document.getElementById('#modalEditarAluno'));
                    console.log(modal);

                    modal.hide();
                    carregarAlunos();
                } else {
                    alert("Erro ao atualizar aluno.");
                }
            },
            error: function () {
                alert("Erro ao atualizar aluno.");
            }
        });
    });

    $(document).on('hidden.bs.modal', '#modalCadastroAluno', '#modalEditarAluno', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

});

