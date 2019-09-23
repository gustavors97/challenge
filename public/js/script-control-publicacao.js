var fileTOUpload;

$(document).ready(function($) {
    $('#inputDataPublicacao').mask('00/00/0000 00:00');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name=\"csrf-token\"]").attr("content")
        }
    });

    // Evento ao escolher um arquivo para upload
    $("#inputFile").change(function(){
        imagePreview(this);
    });

    // Evento ao clicar no botão de salvar publicação
    $("#form-postagem").on('submit', function() {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/createPostagem",
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percent = (evt.loaded / evt.total) * 100;

                        $("#progressBar").text(percent + "%");
                        $("#progressBar").css("width", percent + "%");
                    }
                }, false);
                return xhr;
            },
            beforeSend:function(XMLHttpRequest) {
                $("#responseResult").empty();
                $("#progressBar").text("0%");
                $("#progressBar").css("width", "0%");
            },
            success:function(result) {
                if (result.status == 'success') {
                    $("#responseResult").html("<span class='text-success'>" + result.message + "</span>");
                    $("#progressBar").text("Sucesso!");
                    $("#progressBar").css("width", "100%");

                } else {
                    $("#responseResult").html("<span class='text-danger'>" + result.message + "</span>");
                    $("#progressBar").text("0%");
                    $("#progressBar").css("width", "0%");
                }
            },
            error:function(data) {
                $.each(data.responseJSON.errors, function(index) {
                    var content = data.responseJSON.errors[index];
                    $("#responseResult").append("<span class='text-danger'>" + content + "</span>");
                });
            }
        });
    });

    $(".btPublicar").click(function() {
        event.preventDefault();

        $element = $(this);

        $.ajax({
            type: "POST",
            url: "/publishPostagem",
            dataType: 'json',
            data: {
                id: $element.closest('tr').attr('id'),   // ID da postagem a ser publicada
            },
            success:function(result) {
                if (result.status == 'success') {
                    $element.attr("disabled","disabled");

                } else { 
                    // Tratar exibição da mensagem informando ao usuário para tentar novamente a execução do processo
                }
            }
        });
    });

    $(".btRemover").click(function() {
        event.preventDefault();

        $element = $(this);

        $.ajax({
            type: "POST",
            url: "/removePostagem",
            data: {
                id: $element.closest('tr').attr('id'),   // ID da postagem a ser publicada
            },
            success:function(result) {
                if (result.status == 'success') {
                    $element.parents('tr').remove();

                } else { 
                    // Tratar exibição da mensagem informando ao usuário para tentar novamente a execução do processo
                }
            }
        });
    });
});

// Exibe o preview da imagem a ser enviada para publicação
function imagePreview(input) {    
    if (input.files && input.files[0]) {
        var fileReader = new FileReader();
        
        fileReader.onload = function (e) {
            fileTOUpload = e.target.result;
            $("#image-preview").removeClass("d-none");
            $("#image-preview").attr("src", fileTOUpload);
        }
        
        fileReader.readAsDataURL(input.files[0]);
    }
}