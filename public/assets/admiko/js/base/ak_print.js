/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkPrint {
    constructor() {
        this.showPagePrint()
    }
    showPagePrint() {
        $('.js-ak-show-container').on('click', '.js-ak-show-content-print', function (event) {
            event.preventDefault();
            let content = document.getElementById("js-ak-show-content-print").outerHTML;
            let printWindow = window.open('', '', 'height=700,width=1000');
            printWindow.document.write('<html><head><title>' + window.location.href + '</title>');
            let linkElements = document.querySelectorAll('link[href$="theme.css"]');

            for (let i = 0; i < linkElements.length; i++) {
                let linkElement = document.createElement('link');
                linkElement.rel = 'stylesheet';
                linkElement.href = linkElements[i].href;
                printWindow.document.head.appendChild(linkElement);
            }
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        })
    }
}
