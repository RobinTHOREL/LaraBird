/**
 * Created by diegowaziri on 09/03/2017.
 */

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.name;

    var isLike = event.target.previousElementSibling == null;

    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});

$('.comment').on('click', function (event) {

});



$(function() {

    hljs.initHighlightingOnLoad();
// configure marked
    var renderer = new marked.Renderer();
    renderer.table = function (header, body) {
        return '\
  				<table class="table table-bordered table-striped table-hover">\
  					<thead>\
  						' + header + '\
  					</thead>\
  					<tbody>\
  						' + body + '\
  					</tbody>\
  				</table>';
    },

        marked.setOptions({
            sanitize: false,
            highlight: function (code) {
                return hljs.highlightAuto(code).value;
            },
            renderer: renderer,
            breaks: true
        });

    $.fn.extend({
        marked: function() {
            this.each(function() {
                $this = $(this);
                $this.html(marked($this.html()));
            })

            return this;
        },
    });

    $('.markdown').marked();

    // data
    var users = [
        {username: 'Mirage'},
        {username: 'LeDouxBeurre'},
        {username: 'Hf'},
        {username: 'ref'},
        {username: 'php-sensei'},
        {username: 'Abra'},
        {username: 'Nana'},
        {username: 'Wildy'},
        {username: 'Brixton'},
        {username: 'EtatDesLieux'},
    ];

    $('#comment').suggest('@', {
        data: users,
        map: function(user) {
            return {
                value: user.username,
                text: '<strong>'+user.username+'</strong>'
            }
        }
    })

});


