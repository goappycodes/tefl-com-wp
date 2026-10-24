<?php

/**
 * Spin The Wheel Shortcode
 */

function spin_wheel_popup_shortcode($atts) {
    $atts = shortcode_atts(array(
        'form_id' => '98449',
    ), $atts);

    ob_start();
    ?>
    <style>
        .boxzilla.boxzilla-bf-spin-the-wheel{
            width:auto !important;
        }
        .spin-wheel-popup-container {
            background-color: #000;
            background: url('https://teflinstitute.com/wp-content/uploads/2025/11/wheel_background.png') center/cover no-repeat;
            color: white;
            position: relative;
            border: 2px solid red;
        }

        .spin-wheel-popup-container .intl-tel-input .country-list {
            background-color: #000 !important;
        }

        .spin-wheel-content {
            display: flex;
            gap: 60px;
            align-items: center;
            padding: 40px;
            max-width: 1300px;
            margin: 0 auto;
        }
        
        .wheel-section {
            flex: 0 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        /* Deal Wheel Styles */
        .deal-wheel {
            --size: 450px;
            position: relative;
            display: grid;
            align-items: center;
            grid-template-areas: "spinner";
            width: var(--size);
            height: var(--size);
        }
        
        .deal-wheel > * {
            grid-area: spinner;
        }
        
        .wheel-outer-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: calc(var(--size) + 40px);
            height: calc(var(--size) + 40px);
            border: 8px solid white;
            border-radius: 50%;
            z-index: 0;
        }
        
        .spinner {
            position: relative;
            display: grid;
            align-items: center;
            grid-template-areas: "spinner";
            width: var(--size);
            height: var(--size);
            transform: rotate(0deg);
            border-radius: 50%;
            list-style: none;
            margin: 0;
            padding: 0;
            transition: none;
            box-shadow: 0 0 0 15px #d4a745, 0 0 30px rgba(212, 167, 69, 0.5);
        }
        
        .spinner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                from 0deg,
                #8B0000 0deg 45deg,
                #CC0000 45deg 90deg,
                #660000 90deg 135deg,
                #AA0000 135deg 180deg,
                #8B0000 180deg 225deg,
                #CC0000 225deg 270deg,
                #660000 270deg 315deg,
                #AA0000 315deg 360deg
            );
        }
        
        .spinner * {
            grid-area: spinner;
        }
        
        .prize {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            transform-origin: center center;
            transform: rotate(var(--rotate));
            user-select: none;
            z-index: 1;
        }
        
        .prize .text {
            position: absolute;
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            line-height: 1.3;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
            max-width: 100px;
            transform: translateX(calc(var(--size) * 0.3));
            white-space: normal;
            word-wrap: break-word;
        }

        .prize.selected .text {
            color: #d4a745;
        }
        
        .wheel-center {
            position: relative;
            justify-self: center;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #f4d679, #d4a745);
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(212, 167, 69, 0.8), inset 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
        
        .wheel-pointer {
            position: absolute;
            top: 50%;
            right: -50px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 25px solid transparent;
            border-bottom: 25px solid transparent;
            border-left: 45px solid #d4a745;
            filter: drop-shadow(0 3px 8px rgba(0, 0, 0, 0.5));
            z-index: 11;
        }
        
        /* Light bulbs */
        .spinner::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: 
                radial-gradient(circle at 50% 8%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 85% 20%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 92% 50%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 85% 80%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 50% 92%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 15% 80%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 8% 50%, #fff9e6 0%, transparent 3%),
                radial-gradient(circle at 15% 20%, #fff9e6 0%, transparent 3%);
            animation: bulbGlow 2s ease-in-out infinite;
        }
        
        @keyframes bulbGlow {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        /* Spinning animation */
        .is-spinning .spinner {
            transition: transform 5s cubic-bezier(0.17, 0.67, 0.12, 0.99);
        }
        
        @keyframes tick {
            50% {
                transform: rotate(-8deg);
            }
        }
        
        .form-section {
            flex: 1;
            max-width: 500px;
        }
        
        .form-header {
            margin-bottom: 30px;
        }
        
        .form-title {
            font-size: 2.5em;
            color: #d4a745;
            margin: 0 0 15px 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .form-subtitle {
            font-size: 16px;
            color: #d4a745;
            margin: 0;
            line-height: 1.4;
        }
        
        /* Form Styles */
        .spin-wheel-form .wpcf7-form-control-wrap {
            display: block;
            margin-bottom: 20px;
        }
        
        .spin-wheel-form input[type="text"],
        .spin-wheel-form input[type="email"],
        .spin-wheel-form input[type="tel"] {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            background: transparent;
            border: 2px solid white;
            color: white;
            border-radius: 5px;
            outline: none;
            box-sizing: border-box;
        }
        
        .spin-wheel-form input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .spin-wheel-form input:focus {
            border-color: #d4a745;
        }
        
        .spin-wheel-form .wpcf7-checkbox {
            margin: 25px 0;
        }
        
        .spin-wheel-form .wpcf7-list-item {
            margin: 0;
        }
        
        .spin-wheel-form .wpcf7-list-item label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .spin-wheel-form .wpcf7-list-item input[type="checkbox"] {
            margin-top: 3px;
            width: 18px;
            height: 18px;
            cursor: pointer;
            flex-shrink: 0;
        }
        
        .spin-wheel-form .start-spin-btn {
            width: 100%;
            padding: 18px;
            font-size: 1.3em;
            font-weight: bold;
            background: #cc0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        
        .spin-wheel-form .start-spin-btn:hover:not(:disabled) {
            background: #ff0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(204, 0, 0, 0.5);
        }
        
        .spin-wheel-form .start-spin-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .spin-wheel-form .wpcf7-submit {
            display: none !important;
        }
        
        .spin-wheel-form .wpcf7-response-output {
            display: none !important;
        }
        
        .spin-wheel-form .wpcf7-not-valid-tip {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .spin-wheel-form .wpcf7-spinner {
            display: none !important;
        }

        /* Email error message */
        .email-error-message {
            background: rgba(255, 107, 107, 0.2);
            border: 2px solid #ff6b6b;
            color: #ff6b6b;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 14px;
            display: none;
        }

        .email-error-message.show {
            display: block;
        }
        
        /* Winner Modal */
        .winner-modal, .loser-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            align-items: center;
            justify-content: center;
        }
        
        .winner-modal.show, .loser-modal.show {
            display: flex !important;
        }
        
        .winner-modal-content, .loser-modal-content {
            background: linear-gradient(135deg, #2d0a0a 0%, #1a0000 100%);
            padding: 50px 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 500px;
            position: relative;
            border: 3px solid #d4a745;
            box-shadow: 0 0 50px rgba(212, 167, 69, 0.5);
            animation: modalSlideIn 0.5s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                transform: scale(0.7) translateY(-50px);
                opacity: 0;
            }
            to {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }
        
        .winner-confetti {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            border-radius: 20px;
        }
        
        .winner-title {
            font-size: 2.5em;
            color: #d4a745;
            margin: 0 0 20px 0;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .winner-prize {
            font-size: 1.5em;
            color: white;
            margin: 20px 0;
            font-weight: bold;
        }
        
        .winner-code {
            font-size: 1.8em;
            color: #d4a745;
            background: rgba(212, 167, 69, 0.15);
            padding: 15px 25px;
            border-radius: 10px;
            margin: 20px 0;
            font-weight: bold;
            border: 2px dashed #d4a745;
            letter-spacing: 2px;
        }
        
        .winner-instruction {
            color: rgba(255, 255, 255, 0.8);
            margin: 20px 0;
            font-size: 1.1em;
        }
        
        .winner-close-btn, .loser-close-btn {
            background: #cc0000;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1em;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .winner-close-btn:hover, .loser-close-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(204, 0, 0, 0.5);
        }
        
        .loser-title {
            font-size: 2em;
            color: #d4a745;
            margin: 0 0 20px 0;
        }
        
        .loser-message {
            font-size: 1.2em;
            color: white;
            margin: 20px 0 30px 0;
            line-height: 1.6;
        }
        
        /* Confetti Animation */
        @keyframes confettiFall {
            to {
                transform: translateY(120vh) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .spin-wheel-content {
                flex-direction: column;
                padding: 30px 20px;
            }
            
            .deal-wheel {
                --size: 320px;
            }
            
            .form-section {
                max-width: 100%;
                width: 100%;
            }
            
            .form-title {
                font-size: 2em;
            }
            
            .winner-modal-content, .loser-modal-content {
                margin: auto;
                padding: 40px 30px;
            }
            
            .winner-title {
                font-size: 2em;
            }
            
            .winner-code {
                font-size: 1.5em;
            }
            .wheel-center {
                width: 32px;
                height: 32px;
            }

            .wheel-pointer {
                right: -12px;
                border-top: 8px solid transparent;
                border-bottom: 8px solid transparent;
                border-left: 15px solid #d4a745;
                filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.3));
            }
        }
    </style>
    <div class="spin-wheel-popup-container">
        <div class="spin-wheel-content">
            <div class="wheel-section">
                <div class="deal-wheel">
                    <div class="wheel-outer-ring"></div>
                    <ul class="spinner"></ul>
                    <div class="wheel-center">
                        <div class="wheel-pointer"></div>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">SPIN TO WIN BIG! 🎉</h2>
                    <p class="form-subtitle">Black Friday luck is on your side — spin to see what you score!</p>
                </div>
                
                <div class="spin-wheel-form">
                    <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($atts['form_id']) . '"]'); ?>
                    <div class="email-error-message" id="emailError"></div>
                </div>
            </div>
        </div>
        
        <div id="winnerModal" class="winner-modal">
            <div class="winner-modal-content">
                <div class="winner-confetti"></div>
                <h2 class="winner-title">🎉 CONGRATULATIONS!</h2>
                <p class="winner-prize" id="winnerPrizeText"></p>
                <p class="winner-instruction">Check your email for full details!</p>
                <button class="winner-close-btn" onclick="closeWinnerModal()">EXPLORE COURSES</button>
            </div>
        </div>

        <div id="loserModal" class="loser-modal">
            <div class="loser-modal-content">
                <h2 class="loser-title">Better Luck Next Time! 😊</h2>
                <p class="loser-message">Don't worry! We still have amazing TEFL courses waiting for you.</p>
                <button class="loser-close-btn" onclick="closeLoserModal()">Browse Our Courses</button>
            </div>
        </div>
    </div>

    <script>

    function decodeBase64UTF8(str) {
        return decodeURIComponent(escape(atob(str)));
    }
    
    (function() {
        
        const prizeConfig = JSON.parse(
            decodeBase64UTF8(
                'WwogIHsKICAgICJuYW1lIjogIkJldHRlciBsdWNrIG5leHQgdGltZSEiLAogICAgInByb2JhYmlsaXR5IjogMTUsCiAgICAiY29kZSI6IG51bGwKICB9LAogIHsKICAgICJuYW1lIjogIkV4dHJhIOKCrDEwIG9mZiB5b3UgcHVyY2hhc2UiLAogICAgInByb2JhYmlsaXR5IjogMjAsCiAgICAiY29kZSI6ICJTUElOMTAiCiAgfSwKICB7CiAgICAibmFtZSI6ICJGcmVlIEFJIE1vZHVsZSIsCiAgICAicHJvYmFiaWxpdHkiOiAxNSwKICAgICJjb2RlIjogIkFJRlJFRSIKICB9LAogIHsKICAgICJuYW1lIjogIkJldHRlciBsdWNrIG5leHQgdGltZSEiLAogICAgInByb2JhYmlsaXR5IjogMCwKICAgICJjb2RlIjogbnVsbAogIH0sCiAgewogICAgIm5hbWUiOiAiRXh0cmEg4oKsNSBvZmYgeW91ciBwdXJjaGFzZSIsCiAgICAicHJvYmFiaWxpdHkiOiAzNSwKICAgICJjb2RlIjogIlNQSU41IgogIH0sCiAgewogICAgIm5hbWUiOiAiRnJlZSBZb2dhIGFuZCBNaW5kZnVsbmVzcyBDb3Vyc2UiLAogICAgInByb2JhYmlsaXR5IjogMTUsCiAgICAiY29kZSI6ICJZT0dBRlJFRSIKICB9LAogIHsKICAgICJuYW1lIjogIkJldHRlciBsdWNrIG5leHQgdGltZSEiLAogICAgInByb2JhYmlsaXR5IjogMCwKICAgICJjb2RlIjogbnVsbAogIH0sCiAgewogICAgIm5hbWUiOiAi4oKsMjAwIFJ5YW5haXIgVm91Y2hlciIsCiAgICAicHJvYmFiaWxpdHkiOiAwLAogICAgImNvZGUiOiBudWxsCiAgfQpd'
            )
        );

        // Helper functions
        const rand = (m, M) => Math.random() * (M - m) + m;

        const wheel = document.querySelector(".deal-wheel");
        const spinner = wheel.querySelector(".spinner");
        const tot = prizeConfig.length;
        const sliceAngle = 360 / tot;

        let currentRotation = 0;
        let isSpinning = false;
        let prizeNodes;
        let hasSpun = false;

        const createPrizeNodes = () => {
            prizeConfig.forEach(({ name }, i) => {
                const rotateDeg = (i * sliceAngle) + (sliceAngle / 2);
                
                spinner.insertAdjacentHTML(
                    "beforeend",
                    `<li class="prize" data-index="${i}" style="--rotate:${rotateDeg}deg">
                        <span class="text">${name}</span>
                    </li>`
                );
            });
        };

        const getWeightedPrizeIndex = () => {
            const valid = prizeConfig.map((p, i) => ({ ...p, index: i })).filter(p => p.probability > 0);
            const total = valid.reduce((s, p) => s + p.probability, 0);
            let r = Math.random() * total;
            for (const v of valid) {
                r -= v.probability;
                if (r <= 0) return v.index;
            }
            return valid[0].index;
        };

        const selectPrize = (i) => {
            prizeNodes.forEach(n => n.classList.remove('selected'));
            prizeNodes[i].classList.add('selected');
        };

        function createConfetti() {
            const box = document.querySelector('.winner-confetti');
            if (!box) return;
            const colors = ['#d4a745', '#cc0000', '#ff0000', '#ffffff', '#ffd700'];
            for (let i = 0; i < 100; i++) {
                setTimeout(() => {
                    const c = document.createElement('div');
                    const s = Math.random() * 10 + 5;
                    Object.assign(c.style, {
                        position: 'absolute', width: s + 'px', height: s + 'px',
                        backgroundColor: colors[Math.floor(Math.random() * colors.length)],
                        left: Math.random() * 100 + '%', top: '-20px',
                        borderRadius: Math.random() > 0.5 ? '50%' : '0',
                        animation: `confettiFall ${2 + Math.random() * 2}s linear forwards`
                    });
                    box.appendChild(c);
                    setTimeout(() => c.remove(), 4000);
                }, i * 30);
            }
        }

        const showWinnerModal = (p) => {
            const m = document.getElementById('winnerModal');
            document.getElementById('winnerPrizeText').textContent = `You've won: ${p.name}!`;
            m.classList.add('show');
            createConfetti();
        };

        const showLoserModal = () => document.getElementById('loserModal').classList.add('show');

        window.closeWinnerModal = () => { 
            document.getElementById('winnerModal').classList.remove('show'); 
            location.href = '/black-friday-sale/'; 
        };

        window.closeLoserModal = () => { 
            document.getElementById('loserModal').classList.remove('show'); 
            location.href = '/black-friday-sale/'; 
        };

        // Check if email has already spun via AJAX
        async function checkEmailSpun(email) {
            try {
                const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'check_spin_email',
                        email: email,
                        nonce: '<?php echo wp_create_nonce("spin_check_nonce"); ?>'
                    })
                });
                const data = await response.json();
                return data.already_spun;
            } catch (error) {
                console.error('Error checking email:', error);
                return false;
            }
        }

        // Save email via AJAX
        async function saveSpinEmail(email, prize) {
            try {
                const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'save_spin_email',
                        email: email,
                        prize: prize,
                        nonce: '<?php echo wp_create_nonce("spin_save_nonce"); ?>'
                    })
                });
                const data = await response.json();
                return data.success;
            } catch (error) {
                console.error('Error saving email:', error);
                return false;
            }
        }

        // Submit form to record the spin
        function submitFormData() {
            const form = document.querySelector('.spin-wheel-form form');
            if (form) {
                const submitBtn = form.querySelector('.wpcf7-submit');
                if (submitBtn) {
                    submitBtn.click();
                }
            }
        }

        function spinWheel(userEmail) {
            if (isSpinning || hasSpun) return;
            isSpinning = true;
            hasSpun = true;

            const startBtn = document.getElementById("startBtn");
            if (startBtn) {
                startBtn.disabled = true;
                startBtn.textContent = "Spinning...";
            }

            const targetIndex = getWeightedPrizeIndex();
            const targetAngle = -(targetIndex * sliceAngle + sliceAngle / 2);
            const randomOffset = rand(-15, 15);
            const numSpins = Math.floor(rand(4, 6));
            const totalRotation = targetAngle + randomOffset + (numSpins * 360);
            
            wheel.classList.add("is-spinning");
            spinner.style.transform = `rotate(${totalRotation}deg)`;

            setTimeout(async () => {
                wheel.classList.remove("is-spinning");
                isSpinning = false;
                
                selectPrize(targetIndex);

                const prize = prizeConfig[targetIndex];
                const prizeText = prize.name + (prize.code ? ` (${prize.code})` : "");
                
                const field = document.querySelector('input[name="prize-won"]');
                if (field) field.value = prizeText;

                // Save email to database immediately
                await saveSpinEmail(userEmail, prizeText);

                // Also submit the form for email notification
                submitFormData();

                setTimeout(() => {
                    prize.code ? showWinnerModal(prize) : showLoserModal();
                }, 1000);

                if (startBtn) {
                    startBtn.textContent = "Already Spun";
                }
            }, 5000);
        }

        // Initialize
        createPrizeNodes();
        prizeNodes = wheel.querySelectorAll(".prize");

        // Add click handler
        setTimeout(() => {
            let startBtn = document.getElementById("startBtn");
            
            if (!startBtn) {
                const form = document.querySelector('.spin-wheel-form form');
                if (form) {
                    const submitBtn = form.querySelector('.wpcf7-submit');
                    if (submitBtn) {
                        submitBtn.style.display = 'none';
                        
                        const newBtn = document.createElement('button');
                        newBtn.type = 'button';
                        newBtn.id = 'startBtn';
                        newBtn.className = 'start-spin-btn';
                        newBtn.textContent = 'SPIN THE WHEEL';
                        
                        submitBtn.parentNode.insertBefore(newBtn, submitBtn);
                        startBtn = newBtn;
                    }
                }
            }
            
            if (startBtn) {
                startBtn.addEventListener("click", async () => {
                    const errorMsg = document.getElementById('emailError');
                    errorMsg.classList.remove('show');
                    
                    const fullName = document.querySelector('input[name="full-name"]');
                    const email = document.querySelector('input[name="email-address"]');
                    const phone = document.querySelector('input[name="phone-number"]');
                    const checkbox = document.querySelector('input[type="checkbox"][name="consent[]"]');

                    if (!fullName || !fullName.value.trim()) {
                        errorMsg.textContent = "⚠️ Please enter your full name.";
                        errorMsg.classList.add('show');
                        return;
                    }

                    if (!email || !email.value.trim()) {
                        errorMsg.textContent = "⚠️ Please enter your email address.";
                        errorMsg.classList.add('show');
                        return;
                    }

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email.value.trim())) {
                        errorMsg.textContent = "⚠️ Please enter a valid email address.";
                        errorMsg.classList.add('show');
                        return;
                    }
                    if (!phone || !phone.value.trim()) {
                        errorMsg.textContent = "⚠️ Please enter your phone number.";
                        errorMsg.classList.add('show');
                        return;
                    }

                    if (!checkbox || !checkbox.checked) {
                        errorMsg.textContent = "⚠️ Please accept the terms and conditions.";
                        errorMsg.classList.add('show');
                        return;
                    }

                    // Check if email already spun
                    startBtn.disabled = true;
                    startBtn.textContent = "Checking...";
                    
                    const alreadySpun = await checkEmailSpun(email.value.trim());
                    
                    if (alreadySpun) {
                        errorMsg.textContent = "⚠️ This email has already been used! Each email address can only spin once.";
                        errorMsg.classList.add('show');
                        startBtn.disabled = false;
                        startBtn.textContent = "SPIN THE WHEEL";
                        return;
                    }

                    spinWheel(email.value.trim());
                });
            }
        }, 1000);
    })();
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('spin_wheel_popup', 'spin_wheel_popup_shortcode');


/**
 * AJAX handler to check if email already spun
 */
add_action('wp_ajax_check_spin_email', 'check_spin_email_ajax');
add_action('wp_ajax_nopriv_check_spin_email', 'check_spin_email_ajax');

function check_spin_email_ajax() {
    check_ajax_referer('spin_check_nonce', 'nonce');
    
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (empty($email)) {
        wp_send_json(['already_spun' => false]);
    }

    $spun_emails = get_option('spin_wheel_emails', []);
    if (!is_array($spun_emails)) {
        $spun_emails = [];
    }

    $already_spun = false;

    foreach ($spun_emails as $entry) {
        if (is_array($entry) && isset($entry['email']) && strtolower($entry['email']) === strtolower($email)) {
            $already_spun = true;
            break;
        }
    }

    wp_send_json(['already_spun' => $already_spun]);
}

/**
 * AJAX handler to save email after spin
 */
add_action('wp_ajax_save_spin_email', 'save_spin_email_ajax');
add_action('wp_ajax_nopriv_save_spin_email', 'save_spin_email_ajax');

function save_spin_email_ajax() {
    check_ajax_referer('spin_save_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $prize = isset($_POST['prize']) ? sanitize_text_field($_POST['prize']) : '';

    if (empty($email)) {
        wp_send_json_error(['message' => 'Missing email']);
    }

    // Always fetch fresh copy
    $spun_emails = get_option('spin_wheel_emails', []);

    // Normalize in case option got cleared/reset
    if (!is_array($spun_emails)) {
        $spun_emails = [];
    }

    $spun_emails = array_filter($spun_emails, function($entry) use ($email) {
        if (!is_array($entry) || empty($entry['email'])) return true;
        return $entry['email'] !== $email;
    });

    $spun_emails[] = [
        'email' => $email,
        'prize' => $prize,
    ];

    update_option('spin_wheel_emails', array_values($spun_emails));

    wp_send_json_success([
        'message' => 'Email and prize saved',
        'email'   => $email,
        'prize'   => $prize,
    ]);
}

/**
 * Admin page to view/clear spun emails
 */
add_action('admin_menu', 'spin_wheel_admin_menu');
function spin_wheel_admin_menu() {
    add_submenu_page(
        'tools.php',
        'Spin Wheel Emails',
        'Spin Wheel Emails',
        'manage_options',
        'spin-wheel-emails',
        'spin_wheel_emails_page'
    );
}

function spin_wheel_emails_page() {
    if (isset($_POST['clear_emails']) && check_admin_referer('clear_spin_emails')) {
        delete_option('spin_wheel_emails');
        echo '<div class="notice notice-success"><p>All emails cleared.</p></div>';
    }

    if (isset($_POST['delete_email']) && check_admin_referer('delete_spin_email')) {
        $email_to_delete = sanitize_email($_POST['email_to_delete']);
        $spun_emails = get_option('spin_wheel_emails', []);
        $spun_emails = array_filter($spun_emails, function($item) use ($email_to_delete) {
            return $item['email'] !== $email_to_delete;
        });
        update_option('spin_wheel_emails', array_values($spun_emails));
        echo '<div class="notice notice-success"><p>Email removed successfully!</p></div>';
    }

    $spun_emails = get_option('spin_wheel_emails', []);
    ?>
    <div class="wrap">
        <h1>Spin Wheel - Email & Prize Tracking</h1>
        <p>Total entries: <strong><?php echo count($spun_emails); ?></strong></p>

        <?php if (!empty($spun_emails)): ?>
            <form method="post" style="margin: 20px 0;">
                <?php wp_nonce_field('clear_spin_emails'); ?>
                <input type="submit" name="clear_emails" class="button button-secondary" 
                       value="Clear All" 
                       onclick="return confirm('Clear all tracked entries?');">
            </form>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Email Address</th>
                        <th>Prize</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($spun_emails as $index => $item): ?>
                        <?php
                        if (is_string($item)) {
                            $item = ['email' => $item, 'prize' => ''];
                        }
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo esc_html($item['email']); ?></td>
                            <td><?php echo esc_html($item['prize']); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <?php wp_nonce_field('delete_spin_email'); ?>
                                    <input type="hidden" name="email_to_delete" value="<?php echo esc_attr($item['email']); ?>">
                                    <button type="submit" name="delete_email" class="button button-small"
                                            onclick="return confirm('Remove this entry?');">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <p>No emails have been tracked yet.</p>
        <?php endif; ?>
    </div>
    <?php
}


/**
 * Send conditional prize emails based on what was won
 */
add_action('wpcf7_mail_sent', 'send_prize_specific_email');

function send_prize_specific_email($contact_form) {
    if ($contact_form->id() != 98449) {
        return;
    }
    
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return;
    }
    
    $posted_data = $submission->get_posted_data();
    
    $email = isset($posted_data['email-address']) ? sanitize_email($posted_data['email-address']) : '';
    $name = isset($posted_data['full-name']) ? sanitize_text_field($posted_data['full-name']) : '';
    $prize = isset($posted_data['prize-won']) ? sanitize_text_field($posted_data['prize-won']) : '';
    
    if (empty($email) || empty($prize)) {
        return;
    }
    
    $first_name = explode(' ', $name)[0];
    
    $subject = '';
    $message = '';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    if (strpos($prize, 'Free AI Module') !== false) {
        $subject = "Congratulations! 🎉 You've just won a Free AI Module!";
        $message = get_ai_module_email($first_name);
    } 
    elseif (strpos($prize, 'Free Yoga') !== false) {
        $subject = "Congratulations! 🎉 You've just won a Free Yoga and Mindfulness Course!";
        $message = get_yoga_email($first_name);
    }
    elseif (strpos($prize, '€5 off') !== false || strpos($prize, 'Extra €5') !== false) {
        $subject = "Congratulations! 🎉 You've won €5 off your next TEFL course!";
        $message = get_5_euro_email($first_name);
    }
    elseif (strpos($prize, '€10 off') !== false || strpos($prize, 'Extra €10') !== false) {
        $subject = "Congratulations! 🎉 You've won €10 off your next TEFL course!";
        $message = get_10_euro_email($first_name);
    }
    else {
        return;
    }
    
    // Send email
    wp_mail($email, $subject, $message, $headers);
}

/**
 * Email template for AI Module winners
 */
function get_ai_module_email($first_name) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="color: white; margin: 0; font-size: 28px;">🎉 Congratulations!</h1>
        </div>
        
        <div style="background: #ffffff; padding: 30px; border: 1px solid #e0e0e0; border-top: none; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">Hi <strong><?php echo esc_html($first_name); ?></strong>,</p>
            
            <p style="font-size: 16px;">Congratulations! 🎉 You've just won a <strong>Free AI for English Teachers Module</strong> from our Black Friday Spin the Wheel.</p>
            
            <p style="font-size: 16px;">This specialist course will show you how to use AI tools effectively to enhance your lessons and make teaching easier and more engaging.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0;">
                <h3 style="color: #667eea; margin-top: 0;">👉 Redeem your prize now:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">✓ Use code <strong style="color: #667eea; font-size: 18px;">AIFREE</strong> at checkout to bring your course total to €0.</li>
                    <li>✓ Access your course here: <a href="https://teflinstitute.com/product/how-to-use-ai-as-a-tefl-teacher/" style="color: #667eea; text-decoration: none; font-weight: bold;">Start Learning Now</a></li>
                </ul>
            </div>
            
            <p style="font-size: 14px; color: #666; background: #fff9e6; padding: 15px; border-left: 4px solid #ffd700; margin: 20px 0;">
                <strong>Please note:</strong> This is a specialist TEFL course. If you'd like to become a fully qualified TEFL teacher, you'll need a base TEFL certification such as our <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">120-Hour Advanced TEFL Course</a>, which pairs perfectly with your new specialist training.
            </p>
            
            <p style="font-size: 16px; margin-top: 30px;">Kind regards,<br><strong> The TEFL Institute </strong></p>
        </div>
        
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Email template for Yoga Course winners
 */
function get_yoga_email($first_name) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="color: white; margin: 0; font-size: 28px;">🎉 Congratulations!</h1>
        </div>
        
        <div style="background: #ffffff; padding: 30px; border: 1px solid #e0e0e0; border-top: none; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">Hi <strong><?php echo esc_html($first_name); ?></strong>,</p>
            
            <p style="font-size: 16px;">Congratulations! 🎉 You've just won a <strong>Free Yoga and Mindfulness for Early Childhood Educators Course</strong> from our Black Friday Spin the Wheel.</p>
            
            <p style="font-size: 16px;">This specialist course helps you integrate mindfulness and movement into your lessons, creating calm and creative classrooms for young learners.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0;">
                <h3 style="color: #667eea; margin-top: 0;">👉 Redeem your prize now:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">✓ Use code <strong style="color: #667eea; font-size: 18px;">YOGAFREE</strong> at checkout to bring your course total to €0.</li>
                    <li>✓ Access your course here: <a href="https://teflinstitute.com/product/mindfulness-yoga-for-early-childhood-educators/" style="color: #667eea; text-decoration: none; font-weight: bold;">Start Learning Now</a></li>
                </ul>
            </div>
            
            <p style="font-size: 14px; color: #666; background: #fff9e6; padding: 15px; border-left: 4px solid #ffd700; margin: 20px 0;">
                <strong>Please note:</strong> This is a specialist TEFL course. If you'd like to become a fully qualified TEFL teacher, you'll need a base TEFL certification such as our <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">120-Hour Advanced TEFL Course</a>, which pairs perfectly with your new specialist training.
            </p>
            
            <p style="font-size: 16px; margin-top: 30px;">Kind regards,<br><strong> The TEFL Institute </strong></p>
        </div>
        
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Email template for €5 discount winners
 */
function get_5_euro_email($first_name) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="color: white; margin: 0; font-size: 28px;">🎉 Congratulations!</h1>
        </div>
        
        <div style="background: #ffffff; padding: 30px; border: 1px solid #e0e0e0; border-top: none; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">Hi <strong><?php echo esc_html($first_name); ?></strong>,</p>
            
            <p style="font-size: 16px;">Congratulations! 🎉 You've just won <strong>€5 off your next TEFL course</strong> from our Black Friday Spin the Wheel.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0;">
                <h3 style="color: #667eea; margin-top: 0;">👉 Redeem your prize now:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">✓ Use code <strong style="color: #667eea; font-size: 18px;">SPIN5</strong> at checkout to save €5 on your next base TEFL course.</li>
                    <li>✓ Explore TEFL Courses: <a href="https://teflinstitute.com/black-friday-sale///" style="color: #667eea; text-decoration: none; font-weight: bold;">Browse Now</a></li>
                </ul>
            </div>
            
            <p style="font-size: 14px; color: #666; background: #fff9e6; padding: 15px; border-left: 4px solid #ffd700; margin: 20px 0;">
                <strong>Please note:</strong> This discount is valid only on base TEFL certifications such as our <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">120-Hour Advanced TEFL Course</a> - the perfect foundation to become a fully qualified English teacher and pair with specialist training later on.
            </p>
            
            <p style="font-size: 16px; margin-top: 30px;">Kind regards,<br><strong> The TEFL Institute </strong></p>
        </div>
        
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Email template for €10 discount winners
 */
function get_10_euro_email($first_name) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 900px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="color: white; margin: 0; font-size: 28px;">🎉 Congratulations!</h1>
        </div>
        
        <div style="background: #ffffff; padding: 30px; border: 1px solid #e0e0e0; border-top: none; border-radius: 0 0 10px 10px;">
            <p style="font-size: 16px;">Hi <strong><?php echo esc_html($first_name); ?></strong>,</p>
            
            <p style="font-size: 16px;">Congratulations! 🎉 You've just won <strong>€10 off your next TEFL course</strong> from our Black Friday Spin the Wheel.</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0;">
                <h3 style="color: #667eea; margin-top: 0;">👉 Redeem your prize now:</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">✓ Use code <strong style="color: #667eea; font-size: 18px;">SPIN10</strong> at checkout to save €10 on your next base TEFL course.</li>
                    <li>✓ Explore TEFL Courses: <a href="https://teflinstitute.com/black-friday-sale///" style="color: #667eea; text-decoration: none; font-weight: bold;">Browse Now</a></li>
                </ul>
            </div>
            
            <p style="font-size: 14px; color: #666; background: #fff9e6; padding: 15px; border-left: 4px solid #ffd700; margin: 20px 0;">
                <strong>Please note:</strong> This discount is valid only on base TEFL certifications such as our <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">120-Hour Advanced TEFL Course</a> - the perfect foundation to become a fully qualified English teacher and pair with specialist training later on.
            </p>
            
            <p style="font-size: 16px; margin-top: 30px;">Kind regards,<br><strong>The TEFL Institute Team</strong></p>
        </div>
        
        <div style="text-align: center; padding: 20px; color: #999; font-size: 12px;">
            <p>The TEFL Institute | Premier TEFL | The TEFL Institute</p>
        </div>
    </body>
    </html>
    <?php
    return ob_get_clean();
}