document.addEventListener('DOMContentLoaded', function () {
    // Initialize all animations and interactions
    initScrollAnimations();
    initMobileMenu();
    initCalculator();
    initModal();
    initFormHandlers();
    initLazyLoading();
    initParallax();
    initEnhancedAnimations();
    blackWhite(); //тема черно белый
    btnUpeer(); //кнопка при нажатие переходить вверх 

    // Initialize intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(animateOnScroll, observerOptions);

    // Observe all elements with animation class
    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

    // опредеояем верхний отступ 
    // const heig = document.querySelector('header').clientHeight;
    // const main = document.querySelectorAll('.paddingTop');
    // main.forEach(item => item.style.paddingTop = heig + 20 + "px");

    //  тестовый вариянт 
    // changeParent.appendChild(btnThemes);
    // если ширина окна меньше чем 768px то кнопка поменяет своего родителя 
    window.addEventListener('resize', resize);
    function resize() {

        const secondParent = document.querySelector('.nav-menu > ul');
        const originParent = document.querySelector('.social-links');
        const btnThemes = document.querySelector('.testBtn');

        if (window.innerWidth <= 768) {
            secondParent.appendChild(btnThemes)
        } else {
            originParent.appendChild(btnThemes)
        }
    }
    resize()

});

function btnUpeer() {
    const btnUP = document.getElementById('btnUpper');
    btnUP.onclick = () => document.getElementById('hero').scrollIntoView({ behavior: 'smooth' });
    window.onscroll = () => btnUP.classList.toggle('hidden', window.scrollY > 650);
}

// theme black or white 
function blackWhite() {

    const btnBlc = document.getElementById('blc');

    if (!btnBlc) {
        console.error('Кнопка с ID "blc" не найдена');
    } else {
        // Добавляем слушатель событий
        btnBlc.addEventListener('click', themeDefine);

        // Функция переключения темы
        function themeDefine() {
            // Получаем текущее значение --main_second
            let rootElem = window.getComputedStyle(document.documentElement);
            let setVariable = document.documentElement.style;
            let secClr, secHexClr;

            // allvariable colors
            let colors = {
                prim: '#d4af37',
                second: '#fff',
                second_2: '#e0e0e0',
                second_3: '#f4e8c1',
                yel3: '#ffe699',
                blck: '#0c0b0b',
                blck_2: '#1a1a1a',
                blck_3: '#252525'
            };

            let colorsSec = {
                prim: '#f0b411ff',
                second: '#0c0b0b',
                second_2: '#1a1a1a',
                second_3: '#ffa704ff',
                yel3: '#ffe699',
                blck: '#fcfcfc',
                blck_2: '#ccccccff',
                blck_3: '#e2e0e0ff'
            };

            // преоброзавать формат цвета hex на rgb 
            function hextorgb(clr) {

                // удалить из формата hex # если оно есть 
                let hexValue = clr.startsWith('#') ? clr.slice(1) : clr;

                // определение цветов 
                let red = parseInt(hexValue.substring(0, 2), 16);
                let green = parseInt(hexValue.substring(2, 4), 16);
                let blue = parseInt(hexValue.substring(4, 6), 16);

                // Use isNaN() to correctly check for NaN values
                let finalRed = isNaN(red) ? 0 : red;
                let finalGreen = isNaN(green) ? 0 : green;
                let finalBlue = isNaN(blue) ? 0 : blue;

                // Create the final string without reassigning variables
                let readyColor = `${finalRed}, ${finalGreen}, ${finalBlue}`;
                return readyColor;
            }

            for (let [color, value] of Object.entries(colors)) {

                // преоброзовать тексть --main_red
                let frstClr = `--main_${color}`
                let frstHexClr = `--main_hex_${color}`

                // определение начального цвета
                let currentColor = rootElem.getPropertyValue(frstClr).trim();
                let currentHexColor = rootElem.getPropertyValue(frstHexClr).trim();

                // условие цветами если 1 то 0 ; если 0 то 1
                secClr = (currentColor === value) ? colorsSec[color] : value;
                secHexClr = (currentHexColor === hextorgb(value)) ? hextorgb(colorsSec[color]) : hextorgb(value);

                // устанавливаем переменного цвета 
                setVariable.setProperty(frstClr, secClr);
                setVariable.setProperty(frstHexClr, secHexClr);
            }
        }
    }
}

// Scroll animations
function initScrollAnimations() {
    // Add animation classes to elements
    const elementsToAnimate = [
        '.advantage-item',
        '.bank-logo',
        '.house-item',
        '.tech-item',
        '.supplier-logo'
    ];
    elementsToAnimate.forEach(selector => {
        document.querySelectorAll(selector).forEach((el, index) => {
            el.classList.add('animate-on-scroll');
            el.style.animationDelay = `${index * 0.1}s`;
        });
    });
}

// Enhanced animations for dynamic elements
function initEnhancedAnimations() {
    // Add bounce animation to logo icon
    const logoIcon = document.querySelector('.logo-icon');
    if (logoIcon) {
        logoIcon.addEventListener('mouseenter', function () {
            this.style.animation = 'bounce 0.5s ease';
            setTimeout(() => {
                this.style.animation = 'float 3s ease-in-out infinite';
            }, 500);
        });
    }

    // Add shake animation to buttons on hover
    const buttons = document.querySelectorAll('.btn, #btnUpper');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function () {
            this.classList.add('shake');
            setTimeout(() => {
                this.classList.remove('shake');
            }, 800);
        });
    });

    // Add rotate animation to bank icons
    const bankIcons = document.querySelectorAll('.bank-icon i');
    bankIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function () {
            this.style.animation = 'rotateIn 0.5s ease';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });
    });

    // Add bounce animation to supplier icons
    const supplierIcons = document.querySelectorAll('.supplier-icon i');
    supplierIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function () {
            this.style.animation = 'bounceIn 0.5s ease';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });
    });

    // Add swing animation to company logo
    const companyLogo = document.querySelector('.company-logo-animated');
    if (companyLogo) {
        companyLogo.addEventListener('mouseenter', function () {
            this.style.animation = 'swing 1s ease-in-out';
            setTimeout(() => {
                this.style.animation = 'float 3s ease-in-out infinite';
            }, 1000);
        });
    }

    // Add random animations to tech items
    const techItems = document.querySelectorAll('.tech-item');
    const animations = ['bounceIn', 'rotateIn', 'fadeIn', 'slideUp'];
    techItems.forEach(item => {
        item.addEventListener('mouseenter', function () {
            const randomAnim = animations[Math.floor(Math.random() * animations.length)];
            this.style.animation = `${randomAnim} 0.5s ease`;
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });
    });

    // Add continuous pulse to project title
    const projectTitle = document.querySelector('.project-title');
    if (projectTitle) {
        projectTitle.classList.add('pulse');
    }

    // Add hover effect to floor buttons
    const floorButtons = document.querySelectorAll('.floor-btn');
    floorButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function () {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateX(5px)';
            }
        });

        btn.addEventListener('mouseleave', function () {
            if (!this.classList.contains('active')) {
                this.style.transform = '';
            }
        });
    });
}

function animateOnScroll(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animated');
            // Add stagger effect for grouped elements
            const siblings = entry.target.parentElement.children;
            Array.from(siblings).forEach((sibling, index) => {
                if (sibling.classList.contains('animate-on-scroll')) {
                    setTimeout(() => {
                        sibling.classList.add('animated');
                    }, index * 100);
                }
            });
        }
    });
}

// Mobile menu
function initMobileMenu() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function () {
            mobileToggle.classList.toggle('active');
            navMenu.classList.toggle('active');

            // Animate toggle button
            const spans = mobileToggle.querySelectorAll('span');
            if (mobileToggle.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                spans.forEach(span => {
                    span.style.transform = '';
                    span.style.opacity = '';
                });
            }
        });

        // Close menu when clicking on a link
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
}

// Calculator functionality
function initCalculator() {
    // Simple calculator
    const floorOptions = document.querySelectorAll('input[name="floors"]');
    floorOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Add visual feedback
            const card = this.closest('.option-card');
            document.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');

            // Animate selection
            card.style.transform = 'scale(1.05)';
            setTimeout(() => {
                card.style.transform = '';
            }, 200);
        });
    });

    // Advanced calculator - Amethyst style
    initAmethystCalculator();
}

   function initAmethystCalculator() {

        // кнопки с лева 
        const projectButtons = document.querySelectorAll('.floor-btn');

        // мини картинки 
        const variantImages = document.querySelectorAll('.variant-image');

        // центральные картинки 
        const mainImage = document.getElementById('main-house-image');
        const planImage = document.getElementById('house-plan-image');

        // временно отключил  
        const projectName = document.getElementById('project-name');
        const projectDescription = document.getElementById('project-description');

        // другая страница  
        const h3 = document.getElementById('project-info__h3');
        const h32 = document.getElementById('project-info__h32');
        if (h3 && h32) {
            var cur = h3.innerText;
            var cur2 = h32.innerText;
        }

        // переменные определены в файле our_project
        // текстовый контент 
        const specArea = document.getElementById('specs-area');
        const specEntrance = document.getElementById('spec-entrance');
        const specBoiler = document.getElementById('spec-boiler');
        const specBedrooms = document.getElementById('spec-bedrooms');
        const specBathrooms = document.getElementById('spec-bathrooms');
        const specKitchen = document.getElementById('spec-kitchen');

        const projectData = {};
    
        key.forEach((projKey, index) => {
            projectData[projKey] = {
                name: btn_name[index],
                mainImage: main_img[index],
                planImage: plan_img[index],
                variants: myVariants[index] || [],  // Массив вариантов для этого проекта
                specs: {
                    area: textCon[index]['area'],
                    entrance: textCon[index]['entrance'],
                    boiler: textCon[index]['boiler'],
                    bedrooms: textCon[index]['bedrooms'],
                    bathrooms: textCon[index]['bathrooms'],
                    kitchen: textCon[index]['kitchen']
                }
            };
        })

        function updateProjectContent(projectKey) {
            const project = projectData[projectKey];
            if (project) {
                // Update project name and description
                projectName.textContent = project.name;
                projectDescription.textContent = project.description;

                // проверка 
                if (h3 && h32) {
                    h3.textContent = cur + "  " + project.name;
                    h32.textContent = cur2 + " для проекта " + project.name;
                }

                // Update main and plan images with fade effect
                mainImage.style.opacity = '0';
                planImage.style.opacity = '0';

                setTimeout(() => {
                    mainImage.src = project.mainImage;
                    mainImage.style.transition = 'opacity 0.5s ease';
                    mainImage.style.opacity = '1';

                    planImage.src = project.planImage;
                    planImage.style.transition = 'opacity 0.5s ease';
                    planImage.style.opacity = '1';
                }, 300);

                specArea.innerHTML = project.specs.area + '<sup></sup>';
                specEntrance.textContent = project.specs.entrance;
                specBoiler.textContent = project.specs.boiler;
                specBedrooms.textContent = project.specs.bedrooms;
                specBathrooms.textContent = project.specs.bathrooms;
                specKitchen.textContent = project.specs.kitchen;

                // const variants = projectData.variants[projectKey];
                variantImages.forEach((variant, index) => {
                    variant.querySelector('img').src = project.variants[index];
                });
            }
        }

        // Project buttons functionality
        projectButtons.forEach(button => {
            button.addEventListener('click', function () {
                const projectKey = this.getAttribute('data-project');

                // Remove active class from all buttons
                projectButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Add click animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);

                // Update project content
                updateProjectContent(projectKey);
            });
        });

        // Variant images functionality
        variantImages.forEach((variant, index) => {
            variant.addEventListener('click', function () {
                // Get active project
                const activeProject = document.querySelector('.floor-btn.active').getAttribute('data-project');
                const projectItem = projectData[activeProject]
                const variants = projectItem.variants

                if (variants && variants[index]) {
                    // Update main image
                    mainImage.style.opacity = '0';
                    setTimeout(() => {
                        mainImage.src = variants[index].replace('w=200&h=150', 'w=600&h=400');
                        mainImage.style.transition = 'opacity 0.3s ease';
                        mainImage.style.opacity = '1';
                    }, 150);
                }

                // Add selection effect
                variantImages.forEach(v => v.style.border = 'none');
                this.style.border = '3px solid #d4af37';
            });

            // Add hover effect
            variant.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.05)';
            });

            variant.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1)';
            });
        });

        // Initialize with first project
        updateProjectContent('ametist');
    }


// Function to open gift form modal
function openGiftForm() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';

        // Change modal title to gift
        const modalTitle = modal.querySelector('h3');
        if (modalTitle) {
            modalTitle.textContent = 'Получить подарок на новоселье';
        }

        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="text"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

// Modal functionality
function initModal() {
    const modal = document.getElementById('contactModal');
    const closeBtn = document.querySelector('.close');

    // Close modal events
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Escape key to close modal
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });
}

function openContactForm() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';

        // Focus on first input
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="text"]');
            if (firstInput) firstInput.focus();
        }, 300);
    }
}

function closeModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function openCalculator() {
    // Smooth scroll to calculator section
    const calculatorSection = document.getElementById('calculator');
    if (calculatorSection) {
        calculatorSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

        // Add highlight effect
        calculatorSection.style.animation = 'pulse 2s ease-in-out';
        setTimeout(() => {
            calculatorSection.style.animation = '';
        }, 2000);
    }
}

// Form handlers
function initFormHandlers() {
    // Gift form
    const giftForm = document.querySelector('.gift-form');
    if (giftForm) {
        giftForm.addEventListener('submit', handleGiftForm);
    }

    // Contact form
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactForm);
    }

    // Phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', formatPhoneNumber);
        input.addEventListener('keydown', handlePhoneKeydown);
    });
}

function formatPhoneNumber(event) {
    let value = event.target.value.replace(/\D/g, '');

    // Russian phone format
    if (value.startsWith('8')) {
        value = '7' + value.slice(1);
    }

    if (value.startsWith('7')) {
        if (value.length >= 11) {
            value = value.slice(0, 11);
        }

        if (value.length >= 1) {
            value = '+7';
            if (event.target.value.replace(/\D/g, '').length > 1) {
                value += ' (' + event.target.value.replace(/\D/g, '').slice(1, 4);
            }
            if (event.target.value.replace(/\D/g, '').length >= 4) {
                value += ') ' + event.target.value.replace(/\D/g, '').slice(4, 7);
            }
            if (event.target.value.replace(/\D/g, '').length >= 7) {
                value += '-' + event.target.value.replace(/\D/g, '').slice(7, 9);
            }
            if (event.target.value.replace(/\D/g, '').length >= 9) {
                value += '-' + event.target.value.replace(/\D/g, '').slice(9, 11);
            }
        }
    }

    event.target.value = value;
}

function handlePhoneKeydown(event) {
    // Allow backspace, delete, tab, escape, enter
    if ([8, 9, 27, 13, 46].indexOf(event.keyCode) !== -1 ||
        // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
        (event.keyCode === 65 && event.ctrlKey === true) ||
        (event.keyCode === 67 && event.ctrlKey === true) ||
        (event.keyCode === 86 && event.ctrlKey === true) ||
        (event.keyCode === 88 && event.ctrlKey === true)) {
        return;
    }

    // Ensure that it is a number and stop the keypress
    if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) &&
        (event.keyCode < 96 || event.keyCode > 105)) {
        event.preventDefault();
    }
}

function handleGiftForm(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const submitBtn = event.target.querySelector('.btn-gift');
    const originalText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Отправка...';
    submitBtn.disabled = true;

    // Simulate form submission
    fetch('process-form.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Спасибо! Мы свяжемся с вами в ближайшее время.', 'success');
                event.target.reset();
            } else {
                showNotification('Произошла ошибка. Попробуйте еще раз.', 'error');
            }
        })
        .catch(error => {
            showNotification('Произошла ошибка. Попробуйте еще раз.', 'error');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
}

function handleContactForm(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const submitBtn = event.target.querySelector('.btn-primary');
    const originalText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Отправка...';
    submitBtn.disabled = true;

    // Simulate form submission
    fetch('process-form.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Спасибо! Мы свяжемся с вами в ближайшее время.', 'success');
                event.target.reset();
                closeModal();
            } else {
                showNotification('Произошла ошибка. Попробуйте еще раз.', 'error');
            }
        })
        .catch(error => {
            showNotification('Произошла ошибка. Попробуйте еще раз.', 'error');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
}

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existing = document.querySelector('.notification');
    if (existing) {
        existing.remove();
    }

    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;

    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 3000;
        background: ${type === 'success' ? '#4CAF50' : '#f44336'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: slideInRight 0.3s ease-out;
        max-width: 400px;
    `;

    document.body.appendChild(notification);

    // Close button
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    });

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

// Lazy loading for images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Parallax effect
function initParallax() {
    const parallaxElements = document.querySelectorAll('.hero-image');

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;

        parallaxElements.forEach(element => {
            element.style.transform = `translateY(${rate}px)`;
        });
    });
}

// Gallery lightbox
function initGallery() {
    const galleryItems = document.querySelectorAll('.house-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', function () {
            openLightbox(this.src, this.alt);
        });
    });
}

function openLightbox(src, alt) {
    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    lightbox.innerHTML = `
        <div class="lightbox-content">
            <img src="${src}" alt="${alt}">
            <button class="lightbox-close">&times;</button>
        </div>
    `;

    lightbox.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        z-index: 3000;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    `;

    document.body.appendChild(lightbox);

    // Close events
    const closeBtn = lightbox.querySelector('.lightbox-close');
    closeBtn.addEventListener('click', () => closeLightbox(lightbox));

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox(lightbox);
        }
    });

    document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') {
            closeLightbox(lightbox);
            document.removeEventListener('keydown', escHandler);
        }
    });
}

function closeLightbox(lightbox) {
    lightbox.style.animation = 'fadeOut 0.3s ease-out';
    setTimeout(() => lightbox.remove(), 300);
}

// Smooth reveal animations
function revealOnScroll() {
    const reveals = document.querySelectorAll('.reveal');

    reveals.forEach(element => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
            element.classList.add('active');
        }
    });
}

// Counter animation
function animateCounters() {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target;
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current);
            }
        }, 16);
    });
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }
    
    .lightbox-content img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    
    .lightbox-close {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
        padding: 10px;
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .notification-close {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        margin-left: auto;
        padding: 0 5px;
    }
    
    @media (max-width: 768px) {
        .nav-menu.active {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba( var(--main_hex_blck), 0.98);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(var(--main_hex_prim), 0.2);
            animation: slideDown 0.3s ease-out;
        }
        
        .nav-menu.active ul {
            flex-direction: column;
            padding: 1rem 0;
            align-items:center;
        }
        
        .nav-menu.active li {
            text-align: center;
            padding: 0.5rem 0;
        }
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;

document.head.appendChild(style);

// Initialize gallery after DOM is loaded
document.addEventListener('DOMContentLoaded', initGallery);

// Function to show next project
function showNextProject() {
    const projectButtons = document.querySelectorAll('.floor-btn');
    const currentIndex = Array.from(projectButtons).findIndex(btn => btn.classList.contains('active'));
    const nextIndex = (currentIndex + 1) % projectButtons.length;

    projectButtons[nextIndex].click();
}

// Function to calculate house cost
function calculateHouseCost() {
    // Get form values
    const area = parseFloat(document.getElementById('houseArea').value) || 0;
    const floors = parseFloat(document.getElementById('floorCount').value) || 0;
    const material = document.getElementById('buildingMaterial').value;
    const foundation = document.getElementById('foundationType').value;

    // Base cost per square meter
    let costPerSquareMeter = 0;

    // Material costs
    switch (material) {
        case 'brick':
            costPerSquareMeter = 60000;
            break;
        case 'gasConcrete':
            costPerSquareMeter = 50000;
            break;
        case 'wood':
            costPerSquareMeter = 40000;
            break;
        default:
            costPerSquareMeter = 55000;
    }

    // Foundation costs
    let foundationCost = 0;
    switch (foundation) {
        case 'strip':
            foundationCost = 200000;
            break;
        case 'pile':
            foundationCost = 300000;
            break;
        case 'slab':
            foundationCost = 250000;
            break;
        default:
            foundationCost = 200000;
    }

    // Calculate total cost
    const totalCost = (area * floors * costPerSquareMeter) + foundationCost;

    // Display result
    document.getElementById('calculationResult').innerHTML = `
        <h3>Расчет стоимости строительства</h3>
        <p>Площадь дома: ${area} м²</p>
        <p>Количество этажей: ${floors}</p>
        <p>Материал стен: ${material === 'brick' ? 'Кирпич' : material === 'gasConcrete' ? 'Газобетон' : 'Дерево'}</p>
        <p>Тип фундамента: ${foundation === 'strip' ? 'Ленточный' : foundation === 'pile' ? 'Свайный' : 'Монолитная плита'}</p>
        <p class="total-cost">Общая стоимость: ${totalCost.toLocaleString()} руб.</p>
    `;

    // Show result section
    document.getElementById('calculationResult').style.display = 'block';
}
