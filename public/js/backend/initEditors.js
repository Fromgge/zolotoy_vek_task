'use strict';

// Отримуємо всі елементи з класом "ckeditor"
const editors = document.querySelectorAll('.ckeditorPanel');

editors.forEach(editor => {
    CKEDITOR.replace(editor, {
        htmlEncodeOutput: false,
        wordcount: {
            showWordCount: true,
            showCharCount: true,
            countSpacesAsChars: true,
            countHTML: false,
        },
        removePlugins: 'zsuploader',

        filebrowserBrowseUrl: '/public/assets/frontend/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
        filebrowserImageBrowseUrl: '/public/assets/frontend/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
        filebrowserUploadUrl: '/public/assets/frontend/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
        filebrowserImageUploadUrl: '/public/assets/frontend/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
    });
});

window.setTextareaValue = function () {
    editors.forEach(editor => {
        const editorName = editor.getAttribute('name');

        if (CKEDITOR.instances[editorName]) {
            const editorData = CKEDITOR.instances[editorName].getData();

            $(editor).val(editorData);
        }
    });
};

// if (editors.length) {
//     document.getElementById('saveModelBtn').addEventListener('click', window.setTextareaValue);
// }
