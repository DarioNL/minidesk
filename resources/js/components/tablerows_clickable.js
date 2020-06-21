$("tr.clickable-row-not-last td:not(:last-child)").click(function () {
    if (!$(this).hasClass('disabled-click')) {
        window.location.href = $(this).parent().attr('data-href');
    }
});

$("tr.clickable-row td:not(:last-child)").click(function () {
    window.location.href = $(this).parent().attr('data-href');
});
