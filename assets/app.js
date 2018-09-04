var form = document.querySelector('form#filters'),
    inputs = document.querySelectorAll('input[type=checkbox]');
for (var i in inputs) {
    inputs[i].onchange = function () {
        form.submit();
    }
}

var buy = function (event, form) {
    event.preventDefault();

    var item = form;
    while (item.getAttribute('class') !== 'item') item = item.parentNode;
    item.classList.add('animate');

    setTimeout(function() {
        form.submit();
    }, 1000);

    return false;
};