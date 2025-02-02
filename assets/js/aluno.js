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
                console.log("Resposta recebida:", response);  
                if (response.status === "success") {
                    $("#msgStatus").html("<span class='text-success'>Aluno cadastrado com sucesso!</span>");
                    $("#formAluno")[0].reset(); 
        
                    // Fecha o modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modalCadastroAluno'));
                    if (modal) {
                        modal.hide();
                    }
        
                    // Remove a classe e backdrop
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
        
                    // Atualiza a lista de alunos
                    carregarAlunos();
                } else {
                    $("#msgStatus").html("<span class='text-danger'>Erro ao cadastrar aluno.</span>");
                    // Fecha o modal em caso de erro também
                    if (modal) {
                        modal.hide();
                    }
        
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
        
                    // Atualiza a lista de alunos
                    carregarAlunos();
                }
            },
            error: function(xhr, status, error) {
                console.log("Erro na requisição:", xhr.responseText);  // Exibe o erro da requisição
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
                    if (response.status === "deleted") {
                        $("#linha-" + id).fadeOut();
                    } else {
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
            console.log("ID do aluno:", alunoId);
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
        console.log("Iniciando atualização...");
        
        $.ajax({
            type: "POST",
            url: "../controllers/editar_aluno_controller.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                console.log("Resposta do servidor:", response);
                
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
                    
                    modal.hide();           
                    carregarAlunos();
                } else {
                    console.log("Erro na atualização:", response);
                }
            },
        });
    });

});

