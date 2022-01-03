(function ($) {
  var GA = window.GA || {};

  GA.top = function () {
    var $window = $(window);
    var $body = $('body');
    var mq = window.matchMedia('(min-width: 768px)');

    var _init = function _init() {
      _carousel.init();
    };

    var _carousel = function () {
      var $loader = $('.js-sitetop-loader');
      var $hero = $('#sitetop-hero');
      var $maskImg = $hero.find('.js-carouselmaskimg');
      var $nextBtn = $hero.find('.sitetop-hero_navbtn');
      var $nextBtnImg = $hero.find('.sitetop-next');
      var $nextImg = $hero.find('.sitetop-next_thumbmask');
      var $nextThumb = $hero.find('.sitetop-next_thumb');
      var $nextBg = $hero.find('.sitetop-next_bg');
      var $txt = $hero.find('.sitetop-hero_txt');
      var $readmore = $hero.find('.sitetop-hero_btn');
      var $nav = $('#sitetop-hero_nav');
      var $progressbar = $('#sitetop-hero_progressbar');
      var $pagination = $('#sitetop-hero_pagination');
      var throttleTimer = void 0;
      var slideLength = $txt.length;
      var slideIndex = 0;
      var slideAnimationed = void 0;
      var slideTimer = void 0;
      var timerInterval = 5500;

      var pixiObj = void 0;

      var _init = function _init() {
        pixiObj = _pixiInit();

        mq.addListener(_setMaskValue);
        _bind();
      };

      var _bind = function _bind() {
        window.addEventListener('PIXI_LOADED', function () {
          $body.addClass('-loaded');
          setTimeout(function () {
            pixiObj.next(0);
            _setMaskValue(mq);
            _setPagination();
            $hero.addClass('-loaded');

            setTimeout(function () {
              $nav.addClass('-active');
            }, 200);

            setTimeout(function () {
              $nav.addClass('-show').removeClass('-active');
              $progressbar.addClass('-active');
              _changeTxt(slideLength);
              _autoPlay();
              $loader.remove();
            }, 600);
          }, 500);
        });

        if ($.ua.isTablet) {
          $window.on('orientationchange', _restart);
        } else {
          $window.on('resize', _restart);
        }

        $nextBtnImg.on({
          'mouseenter': function mouseenter() {
            $nextBtn.addClass('-touched');
          },
          'mouseleave': function mouseleave() {
            $nextBtn.removeClass('-touched');
          }
        });

        $nextBtn.add($nextBtnImg).on('click', function () {
          if (!slideAnimationed) {
            slideAnimationed = true;
            _autoPlay();
            _changeNavBtnImg();
            _changeTxt();
            _updateSlideIndex();
            _changePagination();
            pixiObj.next(slideIndex);
          }
        });

        $readmore.on({
          'mouseenter': function mouseenter() {
            _pauseAutoPlay();
          },
          'mouseleave': function mouseleave() {
            _autoPlay();
          }
        });
      };

      var _restart = function _restart() {
        _pauseAutoPlay();
        _resetMaskValue();
        clearTimeout(throttleTimer);
        throttleTimer = setTimeout(function () {
          _setMaskValue();
          _autoPlay();
        }, 1000);
      };

      var _changeTxt = function _changeTxt(index) {
        var _slideIndex = index ? index : slideIndex;
        var _$txt = $hero.find('.sitetop-hero_txt');
        var _$currentTxt = _$txt.eq(_slideIndex);
        var _$currentTxtMask = _$currentTxt.find('.sitetop-hero_txtmask');
        var _$currentTxtMaskImg = _$currentTxt.find('.sitetop-hero_txtmaskimg');
        var _width = _$currentTxtMask.css('width');
        var _left = _$currentTxtMask.css('left');
        var _adjustLeftValue = -parseFloat(_left, 10) + parseFloat(_width, 10);
        var _nextWidth = void 0;
        var _delay = index ? 20 : 600;

        if (_slideIndex >= slideLength - 1) {
          _slideIndex = -1;
        }

        _nextWidth = _$txt.eq(_slideIndex + 1).find('.sitetop-hero_txtmask').css('width');

        _$currentTxt.addClass('-hide');
        _$txt.eq(_slideIndex + 1).addClass('-next');
        _$txt.eq(_slideIndex + 1).find('.sitetop-hero_txtmask').css({ width: 0 });

        _$currentTxtMask.css({
          width: 0,
          left: _adjustLeftValue
        });

        _$currentTxtMaskImg.css({
          left: -_adjustLeftValue
        });

        setTimeout(function () {
          _$currentTxt.removeClass('-active -hide');
          _$currentTxtMask.css({ width: _width });
          _$txt.eq(_slideIndex + 1).removeClass('-next').addClass('-active');
          _$txt.eq(_slideIndex + 1).find('.sitetop-hero_txtmask').css({ width: _nextWidth, left: _left });
          _$txt.eq(_slideIndex + 1).find('.sitetop-hero_txtmaskimg').css({ left: -parseFloat(_left, 10) });

          setTimeout(function () {
            slideAnimationed = false;
          }, 500);
        }, _delay);
      };

      var _changeNavBtnImg = function _changeNavBtnImg() {
        $nextImg.removeAttr('style').css({ width: 0 });

        setTimeout(function () {
          $nextBg.removeAttr('style').addClass('-active');
          $nextThumb.removeClass('-active');
          $nextThumb.eq(slideIndex).addClass('-active');
          $nextImg.css({ width: '100%', 'transition': '0s' });

          $nextBg.css({
            width: 0
          });

          setTimeout(function () {
            $nextBg.removeClass('-active').css({
              width: '100%',
              'transition': '0s'
            });
          }, 500);
        }, 600);
      };

      var _setMaskValue = function _setMaskValue() {
        _resetMaskValue();

        $maskImg.each(function () {
          var _width = $(this).width();
          var _height = $(this).height();
          var _$parentMaskElement = $(this).parents('.js-carouselmask');
          var _skewAdjustValue1 = $(this).css('left');
          var _skewAdjustValue2 = _$parentMaskElement.css('left');
          var _titleWidth = $(this).find('.sitetop-hero_title span').width();
          var _leadWidth = $(this).find('.sitetop-hero_lead span').width();
          var _maxTxtWidth = Math.max(_titleWidth, _leadWidth);

          $(this).css({
            width: _width,
            height: _height,
            left: _skewAdjustValue1
          });

          if (_maxTxtWidth) {
            _$parentMaskElement.css({
              left: _skewAdjustValue2,
              width: _maxTxtWidth + parseFloat(_skewAdjustValue1)
            });
          } else {
            _$parentMaskElement.css({
              left: _skewAdjustValue2
            });
          }
        });
      };

      var _resetMaskValue = function _resetMaskValue() {
        $maskImg.each(function () {
          var _$parentMaskElement = $(this).parents('.js-carouselmask');
          $(this).add(_$parentMaskElement).removeAttr('style');
        });
      };

      var _setPagination = function _setPagination() {
        var _slideIndex = slideIndex;
        $pagination.find('em').text(('00' + (_slideIndex + 1)).slice(-2));
        $pagination.find('small').text(('00' + slideLength).slice(-2));
      };

      var _changePagination = function _changePagination() {
        var _slideIndex = slideIndex;
        $pagination.find('em').text(('00' + (_slideIndex + 1)).slice(-2));
      };

      var _updateSlideIndex = function _updateSlideIndex() {
        if (slideIndex < slideLength - 1) {
          slideIndex++;
        } else {
          slideIndex = 0;
        }
      };

      var _setProgressbar = function _setProgressbar() {
        $progressbar.removeClass('-active');
        setTimeout(function () {
          $progressbar.addClass('-active');
        }, 20);
      };

      var _autoPlay = function _autoPlay() {
        clearTimeout(slideTimer);
        _setProgressbar();

        slideTimer = setTimeout(function () {
          $nextBtn.trigger('click');
          _autoPlay();
        }, timerInterval);
      };

      var _pauseAutoPlay = function _pauseAutoPlay() {
        clearTimeout(slideTimer);
        $progressbar.removeClass('-active');
      };

      var _pixiInit = function _pixiInit() {
        var _$images = $('.sitetop-hero_img');
        var _$thumbnail = $('#sitetop-hero_nav').find('.sitetop-next_thumbinner');
        var _$canvas = $('#sitetop-hero_canvas');
        var _baseWidth = 990 * 2;
        var _baseHeight = 594 * 2;
        var _cvWidth = _$canvas.width();
        var _cvHeight = _$canvas.height();
        var _cvRatio = _cvWidth / _cvHeight;
        var _current = 0;
        var _imageArray = [];
        var _lineArray = [];
        var _app = new PIXI.Application({
          width: _cvWidth,
          height: _cvHeight,
          antialias: true,
          transparent: true,
          autoResize: true,
          resolution: window.devicePixelRatio || 1
        });

        var _container = new PIXI.Container();
        var _imegesCt = new PIXI.Container();
        var _lineMsk = new PIXI.Container();
        var _stageMsk = new PIXI.Graphics();

        var method = {
          start: function start() {
            return _start();
          },
          next: function next(num) {
            return _next(num);
          }
        };

        _$canvas.append(_app.view);

        _app.stage.addChild(_container);
        _container.addChild(_imegesCt);
        _container.addChild(_lineMsk);

        window.onresize = function () {
          _resize();
        };
        mq.addListener(_responsiveImage);
        _load();

        function _load() {
          var loader = PIXI.Loader.shared;

          for (var i = 0; i < _$images.length; i++) {
            var sp = $(_$images[i]).find('img').attr('src');
            var pc = $(_$images[i]).find('source').attr('srcset');
            var srcBase = 'img_' + (i + 1);
            loader.add(srcBase + '_sp', sp);
            loader.add(srcBase + '_pc', pc);
          }

          for (var i2 = 0; i2 < _$thumbnail.length; i2++) {
            var thumb = $(_$thumbnail[i2]).find('img').attr('src');
            loader.add(thumb);
          }

          loader.load(function (loader, resources) {
            var sprites = {};
            for (var _i in resources) {
              sprites[_i] = new PIXI.TilingSprite(resources[_i].texture);
              var width = resources[_i].texture.orig.width;
              var height = resources[_i].texture.orig.height;
              sprites[_i].width = width;
              sprites[_i].height = height;
              sprites[_i].anchor.set(0.5);
            }

            for (var i = 0; i < _$images.length; i++) {
              var images = new PIXI.Container();
              var _srcBase = 'img_' + (i + 1);
              var _sp = sprites[_srcBase + '_sp'];
              var _pc = sprites[_srcBase + '_pc'];
              images.alpha = 0;
              images.addChild(_sp);
              images.addChild(_pc);
              _imegesCt.addChild(images);
              _imageArray.push({ images: images, sp: _sp, pc: _pc });
            }
            _loadComplete();
          });
        }
        function _loadComplete() {
          _createMask();
          _responsiveImage(mq);
          _resize();
          _eventDispatch();
        }

        function _reDrawStageMask() {
          var _deg = 17.3;
          var _rad = _deg * (Math.PI / 180);
          var _offset = _baseHeight - Math.cos(_rad) * _baseHeight;
          var _offHeight = _baseHeight + _offset;
          _stageMsk.beginFill(0x6600);
          _stageMsk.moveTo(0, 0);
          _stageMsk.lineTo(_baseWidth, 0);
          _stageMsk.lineTo(_baseWidth, _offHeight);
          _stageMsk.lineTo(0, _offHeight);
          _stageMsk.endFill();

          _stageMsk.x = -_baseWidth / 2 + Math.tan(_rad) * _baseHeight;
          _stageMsk.y = -_baseHeight / 2;
          _stageMsk.skew.x = -_rad;
        }
        function _setLineMask(msks, num) {
          var _lineMsk = new PIXI.Graphics();
          msks[num].sprite = _lineMsk;
          _reDrawLineMask(_lineMsk, num, msks);
          return _lineMsk;
        }
        function _reDrawLineMask(target, num, msks, isCurrent) {
          var _deg = 17.3;
          var _rad = _deg * (Math.PI / 180);
          var _lineHeight = (_baseHeight + 10) / 5;
          var _offset = _lineHeight - Math.cos(_rad) * _lineHeight;
          var _offHeight = _lineHeight + _offset;
          var _lineX = mq.matches ? [146, 109, 71, 34, -3] : [168, 125, 82, 39, -4];

          var tx = -_baseWidth / 2 + Math.tan(_rad) * _lineHeight + _lineX[num];
          var fx = _baseWidth / 2 + Math.tan(_rad) * _lineHeight + 10;
          var fy = -_baseHeight / 2 + Math.floor(_lineHeight) * num;

          target.beginFill(0xFF6600);
          target.moveTo(0, 0);
          target.lineTo(_baseWidth, 0);
          target.lineTo(_baseWidth, _offHeight);
          target.lineTo(0, _offHeight);
          target.endFill();

          if (isCurrent) {
            target.x = tx;
          } else {
            target.x = fx;
          }
          target.y = fy;

          target.skew.x = -_rad;

          msks[num].tx = tx;
          msks[num].fx = fx;
          msks[num].fy = fy;
        }

        function _createMask() {
          _reDrawStageMask();
          _container.mask = _stageMsk;
          _container.addChild(_stageMsk);
          for (var k = 0; k < _$images.length; k++) {
            var msksCt = new PIXI.Container();
            var msks = [];
            for (var i = 0; i < 5; i++) {
              msks.push({ sprite: null, fx: null, tx: null, fy: null });
              msksCt.addChild(_setLineMask(msks, i));
            }
            _lineArray.push({ sprite: msksCt, msks: msks });
            _lineMsk.addChild(msksCt);
          }
        }
        function _start() {
          TweenMax.fromTo(_imageArray[0].images, 2, { pixi: { autoAlpha: 0 } }, { pixi: { autoAlpha: 1 }, ease: Power2.easeOut });
          TweenMax.fromTo(_imageArray[0].images, 8, { pixi: { scaleX: 1.5, scaleY: 1.5 } }, { pixi: { scaleX: 1, scaleY: 1 }, ease: Power2.easeOut });
        }
        function _next(num) {
          _current = num;
          var _target = _imageArray[num].images;

          _target.mask = _lineArray[num].sprite;
          _imegesCt.addChild(_target);

          TweenMax.fromTo(_target, 9, { pixi: { autoAlpha: 1, scaleX: 1.5, scaleY: 1.5 } }, { pixi: { autoAlpha: 1, scaleX: 1, scaleY: 1 }, ease: Power2.easeOut });
          var delay = 0.05;
          var delays = [1, 3, 0, 3.5, 2];
          for (var i = 0; i < 5; i++) {
            TweenMax.fromTo(_lineArray[num].msks[i].sprite, 1.0, { x: _lineArray[num].msks[i].fx }, { delay: delay * delays[i], x: _lineArray[num].msks[i].tx, ease: Expo.easeOut });
          }
        }

        function _resize() {
          var _scale = 0;
          _cvWidth = _$canvas.width();
          _cvHeight = _$canvas.height();
          _cvRatio = _cvWidth / _cvHeight;

          if (_cvRatio > 1) {
            _scale = _cvWidth / _baseWidth;
          } else {
            _scale = _cvHeight / _baseHeight;
          }
          _container.position.set(_cvWidth / 2, _cvHeight / 2);
          _container.scale.set(_scale, _scale);
          _app.renderer.resize(_cvWidth, _cvHeight);
        }
        function _responsiveImage(e) {
          if (e.matches) {
            _baseWidth = 990 * 2;
            _baseHeight = 594 * 2;
          } else {
            _baseWidth = 492 * 1.5;
            _baseHeight = 684 * 1.5;
          }
          _reDrawStageMask();
          for (var k = 0; k < _$images.length; k++) {
            for (var i = 0; i < 5; i++) {
              if (_current === k) {
                _reDrawLineMask(_lineArray[k].msks[i].sprite, i, _lineArray[k].msks, true);
              } else {
                _reDrawLineMask(_lineArray[k].msks[i].sprite, i, _lineArray[k].msks, false);
              }
            }
          }

          for (var _i2 = 0; _i2 < _imageArray.length; _i2++) {
            if (e.matches) {
              _imageArray[_i2].sp.visible = false;
              _imageArray[_i2].pc.visible = true;
            } else {
              _imageArray[_i2].sp.visible = true;
              _imageArray[_i2].pc.visible = false;
            }
          }
        }
        function _eventDispatch() {
          var detail = {};
          var event;
          try {
            event = new CustomEvent('PIXI_LOADED', { detail: detail });
          } catch (e) {
            event = document.createEvent('CustomEvent');
            event.initCustomEvent('PIXI_LOADED', false, false, detail);
          }
          window.dispatchEvent(event);
        }
        return method;
      };

      return {
        init: _init
      };
    }();

    return {
      init: _init
    };
  }();

  GA.top.init();
})(jQuery);