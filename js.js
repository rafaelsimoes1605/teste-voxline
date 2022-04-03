$(function () {
    $('html').find('form').on('submit', function (e) {

        e.preventDefault();
        e.stopPropagation();

        let ths = $(this);

        $.ajax({
            url: 'ajaxBuscaCep.php',
            type: 'POST',
            dataType: 'JSON',
            data: ths.serialize(),
            beforeSend: function () {
                $('html').find('.buscarbtn').prop("disable", true).text('Aguarde...');
            },
            complete: function (xhr) {
                $('html').find('.buscarbtn').prop("disable", false).text('Pesquisar');
                let res = xhr.responseJSON;

                if (res.Result) {
                    let objContent = $('html').find('.j_content_cep');
                    objContent.html('');
                    objContent.html(res.Result).fadeIn();
                }

                if (res.Error) {
                    $.each(res.Error, function (i, v) {
                        let setField = $('html').find('#' + i);
                        setField.css("border-color", "red");
                        setField.closest('label').find('.alert').fadeOut().remove();
                        setField.after('<div class="alert" style="display:none;">* ' + v.msg + '</div>');
                        $('html').find('.alert').fadeIn();

                        setField.on('focus', function () {
                            $(this).css('border', '');
                            $(this).closest('label').find('.alert').fadeOut();
                        });
                    });
                }
            },
            error: function (err) {
                console.log(err.responseText);
            }

        });
        return false;
    });

    $('html').find('.cancelbtn').on('click', function () {
        let objLabel = $('html').find('.j_frm_busca_cep');
        objLabel.find('input').val('').css('border', '').focus();
        objLabel.find('.alert').fadeOut();
        $('html').find('.j_content_cep').fadeOut().html();
    });

});


$(document).ready(function () {
    $('.mask_cep').mask('00000-000', {
        reverse: true
    });
});
