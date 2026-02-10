(function(window, document, $) {

    "use strict";

    function revealMenu($scope,$) {

        // Map number x from range [a, b] to [c, d]
        const map = (x, a, b, c, d) => (x - a) * (d - c) / (b - a) + c;

        // Linear interpolation
        const lerp = (a, b, n) => (1 - n) * a + n * b;

        const clamp = (num, min, max) => num <= min ? min : num >= max ? max : num;

        // Gets the mouse position
        const getMousePos = (e) => {
            let posx = 0;
            let posy = 0;
            if (!e) e = window.event;
            if (e.pageX || e.pageY) {
                posx = e.pageX;
                posy = e.pageY;
            }
            else if (e.clientX || e.clientY)    {
                posx = e.clientX + body.scrollLeft + document.documentElement.scrollLeft;
                posy = e.clientY + body.scrollTop + document.documentElement.scrollTop;
            }

            return { x : posx, y : posy }
        };

        // Track the mouse position
        let mouse = {x: 0, y: 0};
        window.addEventListener('mousemove', ev => mouse = getMousePos(ev));

        class Cursor {
            constructor(el) {
                this.DOM = {el: el};
                this.DOM.el.style.opacity = 0;

                this.bounds = this.DOM.el.getBoundingClientRect();

                this.renderedStyles = {
                    tx: {previous: 0, current: 0, amt: 0.2},
                    ty: {previous: 0, current: 0, amt: 0.2}
                };

                this.onMouseMoveEv = () => {
                    this.renderedStyles.tx.previous = this.renderedStyles.tx.current = mouse.x - this.bounds.width/2;
                    this.renderedStyles.ty.previous = this.renderedStyles.ty.previous = mouse.y - this.bounds.height/2;
                    gsap.to(this.DOM.el, {duration: 0.9, ease: 'Power3.easeOut', opacity: 1});
                    requestAnimationFrame(() => this.render());
                    window.removeEventListener('mousemove', this.onMouseMoveEv);
                };
                window.addEventListener('mousemove', this.onMouseMoveEv);
            }
            render() {
                this.renderedStyles['tx'].current = mouse.x - this.bounds.width/2;
                this.renderedStyles['ty'].current = mouse.y - this.bounds.height/2;

                for (const key in this.renderedStyles ) {
                    this.renderedStyles[key].previous = lerp(this.renderedStyles[key].previous, this.renderedStyles[key].current, this.renderedStyles[key].amt);
                }

                this.DOM.el.style.transform = `translateX(${(this.renderedStyles['tx'].previous)}px) translateY(${this.renderedStyles['ty'].previous}px)`;

                requestAnimationFrame(() => this.render());
            }
        }


        const body = document.body;
        const preloader = selector => {
            return new Promise(resolve => {

                const imgwrap = document.createElement('div');
                imgwrap.style.visibility = 'hidden';
                body.appendChild(imgwrap);

                [...document.querySelectorAll(selector)].forEach(el => {
                    const imgEl = document.createElement('img');
                    imgEl.style.width = 0;
                    imgEl.src = el.dataset.img;
                    imgEl.className = 'preload';
                    imgwrap.appendChild(imgEl);
                });

                imagesLoaded(document.querySelectorAll('.preload'), () => {
                    imgwrap.parentNode.removeChild(imgwrap);
                    body.classList.remove('loading');
                    resolve();
                });

            });
        };
        var images = [];

        document.querySelectorAll('.menu__item').forEach(function (item) {
            images.push( item.getAttribute("data-img") );
        });
        //images = tempData;

        // track the mouse position
        let mousepos = {x: 0, y: 0};
        // cache the mouse position
        let mousePosCache = mousepos;
        let direction = {x: mousePosCache.x-mousepos.x, y: mousePosCache.y-mousepos.y};

        // update mouse position when moving the mouse
        window.addEventListener('mousemove', ev => mousepos = getMousePos(ev));

        class MenuItem {
            constructor(el, inMenuPosition, animatableProperties) {
                // el is the <a> with class "menu__item"
                this.DOM = {el: el};
                // position in the Menu
                this.inMenuPosition = inMenuPosition;
                // menu item properties that will animate as we move the mouse around the menu
                this.animatableProperties = animatableProperties;
                // the item text
                this.DOM.textInner = this.DOM.el.querySelector('.menu__item-textinner');
                // create the image structure
                this.layout();
                // initialize some events
                this.initEvents();
            }
            // create the image structure
            // we want to add/append to the menu item the following html:
            // <div class="hover-reveal">
            //   <div class="hover-reveal__inner" style="overflow: hidden;">
            //     <div class="hover-reveal__img" style="background-image: url(pathToImage);">
            //     </div>
            //   </div>
            // </div>
            layout() {
                // this is the element that gets its position animated (and perhaps other properties like the rotation etc..)
                this.DOM.reveal = document.createElement('div');
                this.DOM.reveal.className = 'hover-reveal';
                // the next two elements could actually be only one, the image element
                // adding an extra wrapper (revealInner) around the image element with overflow hidden, gives us the possibility to scale the image inside
                this.DOM.revealInner = document.createElement('div');
                this.DOM.revealInner.className = 'hover-reveal__inner';
                this.DOM.revealImage = document.createElement('div');
                this.DOM.revealImage.className = 'hover-reveal__img';
                this.DOM.revealImage.style.backgroundImage = `url(${images[this.inMenuPosition]})`;

                this.DOM.revealInner.appendChild(this.DOM.revealImage);
                this.DOM.reveal.appendChild(this.DOM.revealInner);
                this.DOM.el.appendChild(this.DOM.reveal);
            }
            // calculate the position/size of both the menu item and reveal element
            calcBounds() {
                this.bounds = {
                    el: this.DOM.el.getBoundingClientRect(),
                    reveal: this.DOM.reveal.getBoundingClientRect()
                };
            }
            // bind some events
            initEvents() {
                this.mouseenterFn = (ev) => {
                    // show the image element
                    this.showImage();
                    this.firstRAFCycle = true;
                    // start the render loop animation (rAF)
                    this.loopRender();
                };
                this.mouseleaveFn = () => {
                    // stop the render loop animation (rAF)
                    this.stopRendering();
                    // hide the image element
                    this.hideImage();
                };

                this.DOM.el.addEventListener('mouseenter', this.mouseenterFn);
                this.DOM.el.addEventListener('mouseleave', this.mouseleaveFn);
            }
            // show the image element
            showImage() {
                // kill any current tweens
                gsap.killTweensOf(this.DOM.revealInner);
                gsap.killTweensOf(this.DOM.revealImage);

                this.tl = gsap.timeline({
                    onStart: () => {
                        // show the image element
                        this.DOM.reveal.style.opacity = 1;
                        // set a high z-index value so image appears on top of other elements
                        gsap.set(this.DOM.el, {zIndex: images.length});
                    }
                })
                // animate the image wrap
                .to(this.DOM.revealInner, 0.2, {
                    ease: 'Sine.easeOut',
                    startAt: {x: direction.x < 0 ? '-100%' : '100%'},
                    x: '0%'
                })
                // animate the image element
                .to(this.DOM.revealImage, 0.2, {
                    ease: 'Sine.easeOut',
                    startAt: {x: direction.x < 0 ? '100%': '-100%'},
                    x: '0%'
                }, 0);
            }
            // hide the image element
            hideImage() {
                // kill any current tweens
                gsap.killTweensOf(this.DOM.revealInner);
                gsap.killTweensOf(this.DOM.revealImage);

                this.tl = gsap.timeline({
                    onStart: () => {
                        gsap.set(this.DOM.el, {zIndex: 1});
                    },
                    onComplete: () => {
                        gsap.set(this.DOM.reveal, {opacity: 0});
                    }
                })
                .to(this.DOM.revealInner, 0.2, {
                    ease: 'Sine.easeOut',
                    x: direction.x < 0 ? '100%' : '-100%'
                })
                .to(this.DOM.revealImage, 0.2, {
                    ease: 'Sine.easeOut',
                    x: direction.x < 0 ? '-100%' : '100%'
                }, 0);
            }
            // start the render loop animation (rAF)
            loopRender() {
                if ( !this.requestId ) {
                    this.requestId = requestAnimationFrame(() => this.render());
                }
            }
            // stop the render loop animation (rAF)
            stopRendering() {
                if ( this.requestId ) {
                    window.cancelAnimationFrame(this.requestId);
                    this.requestId = undefined;
                }
            }
            // translate the item as the mouse moves
            render() {
                this.requestId = undefined;
                // calculate position/sizes the first time
                if ( this.firstRAFCycle ) {
                    this.calcBounds();
                }

                // calculate the mouse distance (current vs previous cycle)
                const mouseDistanceX = clamp(Math.abs(mousePosCache.x - mousepos.x), 0, 100);
                // direction where the mouse is moving
                direction = {x: mousePosCache.x-mousepos.x, y: mousePosCache.y-mousepos.y};
                // updated cache values
                mousePosCache = {x: mousepos.x, y: mousepos.y};

                // new translation values
                // the center of the image element is positioned where the mouse is
                this.animatableProperties.tx.current = Math.abs(mousepos.x - this.bounds.el.left) - this.bounds.reveal.width/2;
                this.animatableProperties.ty.current = Math.abs(mousepos.y - this.bounds.el.top) - this.bounds.reveal.height/2;
                // new rotation value
                this.animatableProperties.rotation.current = this.firstRAFCycle ? 0 : map(mouseDistanceX,0,100,0,direction.x < 0 ? 60 : -60);
                // new filter value
                this.animatableProperties.brightness.current = this.firstRAFCycle ? 1 : map(mouseDistanceX,0,100,1,4);

                // set up the interpolated values
                // for the first cycle, both the interpolated values need to be the same so there's no "lerped" animation between the previous and current state
                this.animatableProperties.tx.previous = this.firstRAFCycle ? this.animatableProperties.tx.current : lerp(this.animatableProperties.tx.previous, this.animatableProperties.tx.current, this.animatableProperties.tx.amt);
                this.animatableProperties.ty.previous = this.firstRAFCycle ? this.animatableProperties.ty.current : lerp(this.animatableProperties.ty.previous, this.animatableProperties.ty.current, this.animatableProperties.ty.amt);
                this.animatableProperties.rotation.previous = this.firstRAFCycle ? this.animatableProperties.rotation.current : lerp(this.animatableProperties.rotation.previous, this.animatableProperties.rotation.current, this.animatableProperties.rotation.amt);
                this.animatableProperties.brightness.previous = this.firstRAFCycle ? this.animatableProperties.brightness.current : lerp(this.animatableProperties.brightness.previous, this.animatableProperties.brightness.current, this.animatableProperties.brightness.amt);

                // set styles
                gsap.set(this.DOM.reveal, {
                    x: this.animatableProperties.tx.previous,
                    y: this.animatableProperties.ty.previous,
                    rotation: this.animatableProperties.rotation.previous,
                    filter: `brightness(${this.animatableProperties.brightness.previous})`
                });

                // loop
                this.firstRAFCycle = false;
                this.loopRender();
            }
        }

        class Menu {
            constructor(el) {
                // el is the menu element (<nav>)
                this.DOM = {el: el};
                // the menu item elements (<a>)
                this.DOM.menuItems = this.DOM.el.querySelectorAll('.menu__item');
                // menu item properties that will animate as we move the mouse around the menu
                // we will be using interpolation to achieve smooth animations.
                // the “previous” and “current” values are the values to interpolate.
                // the value applied to the element, this case the image element (this.DOM.reveal) will be a value between these two values at a specific increment.
                // the amt is the amount to interpolate.
                this.animatableProperties = {
                    // translationX
                    tx: {previous: 0, current: 0, amt: 0.08},
                    // translationY
                    ty: {previous: 0, current: 0, amt: 0.08},
                    // Rotation angle
                    rotation: {previous: 0, current: 0, amt: 0.08},
                    // CSS filter (brightness) value
                    brightness: {previous: 1, current: 1, amt: 0.08}
                };
                // array of MenuItem instances
                this.menuItems = [];
                // initialize the MenuItems
                [...this.DOM.menuItems].forEach((item, pos) => this.menuItems.push(new MenuItem(item, pos, this.animatableProperties)));
                // show the menu items (initial animation where each menu item gets revealed)
                this.showMenuItems();
            }
            // initial animation for revealing the menu items
            showMenuItems() {
                gsap.to(this.menuItems.map(item => item.DOM.textInner), {
                    duration: 1.2,
                    ease: 'Expo.easeOut',
                    startAt: {y: '100%'},
                    y: 0,
                    delay: pos => pos*0.06
                });
            }
        }

        // menu (<nav> element)
        const menuEl = document.querySelector('.menu');

        // preload the images set as data attrs in the menu items
        preloader('.menu__item').then(() => {
            // initialize the smooth scroll
            //const scroll = new LocomotiveScroll({el: menuEl, smooth: true});

            // initialize custom cursor
            const cursor = new Cursor(document.querySelector('.cursor-menu'));

            // initialize menu
            new Menu(menuEl);
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/agrikon-reveal-menu.default', revealMenu);
    });

})(window, document, jQuery);
