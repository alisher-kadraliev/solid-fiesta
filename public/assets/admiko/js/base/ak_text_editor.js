/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkTextEditor {
    constructor() {
        this.TextEditorStart();
    }
    TextEditorStart() {
        if ($('.js-ak-tiny-mce-simple-text-editor').length > 0) {
            $(".js-ak-tiny-mce-simple-text-editor").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let id = '#'+$(this).attr('id');
                    let height = $(this).data('height');
                    tinymce.init({
                        selector: id,
                        menubar: false,
                        plugins: 'preview importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
                        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 36pt 48pt 60pt 72pt 96pt",
                        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | link anchor | removeformat | code',
                        toolbar_mode: 'sliding',
                        statusbar: false,
                        height: height,
                    });
                }
            })

        }
        if ($('.js-ak-tiny-mce-advanced-text-editor').length > 0) {
            $(".js-ak-tiny-mce-advanced-text-editor").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let id = '#'+$(this).attr('id');
                    let height = $(this).data('height');
                    tinymce.init({
                        selector: id,
                        menubar: false,
                        plugins: 'preview importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
                        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 36pt 48pt 60pt 72pt 96pt",
                        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | code',
                        toolbar_mode: 'sliding',
                        statusbar: false,
                        height: height,
                    });
                }
            })
        }
    }
}
