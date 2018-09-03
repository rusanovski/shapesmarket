var form = document.querySelector('form'),
    inputs = document.querySelectorAll('input[type=checkbox]');
for (var i in inputs) {
    inputs[i].onchange = function () {
        form.submit();
    }
}