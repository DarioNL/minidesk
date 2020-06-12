$("tr.clickable-row td").click(function () {
    window.location.href = $(this).parent().attr('data-href');
});
