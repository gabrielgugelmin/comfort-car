$(function() {
  clickOutsideMenu();
  MicroModal.init({
    disableScroll: true,
    onShow: function() {
      lockBody();
    },
    onClose: function() {
      unlockBody();
    }
  });

  var $docEl = $("html, body");
  var $wrap = $(".page-wrapper");
  var scrollTop;

  function lockBody() {
    if (window.pageYOffset) {
      scrollTop = window.pageYOffset;

      $wrap.css({
        top: -scrollTop
      });
    }

    $docEl.css({
      height: "100%",
      overflow: "hidden"
    });
  }

  function unlockBody() {
    $docEl.css({
      height: "",
      overflow: ""
    });

    $wrap.css({
      top: ""
    });

    window.scrollTo(0, scrollTop);
    window.setTimeout(function() {
      scrollTop = null;
    }, 0);
  }

  var didScroll;
  var lastScrollTop = 0;
  var offset = 5;
  var contactHeight = $(".contact").outerHeight();

  $(window).scroll(function() {
    didScroll = true;
  });

  setInterval(function() {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 100);

  function hasScrolled() {
    var st = $(this).scrollTop();

    if (Math.abs(lastScrollTop - st) <= offset) return;

    if (st > lastScrollTop && st > contactHeight) {
      $(".contact").removeClass("contact--down");
    } else if (st + $(window).height() < $(document).height()) {
      $(".contact").addClass("contact--down");
    }
    lastScrollTop = st;
  }

  // menu
  $(".js-open-menu").on("click", function(e) {
    e.preventDefault();
    openMenu();
  });

  $(".js-close-menu").on("click", function(e) {
    e.preventDefault();
    closeMenu();
  });

  $(".js-search").on("click", function(e) {
    e.preventDefault();
    openSearch();
  });

  // menu fixo ao scrollar
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 30) {
      $(".header").addClass("header--scrolling");
      $(".header__logo .logo").removeClass("logo--white");
    } else {
      $(".header").removeClass("header--scrolling");
      $(".header__logo .logo").addClass("logo--white");
    }
  });

  // slider banner
  $(".js-slider-banner").slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    centerMode: true,
    cssEase: "linear",
    dots: false,
    fade: true,
    infinite: true,
    mobileFirst: true,
    speed: 500
  });

  // slider sobre
  $(".js-sobre-slider").slick({
    arrows: true,
    dots: false,
    prevArrow:
      '<button type="button" class="carroussel__arrow carroussel__arrow--prev"></button>',
    nextArrow:
      '<button type="button" class="carroussel__arrow carroussel__arrow--next"></button>'
  });

  // slider arigo
  $(".js-artigo-slider").slick({
    arrows: true,
    dots: false,
    prevArrow:
      '<button type="button" class="artigo__arrow artigo__arrow--prev"></button>',
    nextArrow:
      '<button type="button" class="artigo__arrow artigo__arrow--next"></button>'
  });

  // slider depoimentos
  $(".js-depo-slider").slick({
    arrows: true,
    dots: false,
    prevArrow:
      '<button type="button" class="depo__arrow depo__arrow--prev"></button>',
    nextArrow:
      '<button type="button" class="depo__arrow depo__arrow--next"></button>'
  });

  // slider oportunidades
  $(".js-slider-oportunidades").slick({
    arrows: false,
    dots: false,
    autoplay: true,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          arrows: true,
          prevArrow:
            '<button type="button" class="oportunidades-slider__arrow oportunidades-slider__arrow--prev"></button>',
          nextArrow:
            '<button type="button" class="oportunidades-slider__arrow oportunidades-slider__arrow--next"></button>'
        }
      }
    ]
  });

  // slider de veículo
  $(".js-vehicle-slider").slick({
    arrows: false,
    dots: false,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          arrows: true,
          prevArrow:
            '<button type="button" class="vehicle-slider-nav__arrow vehicle-slider-nav__arrow--prev"></button>',
          nextArrow:
            '<button type="button" class="vehicle-slider-nav__arrow vehicle-slider-nav__arrow--next"></button>'
        }
      }
    ]
  });
  // slider de veículo
  $(".js-vehicle-nav-slider").slick({
    arrows: true,
    dots: false,
    asNavFor: $(".js-vehicle-slider"),
    mobileFirst: true,
    prevArrow:
      '<button type="button" class="vehicle-slider-nav__arrow vehicle-slider-nav__arrow--prev"></button>',
    nextArrow:
      '<button type="button" class="vehicle-slider-nav__arrow vehicle-slider-nav__arrow--next"></button>',
    slidesToShow: 3,
    slidesToScroll: 1,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      }
    ]
  });

  // INSTAGRAM
  var device = checkWindowWidth();
  if ($(".instafeed").length) {
    const limit = device === "desktop" ? 5 : 4;

    var feed = new Instafeed({
      accessToken: "2062070288.1677ed0.7ff767ea444f4440958a1a6c8e660d9a",
      clientId: "feb924f747174bdeaeb95531061cfce4",
      get: "user",
      limit,
      resolution: "low_resolution",
      tagName: "comfortcar.br",
      template:
        '<a target="_blank" class="instafeed__item wow fadeIn" style="background-image: url({{image}})" href="{{link}}"><div class="instafeed__content"><div class="instafeed__info"><span class="instafeed__icon instafeed__icon--heart">{{likes}}</span><span class="instafeed__icon instafeed__icon--comment">{{comments}}</span></div></div></a>',
      userId: "2062070288"
    });
    feed.run();
  }

  // pesquisa
  $(".js-search").on("focus", function(e) {
    $(".SearchResult").addClass("is-open");
  });

  var produtosArray = "";

  $.ajax({
    url:
      "https://" +
      window.location.host +
      "/page/assets/json/busca-veiculos.php",
    dataType: "json",
    async: false,
    success: function(data) {
      produtosArray = data;
    }
  });

  //   var produtosArray = [{"value":"Linde Werdelin","data":"linde-werdelin"},{"value":"Jaeger-Lecoutre","data":"jaegerlecoutre"},{"value":"Breitling","data":"breitling"},{"value":"Jaeger-Lecoutre","data":"jaegerlecoutre"},{"value":"Hublot","data":"hublot"},{"value":"Panerai","data":"panerai"},{"value":"IWC","data":"iwc"},{"value":"Rolex","data":"rolex"},{"value":"Breitling","data":"breitling"},{"value":"IWC","data":"iwc"},{"value":"Rolex","data":"rolex"}];

  // https://github.com/devbridge/jQuery-Autocomplete
  $(".search__input").autocomplete({
    lookup: produtosArray,
    onSelect: function(suggestion) {
      //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
      window.location.href = "/veiculo/" + suggestion.link;
    },
    response: function(event, ui) {
      ui.content.push({
        label:
          "<a href='/estoque' class='button button--orange' />Ver estoque completo</a>",
        button: true
      });
    },
    select: function(event, ui) {
      if (ui.item.button) {
        event.preventDefault();
      }
    },
    appendTo: ".search__result",
    onSearchComplete: function() {
      $(".search__result").addClass("is-visible");
    }
  });

  // SCROLLBAR
  if ($(".js-scrollbar").length > 0) {
    const ps = new PerfectScrollbar(".js-scrollbar", {
      wheelPropagation: false
    });
  }

  $("#form-proposta").on("submit", function(e) {
    e.preventDefault();

    const required = $(this).find("input[required], textarea[required]");
    console.log(required);

    let ok = 0;
    if (required) {
      required.each(function(element) {
        if (!$(element).is(":empty")) {
          ok++;
        }
      });
    }

    if (ok === required.length) {
      // envia o formulario
      // this.submit();
      $('#modalSucesso').modal('show')
    }
  });

  /* FORM Avaliacao */
  $("#formAvaliacao").submit(function(e) {
    e.preventDefault();
    var qtdErro = 0;
    $(this)
      .find("[data-validate=true]")
      .each(function() {
        var value = $.trim(
          $(this)
            .find("input, select, textarea")
            .val()
        );
        if (!value.length > 0) {
          $(this).addClass("error");
          qtdErro++;
        } else {
          $(this).removeClass("error");
        }
      });
    if (qtdErro == 0) {
      return $.ajax({
        type: "POST",
        url: "/page/assets/ajax/avaliacao-digital.php",
        data: $(this).serialize(),
        success: function(data) {
          if (data === "success") {
            // Limpa o form
            $("#formAvaliacao").trigger("reset");

            window.location.href =
              "https://" + window.location.host + "/obrigado-avaliacao";
          } else {
            console.log("Erro ao tentar enviar mensagem: " + data);
          }
        }
      });
    } else {
      console.log("Erro ao tentar enviar mensagem. Tente novamente.");
    }
  });

  /* FORM Contato */
  $("#formContato").submit(function(e) {
    e.preventDefault();
    var qtdErro = 0;
    $(this)
      .find("[data-validate=true]")
      .each(function() {
        var value = $.trim(
          $(this)
            .find("input, textarea")
            .val()
        );
        if (!value.length > 0) {
          $(this).addClass("error");
          qtdErro++;
        } else {
          $(this).removeClass("error");
        }
      });
    if (qtdErro == 0) {
      return $.ajax({
        type: "POST",
        url: "/page/assets/ajax/contato.php",
        data: $(this).serialize(),
        success: function(data) {
          if (data === "success") {
            // Limpa o form
            $("#formContato").trigger("reset");

            window.location.href =
              "https://" + window.location.host + "/obrigado-pelo-contato";
          } else {
            console.log("Erro ao tentar enviar mensagem: " + data);
          }
        }
      });
    } else {
      console.log("Erro ao tentar enviar mensagem. Tente novamente.");
    }
  });

  /* FORM PROPOSTA */
  $("#formProposta").submit(function(e) {
    e.preventDefault();
    var qtdErro = 0;
    $(this)
      .find("[data-validate=true]")
      .each(function() {
        var value = $.trim(
          $(this)
            .find("input, textarea")
            .val()
        );
        if (!value.length > 0) {
          $(this).addClass("error");
          qtdErro++;
        } else {
          $(this).removeClass("error");
        }
      });
    if (qtdErro == 0) {
      return $.ajax({
        type: "POST",
        url: "/page/assets/ajax/proposta.php",
        data: $(this).serialize(),
        success: function(data) {
          if (data === "success") {
            // Limpa o form
            $("#formProposta").trigger("reset");

            window.location.href =
              "https://" + window.location.host + "/obrigado-proposta";
          } else {
            console.log("Erro ao tentar enviar mensagem: " + data);
          }
        }
      });
    } else {
      console.log("Erro ao tentar enviar mensagem. Tente novamente.");
    }
  });

  /* FORM Avaliacao */
  $("#formNewsletter").submit(function(e) {
    e.preventDefault();
    var qtdErro = 0;
    $(this)
      .find("[data-validate=true]")
      .each(function() {
        var value = $.trim(
          $(this)
            .find("input, select, textarea")
            .val()
        );
        if (!value.length > 0) {
          $(this).addClass("error");
          qtdErro++;
        } else {
          $(this).removeClass("error");
        }
      });
    if (qtdErro == 0) {
      return $.ajax({
        type: "POST",
        url: "/page/assets/ajax/newsletter.php",
        data: $(this).serialize(),
        success: function(data) {
          if (data === "success") {
            // Limpa o form
            $("#formNewsletter").trigger("reset");

            window.location.href =
              "https://" + window.location.host + "/obrigado-newsletter";
          } else {
            console.log("Erro ao tentar enviar mensagem: " + data);
          }
        }
      });
    } else {
      console.log("Erro ao tentar enviar mensagem. Tente novamente.");
    }
  });

  // SMOOTH SCROLL
  $(".js-scroll").on("click", function(e) {
    smoothScroll(this, e);
  });

  $(".accordion > li:eq(0) a")
    .addClass("active")
    .next()
    .slideDown();

  $(".accordion__trigger").click(function(e) {
    console.log($(this));
    var dropDown = $(this).siblings(".accordion__content");
    console.log(dropDown);

    $(this)
      .closest(".accordion")
      .find(".accordion__content")
      .not(dropDown)
      .slideUp();

    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(this)
        .closest(".accordion")
        .find("a.active")
        .removeClass("active");
      $(this).addClass("active");
    }

    dropDown.stop(false, true).slideToggle();

    e.preventDefault();
  });

  if ($(".js-grid").length) {
    getItems();
  }

  //new WOW().init();

  function initIsotope() {
    var qsRegex;

    var marcasFilter;
    var modelosFilter;
    var anosFilter;
    var precosFilter;
    var categoriasFilter;

    // init Isotope
    var $container = $(".js-grid").isotope({
      // itemSelector: '.grid__item',
      // layoutMode: 'fitRows',
      getSortData: {
        valor: "[data-valor] parseInt"
      },
      hiddenStyle: {
        opacity: 0
      },
      visibleStyle: {
        opacity: 1
      },
      filter: function() {
        var $this = $(this);
        var searchResult = qsRegex ? $this.text().match(qsRegex) : true;

        marcasResult = marcasFilter ? $this.is(marcasFilter) : true;
        modelosResult = modelosFilter ? $this.is(modelosFilter) : true;
        anosResult = anosFilter ? $this.is(anosFilter) : true;
        precosResult = precosFilter ? $this.is(precosFilter) : true;
        categoriasResult = categoriasFilter ? $this.is(categoriasFilter) : true;
        return (
          searchResult &&
          marcasResult &&
          modelosResult &&
          anosResult &&
          precosResult &&
          categoriasResult
        );
      }
    });

    var initShow = $(".js-grid").data("init-show") || 24; // Número de itens exibidos ao carregar
    var counter = initShow; // Número de itens a serem carregados quando clicar no botão Carregar Mais
    var iso = $container.data("isotope"); // Instância do Isotope
    var footer = $(".grid__footer");
    var labelButtonPrimary =
      $(".js-grid").data("label-primary") || "carregar mais"; // Define a label do botão à esquerda
    var labelButtonSecondary =
      $(".js-grid").data("label-secondary") || "entrar em contato"; // Define a label do botão à direita
    var href = $(".js-grid").data("link") || "#!"; // Define a url do botão à direita

    if ($container.is(".js-grid")) {
      // Inclui o botão para carregar mais itens
      footer.append(
        '<div class="button-group"><button class="button js-load-more">' +
          labelButtonPrimary +
          "</button></div>"
      );
    }

    // Carrega os itens iniciais
    loadMore(initShow);

    function loadMore(toShow) {
      // Oculta os itens que ultrapassaram o limite do initShow ou counter
      var elems = $container.isotope("getFilteredItemElements");
      $container.find(".hidden").removeClass("hidden");
      var hiddenElems = iso.filteredItems
        .slice(toShow, elems.length)
        .map(function(item) {
          return item.element;
        });

      $(hiddenElems).addClass("hidden");
      $container.isotope("layout");

      // Se não tiver mais itens a serem carregados, oculta o botão Carregar Mais
      if (hiddenElems.length == 0 && $container.is(".js-grid")) {
        $(".js-load-more").addClass("hidden");
      } else {
        $(".js-load-more").removeClass("hidden");
      }

      $(".js-load-more").removeClass("is-loading");
    }

    // Carrega mais itens
    $(".js-load-more").click(function() {
      $(this).addClass("is-loading");
      counter = counter + initShow;

      loadMore(counter);
    });

    // Filtra os itens pela Marca
    $("#marcas").on("change", function() {
      $(".modelo-option").addClass("hidden");
      $("#modelos option:selected").prop("selected", false);
      modelosFilter = "*";
      marcasFilter = this.value;

      loadMore(initShow);
      $container.isotope();
      const marca = this.value.replace(".", "");

      $(".modelo-marca-" + marca).removeClass("hidden");

      loadMore(initShow);
      //loadModelos(marca);
    });

    var query_string = {};
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
      var pair = vars[i].split("=");
      // If first entry with this name
      if (typeof query_string[pair[0]] === "undefined") {
        query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
      } else if (typeof query_string[pair[0]] === "string") {
        var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
        query_string[pair[0]] = arr;
        // If third or later entry with this name
      } else {
        query_string[pair[0]].push(decodeURIComponent(pair[1]));
      }
    }

    //Veriavel com categoria
    var marcaQuery = query_string.marca;

    if (marcaQuery) {
      marcasFilter = "." + marcaQuery;
      $("#marcas").val(marcasFilter);
      $container.isotope();
      loadMore(initShow);
    }

    // Filtra os itens pelo Modelo
    $("#modelos").on("change", function() {
      modelosFilter = this.value;
      loadMore(initShow);
      $container.isotope();
      loadMore(initShow);
    });

    // Filtra os itens por Ano
    $("#anos").on("change", function() {
      anosFilter = this.value;
      loadMore(initShow);
      $container.isotope();
    });

    // Filtra os itens por Categoria
    $("#categorias").on("change", function() {
      categoriasFilter = this.value;
      loadMore(initShow);
      $container.isotope();
    });

    // Ordena os itens por ordem crescente ou decrescente
    $("#precos").on("change", function() {
      var filterValue = this.value;
      var order = $(this)
        .find(":selected")
        .data("ordem");
      loadMore(1000);
      $container.isotope({
        sortBy: filterValue,
        sortAscending: order
      });
    });

    // Filtra os itens de acordo com o digitado na busca
    var $quicksearch = $(".quicksearch").keyup(
      debounce(function() {
        qsRegex = new RegExp($quicksearch.val(), "gi");
        $container.isotope();
        loadMore(6);
      }, 200)
    );

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
      };
    }
  }

  function getItems() {
    var contentToLoad = $(".js-grid").data("load");
    $.getJSON(
      "https://" +
        window.location.host +
        "/page/assets/json/" +
        contentToLoad +
        ".php",
      function(data) {}
    )
      .fail(function(data) {})
      .done(function(data) {
        $.each(data, function(index, item) {
          if (item.idVeiculo) {
            // console.log(item);
            var $box = getItemLayout(item, contentToLoad);
          }
          $(".js-grid").append($box);
        });

        initIsotope();
      });
  }
});

/*
function loadModelos (marca) {
  // Esse json deve retornar os modelos da marca recebida via parametro
  $.getJSON("https://" + window.location.host + "/page/assets/json/modelos.json", function (data) {})
    .fail(function (data) {
    }).done(function (data) {
      $("#modelos").empty();
      $.each(data, function (index, item) {
        $("#modelos").append(`<option value=".${item.value}">${item.title}</option>`);
      });
    });
}
*/

function getItemLayout(item, contentToLoad) {
  if (contentToLoad === "showroom") {
    return `<a href="/veiculo/${item.alias}/${
      item.idVeiculo
    }" class="grid__item car wow fadeIn ${slugify(item.idMarca)} ${slugify(
      item.modelo
    )} ${slugify(item.anoModelo)}" data-valor=${item.preco}>
    <div class="car__img" style="background-image: url(page/assets/img/albuns/album_${
      item.idAlbum
    }/${item.capa})"></div>
    <div class="car__detail">
      <p>${item.idMarca} ${item.modelo} ${item.anoFabricacao}/${
      item.anoModelo
    }</p>
    </div>
    <span class="button button--large">conferir</span>
  </a>`;
  } else if (contentToLoad === "posts") {
    return `<a href="artigo.html" class="blog__item wow fadeIn ${slugify(
      item.categoria
    )}" style="background-image: url(${item.img})">
      <div class="container">
        <div class="blog__detail">
          <p class="blog__title">${item.title}</p>
          <span class="button button--orange">Ler</span>
        </div>
      </div>
    </a>`;
  }
}

function closeMenu() {
  $(".nav").removeClass("nav--open");
  $("body").removeClass("overflow-hidden");
  $(".overlay").removeClass("overlay--open");
}

function openMenu() {
  $(".nav").addClass("nav--open");
  $("body").addClass("overflow-hidden");
  $(".overlay").addClass("overlay--open");
}

function openSearch() {
  $(".search").addClass("search--open");
  $("body").addClass("overflow-hidden");
  $(".overlay").addClass("overlay--open");
  setTimeout(() => {
    $(".search input").focus();
  }, 300);
}

function closeSearch() {
  $(".search").removeClass("search--open");
  $("body").removeClass("overflow-hidden");
  $(".overlay").removeClass("overlay--open");
  $(".search input").val("");
}

function viewport() {
  var e = window,
    a = "inner";
  if (!("innerWidth" in window)) {
    a = "client";
    e = document.documentElement || document.body;
  }
  return { width: e[a + "Width"], height: e[a + "Height"] };
}

function checkWindowWidth() {
  var w = viewport().width;
  var size = "";
  if (w > 991) {
    size = "desktop";
  } else {
    size = "mobile";
  }

  return size;
}

function clickOutsideMenu() {
  $(document).on("mouseup", function(e) {
    var elem = $(".nav, .search");

    if (!elem.is(e.target) && elem.has(e.target).length === 0) {
      closeMenu();
      closeSearch();
    }
  });
}

function smoothScroll(link, event) {
  if (link.hash !== "") {
    event.preventDefault();
    var hash = link.hash;

    $("html, body").animate(
      {
        scrollTop: $(hash).offset().top - 100
      },
      800,
      function() {
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      }
    );
  }
}

function slugify(text) {
  text = text.replace(/^\s+|\s+$/g, ""); // trim
  text = text.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    text = text.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }

  text = text
    .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
    .replace(/\s+/g, "-") // collapse whitespace and replace by -
    .replace(/-+/g, "-"); // collapse dashes

  return text;
}
