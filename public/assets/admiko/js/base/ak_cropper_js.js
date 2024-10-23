/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkCropperJS {
    constructor() {
        this.CropperInit();
    }

    CropperInit() {
        let self = this;
        $('.js-ak-image-cropper-upload').each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let element = $(this);
                let parent = $(this).closest('.el-box-image-cropper');
                self.CropperStart(parent, element)
            }
        })
    }

    CropperStart(parent, element) {

        let save_image_data = parent.find('.js-ak-cropped-save');
        let cropper_container = parent.find('.js-ak-cropper-container');
        let image_size = parent.find('.js-ak-cropped-image-size span');

        element.change(function () {
            if (this.files && this.files[0] && /^image\/\w+$/.test(this.files[0].type)) {
                let reader = new FileReader();
                let fileInfo = this.files[0]
                reader.onload = function (e) {
                    element.cropper_file = fileInfo;
                    element.cropper_src = e.target.result;
                    let image = parent.find('.js-ak-cropper-image');
                    image.attr('src', element.cropper_src);
                    if (element.cropper) {
                        element.cropper.replace(element.cropper_src).reset();
                    } else {
                        cropper_container.show();
                        element.cropper = new Cropper(image[0], {
                            viewMode: 2,
                            checkOrientation: false,
                            minContainerWidth: 200,
                            dragMode: 'move',
                            minContainerHeight: 200,
                            ready: handleCropEvent,
                            cropstart: handleCropEvent,
                            cropend: handleCropEvent,
                        })
                    }
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                croppedDestroy();
            }
        });

        function handleCropEvent() {
            let newImage = element.cropper.getCroppedCanvas({
                width: element.data('max-width'),
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            }).toDataURL(element.cropper_file.type, 1);
            image_size.text(Math.ceil(newImage.length / 1024));
            save_image_data.val(newImage)
        }

        function croppedDestroy() {
            cropper_container.hide();
            save_image_data.val('');
            if (element.cropper) {
                element.cropper.destroy();
            }
            element.cropper = false;
        }

        parent.on('click', '.js-ak-cropper-rotate', function () {
            element.cropper.rotate(90);
        })
        parent.on('click', '.js-ak-cropper-zoom-in', function () {
            element.cropper.zoom(0.1);
        })
        parent.on('click', '.js-ak-cropper-zoom-out', function () {
            element.cropper.zoom(-0.1);
        })
        parent.on('click', '.js-ak-cropper-reset', function () {
            element.cropper.reset();
        })
        parent.on('click', '.js-ak-cropper-ratio', function () {
            let ratio = $(this).data('ratio');
            element.cropper.setAspectRatio(ratio);
        })
        parent.on('click', '.js-ak-cropper-remove', function () {
            croppedDestroy();
        })
    }
}
