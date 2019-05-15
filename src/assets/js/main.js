$(function () {
  clickOutsideMenu();
  MicroModal.init();

  // menu
  $('.js-open-menu').on('click', function(e) {
    e.preventDefault();
    openMenu();
  });

  $('.js-close-menu').on('click', function(e) {
    e.preventDefault();
    closeMenu();
  });

	// menu fixo ao scrollar
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 30) {
      $('.header').addClass('header--scrolling');
      $('.header__logo .logo').removeClass('logo--white');
    } else{
    	$('.header').removeClass('header--scrolling');
    	$('.header__logo .logo').addClass('logo--white');
    }
  });

  // slider banner
  $('.js-banner-slider').slick({
    arrows: false,
    dots: false,
  });

  // slider oportunidades
  $('.js-slider-oportunidades').slick({
    arrows: false,
    dots: false,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          arrows: true,
          prevArrow: '<button type="button" class="oportunidades-slider__arrow oportunidades-slider__arrow--prev"></button>',
          nextArrow: '<button type="button" class="oportunidades-slider__arrow oportunidades-slider__arrow--next"></button>',
        }
      },
    ]
  });

  // slider youtube
  $('.js-video-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '<button type="button" class="video-slider__arrow video-slider__arrow--prev"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 54.5 95" style="enable-background:new 0 0 54.5 95;" xml:space="preserve"><g><path fill="#FFF" d="M8.7,1.5C7.7,0.5,6.5,0,5.1,0S2.5,0.6,1.5,1.5C0.5,2.5,0,3.7,0,5.1s0.5,2.6,1.5,3.6l38.9,38.8L1.5,86.3 c-1,1-1.5,2.2-1.5,3.6s0.5,2.6,1.5,3.6S3.7,95,5,95c1.2,0,2.5-0.5,3.5-1.4l46-46L8.7,1.5z"/></g></svg></button>',
    nextArrow: '<button type="button" class="video-slider__arrow video-slider__arrow--next"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 54.5 95" style="enable-background:new 0 0 54.5 95;" xml:space="preserve"><g><path fill="#FFF" d="M8.7,1.5C7.7,0.5,6.5,0,5.1,0S2.5,0.6,1.5,1.5C0.5,2.5,0,3.7,0,5.1s0.5,2.6,1.5,3.6l38.9,38.8L1.5,86.3 c-1,1-1.5,2.2-1.5,3.6s0.5,2.6,1.5,3.6S3.7,95,5,95c1.2,0,2.5-0.5,3.5-1.4l46-46L8.7,1.5z"/></g></svg></button>',
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
    ]
  });

  // INSTAGRAM
  // var device = checkWindowWidth();
  // if ($('.instafeed').length) {
  //   if (device === 'desktop') {
  //     var feed = new Instafeed({
  //       accessToken: 'aa',
  //       clientId: 'aa',
  //       get: 'user',
  //       limit: 5,
  //       resolution: 'low_resolution',
  //       tagName: 'aa',
  //       template: '<a target="_blank" class="instafeed__item" style="background-image: url({{image}})" href="{{link}}"><div class="instafeed__content"><div class="instafeed__info"><span class="instafeed__icon instafeed__icon--heart">{{likes}}</span><span class="instafeed__icon instafeed__icon--comment">{{comments}}</span></div></div></a>',
  //       userId: 'aa'
  //     });
  //     feed.run();
  //   }
  // }

  // SCROLLBAR
  if ($('.js-scrollbar').length > 0) {
    const ps = new PerfectScrollbar('.js-scrollbar');
  }

  // SMOOTH SCROLL
  $('.js-scroll').on('click', function(e) {
    smoothScroll(this, e);
  });

  $('.accordion > li:eq(0) a').addClass('active').next().slideDown();

  $('.accordion__trigger').click(function(e) {
    console.log($(this));
    var dropDown = $(this).siblings('.accordion__content');
    console.log(dropDown);

    $(this).closest('.accordion').find('.accordion__content').not(dropDown).slideUp();

    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
    } else {
        $(this).closest('.accordion').find('a.active').removeClass('active');
        $(this).addClass('active');
    }

    dropDown.stop(false, true).slideToggle();

    e.preventDefault();
  });

  if ($('.js-grid').length) {
    getItems();
  }

  function initIsotope() {
    var qsRegex;

    var marcasFilter;
    var modelosFilter;
    var anosFilter;
    var precosFilter;


    // init Isotope
    var $container = $('.js-grid').isotope({
      itemSelector: '.grid__item',
      layoutMode: 'fitRows',
      getSortData: {
        valor: '[data-valor] parseInt',
      },
      filter: function () {
        var $this = $(this);
        var searchResult = qsRegex ? $this.text().match(qsRegex) : true;

        marcasResult = marcasFilter ? $this.is(marcasFilter) : true;
        modelosResult = modelosFilter ? $this.is(modelosFilter) : true;
        anosResult = anosFilter ? $this.is(anosFilter) : true;
        precosResult = precosFilter ? $this.is(precosFilter) : true;
        return searchResult && marcasResult && modelosResult && anosResult && precosResult;
      }
    });

    var initShow = ($('.js-grid').data('init-show')) || 6; // Número de itens exibidos ao carregar
    var counter = initShow; // Número de itens a serem carregados quando clicar no botão Carregar Mais
    var iso = $container.data('isotope'); // Instância do Isotope
    var footer = $('.grid__footer');
    var labelButtonPrimary = ($('.js-grid').data('label-primary')) || 'carregar mais'; // Define a label do botão à esquerda
    var labelButtonSecondary = ($('.js-grid').data('label-secondary')) || 'entrar em contato'; // Define a label do botão à direita
    var href = ($('.js-grid').data('link')) || '#!'; // Define a url do botão à direita

    if ($container.is('.js-grid')) {
      // Inclui o botão para carregar mais itens
      footer.append('<div class="button-group"><button class="button js-load-more">' + labelButtonPrimary + '</button></div>');
    }

    // Carrega os itens iniciais
    loadMore(initShow);

    function loadMore(toShow) {
      // Oculta os itens que ultrapassaram o limite do initShow ou counter
      var elems = $container.isotope('getFilteredItemElements');
      $container.find(".hidden").removeClass("hidden");
      var hiddenElems = iso.filteredItems.slice(toShow, elems.length).map(function (item) {
        return item.element;
      });

      $(hiddenElems).addClass('hidden');
      $container.isotope('layout');

      // Se não tiver mais itens a serem carregados, oculta o botão Carregar Mais
      if (hiddenElems.length == 0 && $container.is('.js-grid')) {
        $('.js-load-more').addClass("hidden");
      } else {
        $('.js-load-more').removeClass("hidden");
      };

      $('.js-load-more').removeClass('is-loading');
    }

    // Carrega mais itens
    $(".js-load-more").click(function () {
      $(this).addClass('is-loading');
      counter = counter + initShow;

      loadMore(counter);
    });

    // Filtra os itens pelo Estado
    $('#estados').on('change', function () {
      estadosFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens pela Cidade
    $('#cidades').on('change', function () {
      cidadesFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens pela Região
    $('#regioes').on('change', function () {
      regioesFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens pela Cidade
    $('#bairros').on('change', function () {
      bairrosFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens pela Marca
    $('#marcas').on('change', function () {
      marcasFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens pelo Modelo
    $('#modelos').on('change', function () {
      modelosFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Filtra os itens por Ano
    $('#anos').on('change', function () {
      anosFilter = this.value;
      loadMore(1000);
      $container.isotope();
    });

    // Ordena os itens por ordem crescente ou decrescente
    $('#precos').on('change', function () {
      var filterValue = this.value;
      var order = $(this).find(":selected").data('ordem');
      loadMore(1000);
      $container.isotope({
        sortBy: filterValue,
        sortAscending: order,
      });
    });

    // Filtra os itens de acordo com o digitado na busca
    var $quicksearch = $('.quicksearch').keyup( debounce( function() {
      qsRegex = new RegExp($quicksearch.val(), 'gi');
      $container.isotope();
      loadMore(1000);
    }, 200));

    function debounce(fn, threshold) {
      var timeout;
      return function debounced() {
        if (timeout) {
          clearTimeout(timeout);
        }
        function delayed() {
          fn();
          timeout = null;
        }
        timeout = setTimeout(delayed, threshold || 100);
      }
    }
  }

  function getItems() {
    $.getJSON("/assets/json/cars.json", function (data) {})
    .fail(function (data) {
    }).done(function (data) {
      $.each(data, function (index, item) {
        if(item.id) {
          // console.log(item);
          var $box = getItemLayout(item);
        }
        $(".js-grid").append($box);
      });

      initIsotope();
    });
  }
});

function getItemLayout(item) {
  return `<a href="#!" class="grid__item car ${slugify(item.brand)} ${slugify(item.modelo)} ${slugify(item.ano)}" data-valor=${item.preco}>
    <div class="car__img" style="background-image: url(${item.img})"></div>
    <div class="car__detail">
      <p>${item.title}</p>
    </div>
    <span class="button button--large">conferir</span>
  </a>`;
}

function closeMenu() {
  $('.nav').removeClass('nav--open');
  $('body').removeClass('overflow-hidden');
  $('.overlay').removeClass('overlay--open')
}

function openMenu() {
  $('.nav').addClass('nav--open');
  $('body').addClass('overflow-hidden');
  $('.overlay').addClass('overlay--open')
}

function viewport() {
  var e = window, a = 'inner';
  if (!('innerWidth' in window )) {
      a = 'client';
      e = document.documentElement || document.body;
  }
  return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

function checkWindowWidth() {
  var w = viewport().width;
  var size = '';
  if(w > 991){
    size = 'desktop';
  } else{
    size = 'mobile';
  }

  return size;
}

function clickOutsideMenu() {
  $(document).on('mouseup', function(e) {
    var elem = $('.nav');

    if (!elem.is(e.target) && elem.has(e.target).length === 0) {
      closeMenu();
    }
  });
}

function smoothScroll(link, event) {
	if (link.hash !== '') {
		event.preventDefault();
		var hash = link.hash;

		$('html, body').animate({
			scrollTop: $(hash).offset().top - 100
		}, 800, function(){

			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		});
	}
}

function slugify(text) {
  text = text.replace(/^\s+|\s+$/g, ''); // trim
  text = text.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    text = text.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  text = text.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return text;
}
