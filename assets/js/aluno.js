// aluno.js
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
                    atualizarLista();
                } else {
                    $("#msgStatus").html("<span class='text-danger'>Erro ao cadastrar aluno.</span>");
                }
            }
        });
    });

    function carregarAlunos() {
        $.ajax({
            type: "GET",
            url: "../controllers/aluno_controller.php",
            data: { action: "list" }, // Ação para listar os alunos
            dataType: "json",
            success: function (response) {
                let tabela = $("#tabelaAlunos tbody");
                tabela.empty(); // Limpar tabela antes de inserir novos dados
                response.data.forEach(function (aluno) {
                    let linha = `<tr id="linha-${aluno.id}">
                                    <td>${aluno.id}</td>
                                    <td>${aluno.nome}</td>
                                    <td>${aluno.email}</td>
                                    <td>${aluno.telefone}</td>
                                    <td>${aluno.data_nascimento}</td>
                                    <td>
                                        <a href="editar_aluno.php?id=${aluno.id}" class="btn btn-warning btn-sm">Editar</a>
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
    
});
