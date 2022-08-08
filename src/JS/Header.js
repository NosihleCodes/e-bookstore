$(function(){
    $('#menu').on('click', function(){
        let parent = document.getElementById('parent');
        let menu = document.getElementById('menu');

        parent.style.display = 'block';
        menu.style.visibility = 'hidden';
    });
});

$(function(){
    $('#close').on('click', function(){
        let parent = document.getElementById('parent');
        let menu = document.getElementById('menu');

        parent.style.display = 'none';
        menu.style.visibility = 'visible';
    });
});
