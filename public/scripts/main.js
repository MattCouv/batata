(function($) {
    'use strict';

    $(function() {

      // Cached dom
      var $form = $('.form'),
          $type = $form.find('#type'),
          $option = $form.find('#option'),
          $cancel = $form.find('#cancel'),
          $videoInput = '<label for="path">Lien de la vidéo' +
        '</label><input name="lien" id="path" required class="form-control">',
          $photoInput = '<label for="path">Ajouter une image' +
        '</label><input type="file" name="lien" id="path" class="form-control" required>';

      $type.change(function() {
        var val = $('select option:selected').val();
        if (val === 'image') {
          _render($photoInput);
        }else {
          _render($videoInput);
        }
      });

      $cancel.on('click', function() {
        $option.html('');
      });

      $('#menu-toggle').click(function(e) {
        e.preventDefault();
        $('#wrapper').toggleClass('toggled');
      });

      function _render(item) {
        $option.html(item);
      }

    });

    $(function() {

      var $context = $('.galery');
      var $item = $context.find('.galery__itemlink');

      $('.modal__item').on('click',closePopup);
      $('.nav__close').on('click',function(event) {
        closeGalery(event);
      });
      $('.enter__btn').on('click',function(event) {
        closeGalery(event);
      });
      function closeGalery(event) {
        event.preventDefault();
        $('.modal__galery').toggleClass('modal__item--open');
      }

      $item.on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        getPosts(id, function(data) {
          console.log(data);
          createPopup(data);
        });
        // $('.popup').show('slow');
      });

      function getAjax(params, callback) {
        return $.ajax(params).done(function(response) {
          callback(response);
        }).fail(function() {
          callback(false);
        });
      }

      function getPosts(id, callback) {
        var params = {
          url: '/Api/getPosts/' + id,
          type: 'GET',
          dataType: 'json'
        };
        getAjax(params, callback);
      }

      function createPopup(data) {
        $('.modal__item').toggleClass('modal__item--open');
        var $context = $('.modal__item').find('.modal__popup').html('');
        var title = $('<h2 class="modal__item--nom">' + data.nom + ' date de création ' + data.annee + '</h2>');
        var desc = $('<p class="modal__item--desc">' + data.description + '</p>');
        if (data.type == 'image') {
          var contain = $('<img class="modal__item--img" alt="" src="/public/images/galery/' + data.lien + '/large.jpg">');
        }else {
          var contain = $('<iframe class="modal__item--iframe" width="100%"  src="https://www.youtube.com/embed/' + data.lien + '" frameborder="0" allowfullscreen></iframe>');
        }
        $context.append(contain).append(title).append(desc);
      }
    });

    function closePopup() {
      $('.modal__item').toggleClass('modal__item--open');
    }

    $('#scene').parallax({
      scalarX: 15,
      scalarY: 15,
      frictionX: 0.5,
      frictionY: 0.5
    });

  })(jQuery);
